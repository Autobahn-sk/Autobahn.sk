<?php

use Illuminate\Routing\Router;
use AppAd\Ad\Http\ModelBinds\AdModelBind;
use AppAd\Ad\Http\ModelBinds\UserModelBind;
use AppUser\UserApi\Http\Middlewares\Authenticate;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppAd\AdPrice\Http\Controllers',
    'middleware' => [
		'api',
		AdModelBind::class
	],
], function(Router $router) {
	$router
		->get('ad-price-history/{ad}', 'PriceController@adPriceHistory')
		->name('ads.ad-price-history');

	$router
		->post('price-offer/{ad}', 'PriceController@storePriceOffer')
		->middleware([Authenticate::class, UserModelBind::class])
		->name('ads.storePriceOffer');
});

