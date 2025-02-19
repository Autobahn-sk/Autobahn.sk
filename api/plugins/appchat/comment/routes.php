<?php

use Illuminate\Routing\Router;
use AppChat\Comment\Http\ModelBinds\ModelBind;
use AppChat\Comment\Http\ModelBinds\UserModelBind;
use AppUser\UserApi\Http\Middlewares\Check as AuthCheck;
use AppUser\UserApi\Http\Middlewares\Authenticate as Auth;
use AppChat\Comment\Http\middlewares\CommentPolicyMiddleware;

Route::group([
    'prefix'     => 'api/v1',
    'namespace'  => 'AppChat\Comment\Http\Controllers',
    'middleware' => [
		'api',
        AuthCheck::class,
		UserModelBind::class,
        ModelBind::class,
		CommentPolicyMiddleware::class
    ],
], function(Router $router) {
    $router
        ->get('comments/{node}/{id}', 'CommentController@index')
        ->middleware(config('appchat.comment::unregistered_user_allowed_to_read') ? [] : [Auth::class])
        ->name('comments.index');
    
    $router
        ->post('comments/{node}/{id}', 'CommentController@store')
        ->middleware([Auth::class])
        ->name('comments.store');
    
    $router
        ->get('comments/{comment}', 'CommentController@show')
        ->middleware(config('appchat.comment::unregistered_user_allowed_to_read') ? [] : [Auth::class])
        ->name('comments.show');
    
    $router
        ->delete('comments/{comment}', 'CommentController@destroy')
        ->middleware([Auth::class])
        ->name('comments.destroy');
    
    $router
        ->post('comments/{comment}', 'CommentController@update')
        ->middleware([Auth::class])
        ->name('comments.update');
});

