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
            case 'comments':
                $comment = $request->route()->parameter('comment');
                
                $allowedToPerformAction = false;
                
                switch ($routeAction) {
                    case 'update':
                        if (isset($user) && $comment->creatable->id == $user->id) {
                            $allowedToPerformAction = true;
                        }
                        
                        if (!$allowedToPerformAction) {
                            throw new BadRequestException('You are not authorized to access this Model.');
                        }
                        break;
                    case 'destroy':
                        if (isset($user) && (!$user->groups->where('code', '=', 'admin')->isEmpty() || $comment->creatable->id == $user->id)) {
                            $allowedToPerformAction = true;
                        }
                        
                        if (!$allowedToPerformAction) {
                            throw new BadRequestException('You are not authorized to access this Model.');
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
