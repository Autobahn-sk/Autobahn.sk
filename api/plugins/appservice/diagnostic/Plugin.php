<?php namespace AppService\Diagnostic;

use Backend;
use System\Classes\PluginBase;
use AppService\Diagnostic\Classes\Extend\UserExtend;

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
            'name' => 'Diagnostic',
            'description' => 'No description provided yet...',
            'author' => 'AppService',
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
		UserExtend::addDiagnosticsToModelUser();
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'diagnostic' => [
                'label' => 'Diagnostics',
                'url' => Backend::url('appservice/diagnostic/diagnostics'),
                'icon' => 'icon-wrench',
                'permissions' => ['appservice.diagnostic.*'],
                'order' => 500,
            ],
        ];
    }
}
