<?php namespace AppChat\Comment\Http\Middlewares;

use Closure;
use AppApi\ApiException\Exceptions\BadRequestException;

class CommentPolicyMiddleware
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
                            throw new BadRequestException('Nie ste oprávnený na prístup k tomuto komentáru.');
                        }
                        break;
                    case 'destroy':
                        if (isset($user) && (!$user->groups->where('code', '=', 'admin')->isEmpty() || $comment->creatable->id == $user->id)) {
                            $allowedToPerformAction = true;
                        }
                        
                        if (!$allowedToPerformAction) {
                            throw new BadRequestException('Nie ste oprávnený na prístup k tomuto komentáru.');
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
