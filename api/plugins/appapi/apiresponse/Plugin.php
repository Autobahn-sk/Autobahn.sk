<?php namespace AppApi\ApiResponse;

use System\Classes\PluginBase;
use Illuminate\Contracts\Http\Kernel;
use AppApi\ApiResponse\Middlewares\ApiResourceMiddleware;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'ApiResponse',
            'description' => 'No description provided yet...',
            'author' => 'AppApi',
            'icon' => 'icon-leaf',
        ];
    }

	public function register()
	{
		//
	}

    public function boot()
    {
        $this->app[Kernel::class]->prependMiddleware(ApiResourceMiddleware::class);
    }
}
