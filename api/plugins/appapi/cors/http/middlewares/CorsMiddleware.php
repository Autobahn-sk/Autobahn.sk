<?php namespace AppApi\Cors\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
	public array $headers;

	public function __construct()
	{
		$this->headers = self::_prepareHeaders();
	}

	public function handle(Request $request, Closure $next): mixed
	{
		if ($request->isMethod('OPTIONS')) {
			return response('', 200, $this->headers);
		}

		$response = $next($request);
		$response->headers->add($this->headers);

		return $response;
	}

	static function _prepareHeaders(): array
	{
		$defaultHeaders = 'Authorization, Content-Type, Origin, Accept-Language, Content-Language';
		$defaultMethods = 'GET, HEAD, POST, PUT, DELETE, CONNECT, OPTIONS, TRACE, PATCH';

		return [
			'Access-Control-Allow-Origin'  => config('appapi.cors::origin', '*'),
			'Access-Control-Allow-Headers' => config('appapi.cors::headers', $defaultHeaders),
			'Access-Control-Allow-Methods' => config('appapi.cors::methods', $defaultMethods)
		];
	}
}