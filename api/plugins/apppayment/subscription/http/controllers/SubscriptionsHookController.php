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

    private function syncSubscription($event): void
	{
        if ($event->type = 'customer.subscription.updated') {
            $stripeSubscription = $event->data->object;

            $subscription = Subscription::where('stripe_id', $stripeSubscription->id)->first();

            if (!$subscription) {
				Logger::info("STRIPE: customer.subscription.updated test webhook received.");

				response()->json([
					'data' => [
						'message' => 'Not found. Nothing changed.'
					]
				]);
				return;
            }

            $subscription->status = $stripeSubscription->status;
            $subscription->save();

			Logger::info("STRIPE: Subscription {$subscription->id} was updated to {$subscription->status}.", [$event]);
        }
    }
}
