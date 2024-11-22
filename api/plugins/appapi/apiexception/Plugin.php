<?php namespace AppApi\ApiException;

use System\Classes\PluginBase;
use Illuminate\Contracts\Debug\ExceptionHandler;
use AppApi\ApiException\Handlers\ApiExceptionHandler;

class Plugin extends PluginBase
{
    public $require = [
        'AppApi.ApiResponse'
    ];

    public function pluginDetails()
    {
        return [
            'name' => 'ApiException',
            'description' => 'No description provided yet...',
            'author' => 'AppApi',
            'icon' => 'icon-leaf',
        ];
    }

    public function register()
    {
        $this->app->singleton(
            ExceptionHandler::class,
			ApiExceptionHandler::class
        );
    }
}
