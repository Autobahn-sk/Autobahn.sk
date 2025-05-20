<?php namespace AppService\Diagnostic\Http\Middlewares;

use Closure;
use AppService\Diagnostic\Models\Diagnostic;
use AppApi\ApiException\Exceptions\BadRequestException;

class SubscriptionPolicyMiddleware
{
	public function handle($request, Closure $next)
    {
        $routeGroup = explode('.', $request->route()->getName());
        $routeAction = $request->route()->getActionMethod();

		$user = $request->route()->parameter('user');

        switch ($routeGroup[0]) {
            case 'diagnostics':
				if ($routeAction == 'store') {
					$subscriptions = $user->subscriptions()->active()->get();

					if ($subscriptions->isEmpty()) {
						throw new BadRequestException('Potrebujete mať aktívny predplatný plán, aby ste mohli vytvoriť diagnostiku.');
					}

					$subscription = $subscriptions->first();

					$diagnosticsCreated = Diagnostic::where('user_id', $user->id)
						->where('created_at', '>=', now()->subHour())
						->count();

					if ($diagnosticsCreated >= $subscription->plan->diagnostics_per_hour) {
						throw new BadRequestException('Pre '. $subscription->plan->name . ' máte obmedzený počet diagnostík na ' . $subscription->plan->diagnostics_per_hour . ' za hodinu. Skúste to neskôr.');
					}
				}
				break;
            default:
                return $next($request);
                break;
        }
        
        return $next($request);
    }
}
