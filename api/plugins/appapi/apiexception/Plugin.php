<?php namespace AppApi\ApiException;

use System\Classes\PluginBase;
use Illuminate\Contracts\Debug\ExceptionHandler;
use AppApi\ApiException\Handlers\ApiExceptionHandler;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
	/*
     * Dependencies
     */
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

	public function boot()
	{
		//
	}
}
