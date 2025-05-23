<?php namespace AppPayment\Subscription\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use AppPayment\Plan\Models\Plan;
use AppUser\UserApi\Models\User;
use Stripe\Exception\ApiErrorException;
use AppApi\ApiResponse\Resources\ApiResource;
use AppPayment\Subscription\Models\Subscription;
use October\Rain\Exception\ApplicationException;
use AppPayment\Stripe\Classes\PaymentIntentService;
use AppPayment\Subscription\Http\Resources\SubscriptionResource;
use AppPayment\Subscription\Classes\Services\SubscriptionService;

class SubscriptionsController
{
	/**
	 * List all subscriptions for a user.
	 *
	 * @param Request $request
	 * @param User $user
	 * @return ApiResource
	 */
    public function index(Request $request, User $user): ApiResource
    {
        $subscriptions = Subscription::where([
			'user_id' => $user->id
		])->get();

		$response = SubscriptionResource::collection($subscriptions);

		return ApiResource::success(data: $response);
    }

	/**
	 * Show a subscription.
	 *
	 * @param Request $request
	 * @param Plan $plan
	 * @param User $user
	 * @return ApiResource
	 * @throws ApiErrorException
	 */
    public function show(Request $request, Plan $plan, User $user): ApiResource
    {
        $subscriptions = Subscription::where([
            'plan_id' => $plan->id,
            'user_id' => $user->id
        ])->firstOrFail();

		$response = new SubscriptionResource($subscriptions);

		return ApiResource::success(data: $response);
    }

	/**
	 * Store a new subscription.
	 *
	 * @param Request $request
	 * @param Plan $plan
	 * @param User $user
	 * @return ApiResource
	 * @throws ApiErrorException
	 * @throws ApplicationException
	 */
	public function store(Request $request, Plan $plan, User $user): ApiResource
    {
		Stripe::setApiKey(env('STRIPE_API_KEY'));

		if (!$request->has('card_id')) {
            throw new ApplicationException('Card token was not supplied.');
        }

        $subscription = (new SubscriptionService)->createOrReactivateSubscriptionWithPlan($user, $plan, $request->card_id);
		$stripeSubscription = (new SubscriptionService)->getSubscription($subscription->stripe_id, ['expand' => ['latest_invoice.payments']]);
		$invoice = $stripeSubscription->latest_invoice;

		$requiresAction = false;
		$clientSecret = null;

		if (!empty($invoice->payments->data)) {
			$payment = $invoice->payments->data[0];
			$paymentIntent = PaymentIntentService::getIntent($payment->payment->payment_intent);
			$requiresAction = $paymentIntent->status === 'requires_action' || $paymentIntent->status === 'requires_confirmation';
			$clientSecret = $paymentIntent->client_secret;
		}

		$response = [
			'subscription'    => new SubscriptionResource($subscription),
			'requires_action' => $requiresAction,
			'client_secret'   => $clientSecret
		];

		return ApiResource::success(data: $response);
    }

	/**
	 * Cancel an existing subscription.
	 *
	 * @param Request $request
	 * @param Plan $plan
	 * @param User $user
	 * @return ApiResource
	 * @throws ApiErrorException
	 */
    public function destroy(Request $request, Plan $plan, User $user): ApiResource
    {
		$response = (new SubscriptionService)->cancelSubscription($user, $plan);

        return ApiResource::success(data: $response);
    }
}
