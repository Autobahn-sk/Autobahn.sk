<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use AppUser\UserApi\Http\Middlewares\Authenticate;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppUser\Report\Http\Controllers',
    'middleware' => [
        'api',
        Authenticate::class
    ]
], function (Router $router) {
    $router
        ->post('reports', 'UserReportsController@store');
});
