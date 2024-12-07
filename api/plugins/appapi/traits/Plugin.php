<?php namespace AppApi\Traits;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Traits',
            'description' => 'No description provided yet...',
            'author'      => 'AppApi',
            'icon'        => 'icon-leaf'
        ];
    }
}
