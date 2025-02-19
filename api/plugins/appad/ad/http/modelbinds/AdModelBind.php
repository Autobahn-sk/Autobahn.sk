<?php namespace AppAd\Ad\Http\ModelBinds;

use Closure;
use AppAd\Ad\Models\Ad;

class AdModelBind
{
    public function handle($request, Closure $next)
    {
        if ($request->route()->hasParameter('ad') && is_string($request->route()->parameter('ad'))) {
            $request->route()->setParameter('ad', Ad::where('slug', $request->route()->parameter('ad'))->firstOrFail());
		}

		return $next($request);
	}
}