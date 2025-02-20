<?php

use Illuminate\Routing\Router;
use AppAd\Ad\Http\ModelBinds\AdModelBind;
use AppAd\Ad\Http\ModelBinds\UserModelBind;
use AppAd\Ad\Http\Middlewares\AdPolicyMiddleware;
use AppUser\UserApi\Http\Middlewares\Authenticate;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppAd\AdPrice\Http\Controllers',
    'middleware' => [
		'api',
		UserModelBind::class,
		AdModelBind::class,
		AdPolicyMiddleware::class
    ],
], function(Router $router) {
	$router
		->post('price', 'PriceController@store')
		->middleware([Authenticate::class]);

	$router
		->post('price-offer', 'PriceController@storePriceOffer')
		->middleware([Authenticate::class]);
});

