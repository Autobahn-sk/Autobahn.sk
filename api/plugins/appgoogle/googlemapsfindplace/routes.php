<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppGoogle\GoogleMapsFindPlace\Http\Controllers',
    'middleware' => [
        'api',
		'throttle:60,1'
    ]
], function (Router $router) {
    $router
        ->get('google-maps/find-place', 'FindPlaceController');
});
