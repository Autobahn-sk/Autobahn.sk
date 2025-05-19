<?php namespace AppPayment\Subscription\Classes\Extend;

use RainLab\User\Models\User;
use AppPayment\Subscription\Models\Subscription;
use AppPayment\Subscription\Classes\Services\SubscriptionService;

class UserExtend
{
    public static function addSubscriptionsToModelUser(): void
	{
        User::extend(function (User $user) {
            $user->hasMany = [
                'subscriptions' => [
                    Subscription::class,
                    'conditions' => 'is_primary = true'
                ]
            ];
        });
    }

    public static function cancelSubscriptionsOnUserDelete(): void
	{
        User::extend(function (User $user) {
            $user->bindEvent('model.beforeDelete', function () use ($user) {
                $subscriptions = Subscription::where('user_id', $user->id)
                    ->where('status', 'active')
                    ->get();

                foreach ($subscriptions as $subscription) {
					(new SubscriptionService)->cancelSubscription($user, $subscription->plan);
                }
            });
        });
    }
}
