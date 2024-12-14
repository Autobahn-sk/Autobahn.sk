<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppCommerce\Newsletter\Http\Controllers',
    'middleware' => [
        'api',
		'throttle:60,1'
	]
], function (Router $router) {
    $router
        ->post('newsletter/subscribe', 'NewsletterController@store');
    $router
        ->post('newsletter/unsubscribe', 'NewsletterController@destroy');
});
