<?php namespace AppQna\Qna;

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
            'name' => 'Qna',
            'description' => 'No description provided yet...',
            'author' => 'AppQna',
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
            'qna' => [
                'label' => 'Qna',
                'url' => Backend::url('appqna/qna/questions'),
                'icon' => 'icon-question',
                'permissions' => ['appqna.qna.*'],
                'order' => 500,
            ],
        ];
    }
}