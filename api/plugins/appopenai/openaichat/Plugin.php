<?php namespace AppOpenAI\OpenAIChat;

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
            'name' => 'OpenAIChat',
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
            'AppOpenAI\OpenAIChat\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'appopenai.openaichat.some_permission' => [
                'tab' => 'OpenAIChat',
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
            'openaichat' => [
                'label' => 'OpenAIChat',
                'url' => Backend::url('appopenai/openaichat/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['appopenai.openaichat.*'],
                'order' => 500,
            ],
        ];
    }
}
