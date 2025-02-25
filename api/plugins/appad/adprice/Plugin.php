<?php namespace AppAd\AdPrice;

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
            'name' => 'AdPrice',
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
            'adprice' => [
                'label' => 'Price Offers',
                'url' => Backend::url('appad/adprice/priceoffers'),
                'icon' => 'icon-money',
                'permissions' => ['appad.adprice.*'],
                'order' => 500,
            ],
        ];
    }

	public function registerMailTemplates()
	{
		return [
			'appad.adprice::mail.offer'
		];
	}
}
