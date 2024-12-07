<?php namespace AppUtil\Importer;

use Backend\Facades\Backend;
use System\Classes\PluginBase;

/**
 * Importer Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
		'AppUtil.Seeder'
	];

    public function pluginDetails()
    {
        return [
            'name' => 'Importer',
            'description' => 'Imports data from CSV file',
            'author' => 'AppUtil',
            'icon' => 'icon-list'
        ];
    }

    public function registerNavigation()
    {
        return [
            'importer' => [
                'label' => 'Import',
                'url' => Backend::url('apputil/importer/import'),
                'icon' => 'icon-list'
            ]
        ];
    }
}
