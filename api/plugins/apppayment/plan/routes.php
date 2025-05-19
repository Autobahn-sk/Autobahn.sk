<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use AppUser\UserApi\Http\Middlewares\Check;

Route::group([
    'prefix'      => 'api/v1',
	'namespace'  => 'AppPayment\Plan\Http\Controllers',
    'middleware' => [
        'api',
		Check::class
    ],
], function (Router $router) {
    $router
        ->get('plans', 'PlanController');
});