<?php namespace AppUser\Report;

use Backend\Facades\Backend;
use System\Classes\PluginBase;
use AppUser\Report\Classes\Extend\UserExtend;

/**
 * Report Plugin Information File
 */
class Plugin extends PluginBase
{
    /*
     * Dependencies
     */
    public $require = [
        'AppUser.UserApi'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Report',
            'description' => 'No description provided yet...',
            'author'      => 'AppUser',
            'icon'        => 'icon-leaf'
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
        UserExtend::addReportsRelationToUser();
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'appuser.report.manage' => [
                'tab'   => 'Report',
                'label' => 'Manage'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'report' => [
                'label'       => 'Reports',
                'url'         => Backend::url('appuser/report/userreports'),
                'icon'        => 'icon-exclamation-triangle',
                'permissions' => ['appuser.report.*'],
                'order'       => 500
            ]
        ];
    }
}
