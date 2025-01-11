<?php namespace AppUser\UserSeller;

use System\Classes\PluginBase;
use AppUser\UserSeller\Classes\Extend\UserExtendIsSeller;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
	/*
     * Dependencies
     */
	public $require = [
		'RainLab.User'
	];

    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'UserSeller',
            'description' => 'No description provided yet...',
            'author' => 'AppUser',
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
		UserExtendIsSeller::addIsSellerToColumns();
		UserExtendIsSeller::addIsSellerToFields();
		UserExtendIsSeller::addIsSellerToResource();
		UserExtendIsSeller::addIsSellerAsFillable();
		UserExtendIsSeller::addIsSellerRules();
    }
}
