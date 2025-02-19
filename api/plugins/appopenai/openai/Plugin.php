<?php namespace AppOpenAI\OpenAI;

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
            'name' => 'OpenAI',
            'description' => 'No description provided yet...',
            'author' => 'AppOpenAI',
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
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'AppOpenAI\OpenAI\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'appopenai.openai.some_permission' => [
                'tab' => 'OpenAI',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'openai' => [
                'label' => 'OpenAI',
                'url' => Backend::url('appopenai/openai/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['appopenai.openai.*'],
                'order' => 500,
            ],
        ];
    }
}
