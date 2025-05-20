<?php namespace AppPayment\Subscription\Http\Controllers;

use Stripe\Stripe;
use Stripe\Webhook;
use Illuminate\Http\Request;
use UnexpectedValueException;
use AppUtil\Logger\Classes\Logger;
use Illuminate\Support\Facades\Event;
use AppPayment\Subscription\Models\Subscription;
use Stripe\Exception\SignatureVerificationException;

class SubscriptionsHookController
{
	/**
	 * Handles incoming webhook requests from Stripe.
	 *
	 * @param Request $request The incoming HTTP request containing the webhook payload and headers.
	 * @return void
	 */
    public function hook(Request $request): void
	{
        Stripe::setApiKey(env('STRIPE_API_KEY'));

        $payload = $request->getContent();

        try {
            $webhook = Webhook::constructEvent($payload, $request->header('Stripe-Signature'), env('STRIPE_WEBHOOK_SECRET'));

            $this->syncSubscription($webhook);

            Event::fire('apppayment.subscription.webhook', $webhook);
        } catch (UnexpectedValueException $e) {
            abort(400, "Invalid payload");
        } catch (SignatureVerificationException $e) {
            abort(400, "Invalid signature");
        }
    }

	/**
	 * Synchronizes the local subscription record with the updated subscription data from Stripe.
	 *
	 * @param object $event The event object received from a Stripe webhook, containing the updated subscription data.
	 * @return void
	 */
    private function syncSubscription($event): void
	{
        if ($event->type = 'customer.subscription.updated') {
            $stripeSubscription = $event->data->object;

            $subscription = Subscription::where('stripe_id', $stripeSubscription->id)->first();

            if (!$subscription) {
				Logger::info("SubscriptionsHookController - syncSubscription: customer.subscription.updated test webhook received.");

				response()->json([
					'data' => [
						'message' => 'Not found. Nothing changed.'
					]
				]);
				return;
            }

            $subscription->status = $stripeSubscription->status;
            $subscription->save();

			Logger::info("SubscriptionsHookController - syncSubscription: Subscription {$subscription->id} was updated to {$subscription->status}.");
        }
    }
}
