<?php namespace AppUser\UserFlag;

use Backend\Facades\Backend;
use System\Classes\PluginBase;
use AppUser\UserFlag\Classes\Extend\UserExtend;

/**
 * UserFlag Plugin Information File
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
            'name'        => 'UserFlag',
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

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        UserExtend::addMethod_getFlaggedModels();
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'userflag' => [
                'label'       => 'User flags',
                'url'         => Backend::url('appuser/userflag/userflags'),
                'icon'        => 'icon-flag',
                'permissions' => ['appuser.userflag.*'],
                'order'       => 500
            ]
        ];
    }
}
