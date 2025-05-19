<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use AppUser\UserApi\Http\Middlewares\Authenticate;
use AppPayment\Subscription\Http\ModelBinds\PlanModelBind;
use AppPayment\Subscription\Http\ModelBinds\UserModelBind;

Route::group([
    'prefix'      => 'api/v1/payment',
	'namespace'  => 'AppPayment\Subscription\Http\Controllers',
    'middleware' => [
        'api'
    ],
], function (Router $router) {
    $router->group([
		'middleware' => [
			PlanModelBind::class,
			Authenticate::class,
			UserModelBind::class
		]
	], function () use ($router) {
        $router
            ->get('subscriptions', 'SubscriptionsController@index');
        $router
            ->get('subscriptions/{plan}', 'SubscriptionsController@show');
        $router
            ->post('subscriptions/{plan}', 'SubscriptionsController@store');
        $router
            ->delete('subscriptions/{plan}', 'SubscriptionsController@destroy');
    });

    $router
        ->post('subscriptions/hook', 'SubscriptionsHookController@hook');
});