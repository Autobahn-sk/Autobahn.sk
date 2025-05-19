<?php namespace AppPayment\Subscription\Classes;

use AppPayment\Subscription\Models\Subscription;
use AppPayment\Subscription\Classes\Services\SubscriptionService;

class SubscriptionCronUpdater
{
    public function checkAllSubscriptions()
    {
        Subscription::all()->each(function ($subscription) {
            $stripeSubscription = (new SubscriptionService)->getSubscription($subscription->stripe_id);

            $subscription->status = $stripeSubscription['status'];
            $subscription->save();
        });
    }
}
