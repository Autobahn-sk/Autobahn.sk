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
		AdModelBind::class,
		Authenticate::class,
		UserModelBind::class
	],
], function(Router $router) {
	$router
		->get('price-offers/{ad}', 'PriceOfferController@getPriceOffers')
		->middleware([AdPolicyMiddleware::class, IsSellerMiddleware::class])
		->name('ads.get-price-offers');

	$router
		->post('price-offers/{ad}', 'PriceOfferController@storePriceOffer')
		->name('ads.store-price-offer');
});

