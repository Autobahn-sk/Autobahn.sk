<?php namespace AppApi\Api;

use System\Classes\PluginBase;
use AppApi\Api\Console\CreateModelBind;

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
            'name' => 'Api',
            'description' => 'No description provided yet...',
            'author' => 'AppApi',
            'icon' => 'icon-leaf',
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('create.modelbind', CreateModelBind::class);
    }

	public function boot()
	{
		//
	}
}
