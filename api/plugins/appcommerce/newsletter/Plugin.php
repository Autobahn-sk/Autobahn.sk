<?php namespace AppCommerce\Newsletter;

use System\Classes\PluginBase;

/**
 * Newsletter Plugin Information File
 */
class Plugin extends PluginBase
{
	public $require = [
		'RainLab.User',
		'AppApi.ApiResponse'
	];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Newsletter',
            'description' => 'No description provided yet...',
            'author'      => 'AppCommerce',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
		//
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
		//
    }
}
