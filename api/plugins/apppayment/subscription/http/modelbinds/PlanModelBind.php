<?php namespace AppPayment\Subscription\Http\ModelBinds;

use Closure;
use AppPayment\Plan\Models\Plan;

class PlanModelBind
{
    public function handle($request, Closure $next)
    {
		if ($request->route()->hasParameter('plan') && is_numeric($request->route()->parameter('plan'))) {
			$request->route()->setParameter('plan', Plan::findOrFail($request->route()->parameter('plan')));
		}

		return $next($request);
	}
}