<?php namespace AppPayment\Subscription\Classes\Extend;

use October\Rain\Support\Facades\Event;
use AppPayment\Subscription\Classes\Services\SubscriptionService;

class PlanExtend
{
	public static function addIsUserSubscribedToResource(): void
	{
		Event::listen('apppayment.plan.beforeReturnResource', function (&$data, $plan) {
			$data['is_user_subscribed'] = SubscriptionService::isUserSubscribedToPlan(auth()->user(), $plan);
		});
	}
}
