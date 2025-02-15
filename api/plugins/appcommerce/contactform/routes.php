<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppCommerce\ContactForm\Http\Controllers',
    'middleware' => [
		'api',
		'throttle:60,1'
    ]
], function (Router $router) {
    $router
        ->post('contact', 'ContactFormsController');
});
