<?php namespace AppDev\Seed;

use System\Classes\PluginBase;

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
            'name' => 'Seed',
            'description' => 'No description provided yet...',
            'author' => 'AppDev',
            'icon' => 'icon-leaf'
        ];
    }
}
