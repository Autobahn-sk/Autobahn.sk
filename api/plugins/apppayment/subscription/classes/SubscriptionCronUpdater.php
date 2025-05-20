<?php namespace AppPayment\Subscription\Classes;

use Stripe\Exception\ApiErrorException;
use AppPayment\Subscription\Models\Subscription;
use AppPayment\Subscription\Classes\Services\SubscriptionService;

class SubscriptionCronUpdater
{
	/**
	 * Check if the subscription is active and update the status.
	 *
	 * @return void
	 * @throws ApiErrorException
	 */
    public function checkAllSubscriptions(): void
	{
        Subscription::all()->each(function ($subscription) {
            $stripeSubscription = (new SubscriptionService)->getSubscription($subscription->stripe_id);

            $subscription->status = $stripeSubscription['status'];
            $subscription->save();
        });
    }
}
