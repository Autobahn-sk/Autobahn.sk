<?php namespace AppAd\Ad\Http\Middlewares;

use Closure;
use AppApi\ApiException\Exceptions\BadRequestException;

class AdPolicyMiddleware
{
    public function handle($request, Closure $next)
    {
        $routeGroup = explode('.', $request->route()->getName());
        $routeAction = $request->route()->getActionMethod();
        
        $user = $request->route()->parameter('user');
        
        switch ($routeGroup[0]) {
            case 'ads':
                $ad = $request->route()->parameter('ad');
                
                $allowedToPerformAction = false;
                
                switch ($routeAction) {
                    case 'update':
                        if (isset($user) && $ad->user->id == $user->id) {
                            $allowedToPerformAction = true;
                        }
                        
                        if (!$allowedToPerformAction) {
                            throw new BadRequestException('Nie ste oprávnený na prístup k tomuto inzerátu.');
                        }
                        break;
                    case 'destroy':
                        if (isset($user) && (!$user->groups->where('code', '=', 'admin')->isEmpty() || $ad->user->id == $user->id)) {
                            $allowedToPerformAction = true;
                        }
                        
                        if (!$allowedToPerformAction) {
                            throw new BadRequestException('Nie ste oprávnený na prístup k tomuto inzerátu.');
                        }
                        break;
                }
                break;
            
            default:
                return $next($request);
                break;
        }
        
        return $next($request);
    }
}
