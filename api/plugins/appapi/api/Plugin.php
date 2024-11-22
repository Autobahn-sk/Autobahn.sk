<?php namespace AppApi\Api;

use System\Classes\PluginBase;
use AppApi\Api\Console\CreateModelBind;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Api',
            'description' => 'No description provided yet...',
            'author' => 'AppApi',
            'icon' => 'icon-leaf',
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('create.modelbind', CreateModelBind::class);
    }
}
