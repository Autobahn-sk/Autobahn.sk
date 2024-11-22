<?php namespace AppApi\Cors;

use System\Classes\PluginBase;
use Illuminate\Contracts\Http\Kernel;
use AppApi\Cors\Http\Middlewares\CorsMiddleware;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Cors',
            'description' => 'No description provided yet...',
            'author' => 'AppApi',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
		$this->app[Kernel::class]
			->prependMiddleware(CorsMiddleware::class);
    }
}
