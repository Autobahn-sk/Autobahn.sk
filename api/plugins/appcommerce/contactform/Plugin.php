<?php namespace AppCommerce\ContactForm;

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
            'name'        => 'ContactForm',
            'description' => 'No description provided yet...',
            'author'      => 'AppCommerce',
            'icon'        => 'icon-envelope-o'
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

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'appcommerce.contactform.access_contactforms' => [
                'tab'   => 'ContactForm',
                'label' => 'Allow to access Contact Forms'
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'contactform' => [
                'label'       => 'Kontakty',
                'description' => 'Správy z kontaktného formuáru.',
                'category'    => env('APP_NAME'),
                'icon'        => 'icon-envelope-o',
                'url'         => Backend::url('appcommerce/contactform/contactforms'),
                'order'       => 400,
                'keywords'    => 'kontakt správy',
                'permissions' => ['appcommerce.contactform.access_contactforms']
            ]
        ];
    }

	public function registerMailTemplates()
	{
		return [
			'appcommerce.contactform::mail.new-request'
		];
	}
}
