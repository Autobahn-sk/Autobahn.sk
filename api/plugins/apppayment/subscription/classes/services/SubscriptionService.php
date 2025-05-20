<?php namespace AppPayment\Subscription\Classes\Services;

use Stripe\StripeClient;
use RainLab\User\Models\User;
use AppPayment\Plan\Models\Plan;
use Stripe\Exception\ApiErrorException;
use AppPayment\Stripe\Classes\CustomerService;
use October\Rain\Exception\ApplicationException;
use AppPayment\Subscription\Models\Subscription;

class SubscriptionService
{
	protected StripeClient $client;

	public function __construct()
	{
		if (!env('STRIPE_API_KEY')) {
			throw new ApplicationException('Stripe API key is not set.');
		}

		$this->client = new StripeClient(env('STRIPE_API_KEY'));
	}

	/**
	 * Get a subscription by its ID.
	 *
	 * @param string $subscriptionId
	 * @param array $options
	 * @return \Stripe\Subscription
	 * @throws ApiErrorException
	 */
	public function getSubscription(string $subscriptionId, array $options = []): \Stripe\Subscription
	{
		return $this->client->subscriptions->retrieve($subscriptionId, $options);
    }

	/**
	 * Create or reactivate a subscription for a user with a specific plan.
	 *
	 * @param User $user
	 * @param Plan $plan
	 * @param string $cardId
	 * @return Subscription
	 * @throws ApiErrorException
	 * @throws ApplicationException
	 */
	public function createOrReactivateSubscriptionWithPlan(User $user, Plan $plan, string $cardId): Subscription
    {
        CustomerService::checkForCustomerIdOrAssign($user);

        $subscription = Subscription::where([
            'is_primary' => true,
            'user_id'    => $user->id,
            'plan_id'    => $plan->id
        ])->exists();

        if ($subscription) {
            throw new ApplicationException('You already have an active subscription for this plan.');
        }

		$this->client->paymentMethods->attach($cardId, [
			'customer' => $user->stripe_id
		]);

		$this->client->customers->update($user->stripe_id, [
			'invoice_settings' => [
				'default_payment_method' => $cardId
			],
		]);

		$stripeSubscription = $this->client->subscriptions->create([
			'customer' => $user->stripe_id,
			'items' => [
				['plan' => $plan->stripe_id]
			],
			'default_payment_method' => $cardId,
			'payment_behavior' => 'default_incomplete',
			'expand' => ['latest_invoice.payments']
		]);

		$newSubscription = new Subscription();
        $newSubscription->plan = $plan;
        $newSubscription->user = $user;
        $newSubscription->stripe_id = $stripeSubscription['id'];
        $newSubscription->status = $stripeSubscription['status'];
        $newSubscription->save();

        return $newSubscription;
    }

	/**
	 * Cancel a subscription for a user with a specific plan.
	 *
	 * @param User $user
	 * @param Plan $plan
	 * @return array
	 * @throws ApiErrorException
	 */
	public function cancelSubscription(User $user, Plan $plan): array
    {
        $subscription = Subscription::notCancelled()->where('plan_id', $plan->id)->firstOrFail();

		$this->client->subscriptions->cancel($subscription->stripe_id);

        $subscription->status = 'canceled';
        $subscription->save();

        return [
            'success' => true
        ];
    }

	/**
	 * Check if a user is subscribed to a specific plan.
	 *
	 * @param User|null $user The user instance or null.
	 * @param Plan $plan The plan to check against.
	 * @return bool True if the user is subscribed to the plan, false otherwise.
	 */
    public static function isUserSubscribedToPlan(?User $user, Plan $plan): bool
    {
		if (!$user) {
			return false;
		}

		return $user->subscriptions()->active()->where('plan_id', $plan->id)->exists();
    }
}
