<?php namespace AppPayment\Plan;

use Backend;
use System\Classes\PluginBase;

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
            'name' => 'Plan',
            'description' => 'No description provided yet...',
            'author' => 'AppPayment',
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
            'plan' => [
                'label' => 'Plans',
                'url' => Backend::url('apppayment/plan/plans'),
                'icon' => 'icon-object-group',
                'permissions' => ['apppayment.plan.*'],
                'order' => 500,
            ],
        ];
    }
}
