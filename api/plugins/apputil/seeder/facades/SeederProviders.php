<?php namespace AppUtil\Seeder\Facades;

use Illuminate\Support\Facades\Facade;

class SeederProviders extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'apputil.seeder.providers';
    }
}
