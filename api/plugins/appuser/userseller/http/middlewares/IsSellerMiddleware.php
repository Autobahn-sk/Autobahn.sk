<?php namespace AppUser\UserSeller\Http\Middlewares;

use Closure;
use AppApi\ApiException\Exceptions\BadRequestException;

class IsSellerMiddleware
{
	public function handle($request, Closure $next)
	{
		$routeGroup = explode('.', $request->route()->getName());
		$routeAction = $request->route()->getActionMethod();

		$user = $request->route()->parameter('user');

		switch ($routeGroup[0]) {
			case 'ads':
				$allowedToPerformAction = false;

				switch ($routeAction) {
					case 'store':
					case 'update':
					case 'destroy':
						if (isset($user) && $user->isSeller()) {
							$allowedToPerformAction = true;
						}

						if (!$allowedToPerformAction) {
							throw new BadRequestException('Nie ste predajca.');
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
