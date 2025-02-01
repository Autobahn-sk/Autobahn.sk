<?php namespace AppChat\Comment\Http\ModelBinds;

use Closure;
use AppUser\UserApi\Facades\JWTAuth;

class UserModelBind
{
    public function handle($request, Closure $next)
    {
        $request->route()->setParameter('user', JWTAuth::getUser());
        
        return $next($request);
    }
}