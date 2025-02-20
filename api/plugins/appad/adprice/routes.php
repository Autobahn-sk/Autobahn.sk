<?php

use Illuminate\Routing\Router;
use AppAd\Ad\Http\ModelBinds\AdModelBind;
use AppAd\Ad\Http\ModelBinds\UserModelBind;
use AppAd\Ad\Http\Middlewares\AdPolicyMiddleware;
use AppUser\UserApi\Http\Middlewares\Authenticate;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppAd\Ad\Http\Controllers',
    'middleware' => [
		'api',
		UserModelBind::class,
		AdModelBind::class,
		AdPolicyMiddleware::class
    ],
], function(Router $router) {
	$router
		->get('ads', 'AdController@index');

	$router
		->get('ads/{ad}', 'AdController@show');

	$router
		->post('ads', 'AdController@store')
		->middleware([Authenticate::class]);

	$router
		->post('ads/{ad}', 'AdController@update')
		->middleware([Authenticate::class]);

	$router
		->delete('ads/{ad}', 'AdController@destroy')
		->middleware([Authenticate::class]);
});

