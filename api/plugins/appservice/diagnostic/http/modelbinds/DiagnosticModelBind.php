<?php namespace AppService\Diagnostic\Http\ModelBinds;

use Closure;
use AppService\Diagnostic\Models\Diagnostic;

class DiagnosticModelBind
{
    public function handle($request, Closure $next)
    {
		if ($request->route()->hasParameter('diagnostic') && is_numeric($request->route()->parameter('diagnostic'))) {
			$request->route()->setParameter('diagnostic', Diagnostic::findOrFail($request->route()->parameter('diagnostic')));
		}

		return $next($request);
	}
}