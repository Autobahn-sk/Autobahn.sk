<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::group([], function () {
    $placeholder = 'fallbackPlaceholder';
    
    $allowedMethods = collect(explode(',', config('appapi.routefallback::methods')));
    $allowedMethods->each(function ($item, $key) use (&$allowedMethods) {
        $allowedMethods[$key] = strtoupper(trim($item));
    });

    Route::addRoute(
        $allowedMethods->toArray(), "{{$placeholder}}", function () {
            throw new NotFoundHttpException('Route not found');
        }
    )->where($placeholder, '.*')->fallback();
});

