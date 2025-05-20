<?php namespace AppGoogle\GoogleUserAuth\Classes\Extend\Hook;

use October\Rain\Support\Facades\Event;
use AppGoogle\GoogleUserAuth\Classes\GoogleUtils;

class GoogleAuth
{
    public static function hookUserApiBeforeLogin()
    {
        Event::listen('appuser.userapi.beforeLogin', function () {
            if (input('social') != 'google') {
                return;
            }

			return GoogleUtils::getUserOrCreate();
        });
    }
}
