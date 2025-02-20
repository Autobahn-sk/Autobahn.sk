<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'     => 'api/v1',
    'namespace'  => 'AppAd\AdVehicle\Http\Controllers',
    'middleware' => [
		'api'
    ],
], function(Router $router) {
	$router
		->get('vehicle-manufacturers', 'VehicleManufacturerController');
});

