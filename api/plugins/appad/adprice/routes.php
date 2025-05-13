<?php

use Illuminate\Routing\Router;
use AppAd\Ad\Http\ModelBinds\AdModelBind;
use AppAd\Ad\Http\ModelBinds\UserModelBind;
use AppAd\Ad\Http\Middlewares\AdPolicyMiddleware;
use AppUser\UserApi\Http\Middlewares\Authenticate;
use AppUser\UserSeller\Http\Middlewares\IsSellerMiddleware;

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

	Route::group([
		'middleware' => [
			Authenticate::class,
			UserModelBind::class,
		],
	], function(Router $router) {
		$router
			->post('price/{ad}', 'PriceController@store')
			->middleware([AdPolicyMiddleware::class, IsSellerMiddleware::class])
			->name('ads.update');

		$router
			->post('price-offer/{ad}', 'PriceController@storePriceOffer')
			->name('ads.storePriceOffer');
	});
});

