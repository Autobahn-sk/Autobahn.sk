<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppCommerce\ContactForm\Http\Controllers',
    'middleware' => [
        'api'
    ]
], function (Router $router) {
    $router
        ->post('contact', 'ContactFormsController');
});
