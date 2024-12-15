<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
	'prefix' => 'api/v1',
	'namespace' => 'AppQna\Qna\Http\Controllers',
	'middleware' => [
		'api'
	]
], function (Router $router) {
	$router
		->get('qna', 'QnaController');
});
