<?php

namespace AppUser\User\Http\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use WApi\ApiException\Exceptions\WForbiddenException;

class IsAgentMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (! $user->isAgent()) {
            throw new WForbiddenException(
                Lang::get('appuser.user::error.USER_NOT_AGENT'),
            );
        }

        return $next($request);
    }
}
