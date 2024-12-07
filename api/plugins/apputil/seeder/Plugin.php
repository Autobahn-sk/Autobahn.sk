<?php namespace AppUtil\Seeder;

use System\Classes\PluginBase;
use AppUtil\Seeder\Console\Seed;
use Illuminate\Support\Facades\App;
use AppUtil\Seeder\Classes\Providers;
use AppUtil\Seeder\Facades\SeederProviders;

/**
 * seeder Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Seeder',
            'description' => 'Seed models from data source.',
            'author' => 'AppUtil',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('seed', Seed::class);

        App::singleton('apputil.seeder.providers', function () {
            return new Providers();
        });

        SeederProviders::add([
            Providers\JsonProvider::class
        ]);
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }
}
