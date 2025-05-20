<?php namespace AppApi\Traits;

use System\Classes\PluginBase;

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
            'name'        => 'Traits',
            'description' => 'No description provided yet...',
            'author'      => 'AppApi',
            'icon'        => 'icon-leaf'
        ];
    }

	public function register()
	{
		//
	}

	public function boot()
	{
		//
	}
}
