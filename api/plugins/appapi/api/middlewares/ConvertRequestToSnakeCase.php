<?php namespace AppApi\Api\Middlewares;

use Closure;
use Illuminate\Http\Request;
use AppApi\Api\Classes\KeyCaseConverter;

class ConvertRequestToSnakeCase
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
      $request->replace(
         KeyCaseConverter::convert(
            KeyCaseConverter::CASE_SNAKE,
            $request->all()
         )
      );

      return $next($request);
   }
}
