<?php namespace AppAlgolia\AlgoliaSearch;

use System\Classes\PluginBase;
use AppAlgolia\AlgoliaIndex\Classes\Hooks\Ads;

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
            'name' => 'AlgoliaSearch',
            'description' => 'No description provided yet...',
            'author' => 'AppAlgolia',
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
//		Ads::handle();
    }
}
