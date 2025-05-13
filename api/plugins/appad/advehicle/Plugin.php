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
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'advehicle' => [
                'label' => 'Vehicles',
                'url' => Backend::url('appad/advehicle/vehiclemanufacturers'),
                'icon' => 'icon-truck',
                'permissions' => ['appad.advehicle.*'],
                'order' => 500,
				'sideMenu'    => [
					'vehiclemanufacturers' => [
						'label'       => 'Vehicle Manufacturers',
						'icon'        => 'icon-building',
						'url'         => Backend::url('appad/advehicle/vehiclemanufacturers'),
						'permissions' => ['appad.advehicle.*']
					],
					'vehiclefeatures'      => [
						'label'       => 'Vehicle Features',
						'icon'        => 'icon-bolt',
						'url'         => Backend::url('appad/advehicle/vehiclefeatures'),
						'permissions' => ['appad.advehicle.*']
					]
				]
            ],
        ];
    }
}
