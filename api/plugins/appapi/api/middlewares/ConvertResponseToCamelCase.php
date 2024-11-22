<?php namespace AppApi\Api\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use AppApi\Api\Classes\KeyCaseConverter;

class ConvertResponseToCamelCase
{
   /**
    * Handle an incoming request.
    *
    * @param Request $request
    * @param Closure $next
    * @return mixed
    */
   public function handle(Request $request, Closure $next)
   {
      $response = $next($request);

      if ($response instanceof JsonResponse) {
         $response->setData(
            KeyCaseConverter::convert(
               KeyCaseConverter::CASE_CAMEL,
               json_decode($response->content(), true)
            )
         );
      }

      return $response;
   }
}
