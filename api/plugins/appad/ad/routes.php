<?php

use Illuminate\Routing\Router;
use AppAd\Ad\Http\ModelBinds\AdModelBind;
use AppAd\Ad\Http\ModelBinds\UserModelBind;
use AppAd\Ad\Http\Middlewares\AdPolicyMiddleware;
use AppUser\UserApi\Http\Middlewares\Authenticate;
use AppUser\UserSeller\Http\Middlewares\IsSellerMiddleware;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppAd\Ad\Http\Controllers',
    'middleware' => [
		'api',
		AdModelBind::class
    ],
], function(Router $router) {
	$router
		->get('ads', 'AdController@index')
		->name('ads.index');

	$router
		->get('ads/{ad}', 'AdController@show')
		->name('ads.show');

	$router
		->get('ads-search', 'AdController@search')
		->name('ads.search');

	Route::group([
		'middleware' => [
			Authenticate::class,
			UserModelBind::class,
			AdPolicyMiddleware::class,
			IsSellerMiddleware::class
		],
	], function(Router $router) {
		$router
			->post('ads', 'AdController@store')
			->name('ads.store');

		$router
			->post('ads/{ad}', 'AdController@update')
			->name('ads.update');

		$router
			->delete('ads/{ad}', 'AdController@destroy')
			->name('ads.destroy');

		$router
			->post('ads-generate-ad-description/{ad}', 'AdController@generateAdDescription')
			->name('ads.generate-ad-description');
	});
});

