<?php namespace AppUser\UserSeller\Http\Middlewares;

use Closure;
use AppApi\ApiException\Exceptions\ForbiddenException;

class IsSellerMiddleware
{
	public function handle($request, Closure $next)
	{
		$user = auth()->user();
		if (!$user->isSeller()) {
			throw new ForbiddenException('You are not a seller.');
		}

		return $next($request);
	}
}
