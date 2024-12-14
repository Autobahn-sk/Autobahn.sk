<?php namespace AppGoogle\GoogleUserAuth;

use System\Classes\PluginBase;
use AppGoogle\GoogleUserAuth\Classes\Extend\Hook\GoogleAuth;

class Plugin extends PluginBase
{
    public $require = [
        'AppUser.UserApi'
    ];

    public function pluginDetails()
    {
        return [
            'name' => 'GoogleUserAuth',
            'description' => 'No description provided yet...',
            'author' => 'AppGoogle',
            'icon' => 'icon-leaf'
        ];
    }

    public function register()
    {
        $servicesConfig = config('services');
        $servicesConfig['google'] = [
            'client_id'     => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect'      => $this->_getRedirectURL()
        ];

        config([
            'services' => $servicesConfig
        ]);
    }

    public function boot()
    {
        GoogleAuth::hookUserApiBeforeLogin();
    }

    protected function _getRedirectURL()
    {
        if (env('APP_DEBUG') && isset($_SERVER['HTTP_REFERER']) && starts_with($_SERVER['HTTP_REFERER'], 'http://localhost')) {
            return substr($_SERVER['HTTP_REFERER'], 0, -1);
        }

        return env('GOOGLE_REDIRECT');
    }
}
