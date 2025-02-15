<?php namespace AppAd\AdVehicle;

use Backend;
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
            'name' => 'AdVehicle',
            'description' => 'No description provided yet...',
            'author' => 'AppAd',
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
        //
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'AppAd\AdVehicle\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'appad.advehicle.some_permission' => [
                'tab' => 'AdVehicle',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'advehicle' => [
                'label' => 'AdVehicle',
                'url' => Backend::url('appad/advehicle/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['appad.advehicle.*'],
                'order' => 500,
            ],
        ];
    }
}
