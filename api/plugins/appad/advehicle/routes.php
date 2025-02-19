<?php

use Illuminate\Routing\Router;
use AppAd\Ad\Http\ModelBinds\AdModelBind;
use AppAd\Ad\Http\ModelBinds\UserModelBind;

Route::group([
    'prefix'     => 'api/v1',
    'namespace'  => 'AppAd\Ad\Http\Controllers',
    'middleware' => [
		'api',
		AdModelBind::class,
		UserModelBind::class
    ],
], function(Router $router) {
	$router
		->get('ads', 'AdController@index');

	$router
		->get('ads/{ad}', 'AdController@show');
});

