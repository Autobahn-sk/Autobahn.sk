<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use AppUser\UserFlag\Http\ModelBinds\UserModelBind;
use AppUser\UserApi\Http\Middlewares\Check as AuthCheck;
use AppUser\UserApi\Http\Middlewares\Authenticate as Auth;

Route::group([
    'prefix'      => 'api/v1',
    'namespace'  => 'AppUser\UserFlag\Http\Controllers',
    'middleware' => [
		'api',
        AuthCheck::class,
		UserModelBind::class
    ]
], function(Router $router) {
    $router
        ->post('userflag/{model}/{id}', 'UserFlagController@storeOrUpdate');

    $router
        ->middleware(Auth::class)
        ->group(function(Router $router) {
            $router
                ->get('userflag/flags/{model}/{id}', 'UserFlagController@getFlags_modelAndId');
            $router
                ->get('userflag/flags/{model}', 'UserFlagController@getFlags_model');
            $router
                ->get('userflag/models/{model}/{type}', 'UserFlagController@getModels_modelAndType');
            $router
                ->get('userflag/models/{type}', 'UserFlagController@getModels_type');
        });
});
