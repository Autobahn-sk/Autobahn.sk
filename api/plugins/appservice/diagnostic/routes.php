<?php

use Illuminate\Routing\Router;
use AppUser\UserApi\Http\Middlewares\Authenticate;
use AppService\Diagnostic\Http\ModelBinds\UserModelBind;
use AppService\Diagnostic\Http\ModelBinds\DiagnosticModelBind;
use AppService\Diagnostic\Http\Middlewares\SubscriptionPolicyMiddleware;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppService\Diagnostic\Http\Controllers',
    'middleware' => [
		'api',
		Authenticate::class,
		UserModelBind::class
	],
], function(Router $router) {
	$router
		->get('diagnostics/{diagnostic}', 'DiagnosticController@show')
		->middleware([DiagnosticModelBind::class])
		->name('diagnostics.show');

	$router
		->post('diagnostics', 'DiagnosticController@store')
		->middleware([SubscriptionPolicyMiddleware::class])
		->name('diagnostics.store');
});