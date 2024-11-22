<?php namespace AppApi\ApiResponse;

use System\Classes\PluginBase;
use Illuminate\Contracts\Http\Kernel;
use AppApi\ApiResponse\Middlewares\ApiResourceMiddleware;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'ApiResponse',
            'description' => 'No description provided yet...',
            'author' => 'AppApi',
            'icon' => 'icon-leaf',
        ];
    }

    public function boot()
    {
        $this->app[Kernel::class]->prependMiddleware(ApiResourceMiddleware::class);
    }
}
