<?php namespace AppAd\Ad;

use Backend;
use System\Classes\PluginBase;
use AppUser\UserFlag\Classes\Services\UserFlagService;

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
            'name' => 'Ad',
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
		UserFlagService::addTypeStatusToResource('appad.ad.ad.beforeReturnResource', 'bookmark', 'bookmark_by_active_user');
		UserFlagService::addTypeStatusToResource('appad.ad.adSimple.beforeReturnResource', 'bookmark', 'bookmark_by_active_user');
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return [
            'appad.ad.some_permission' => [
                'tab' => 'Ad',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'ad' => [
                'label' => 'Ads',
                'url' => Backend::url('appad/ad/ads'),
                'icon' => 'icon-car',
                'permissions' => ['appad.ad.*'],
                'order' => 500,
            ],
        ];
    }
}
