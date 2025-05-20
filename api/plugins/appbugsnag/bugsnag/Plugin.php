<?php namespace AppBugsnag\Bugsnag;

use Bugsnag\Client;
use Bugsnag\Handler;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
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
            'name'        => 'Bugsnag',
            'description' => 'No description provided yet...',
            'author'      => 'AppBugsnag',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
		//
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $bugsnag = Client::make(env('BUGSNAG_API_KEY'));
        $bugsnag->setReleaseStage(env('APP_ENV'));
        $bugsnag->setAppVersion(env('APP_VERSION'));

		$bugsnag->setErrorReportingLevel(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_NOTICE);

		$bugsnag->startSession();
        Handler::register($bugsnag);
    }
}
