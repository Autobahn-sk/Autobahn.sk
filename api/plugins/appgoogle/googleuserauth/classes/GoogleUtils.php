<?php namespace AppGoogle\GoogleUserAuth\Classes;

use Google_Client;
use System\Models\File;
use AppUser\UserApi\Models\User;
use Illuminate\Support\Facades\Event;
use AppApi\ApiException\Exceptions\BadRequestException;

class GoogleUtils
{
    public static function getUserOrCreate()
    {
        $googleProfile = self::_getGoogleProfile();

        $user = User::findByEmail($googleProfile['email']);
        if (!$user) {
            $user = self::_createAccounts($googleProfile);
        }

        return $user;
    }

    private static function _createAccounts($googleProfile)
    {
        $params = [
            'email' => $googleProfile['email'],
            'name'  => $googleProfile['given_name'] ?? ' ' . $googleProfile['family_name'] ?? '',
		];

        $password = md5(time() . \Str::random(30));
        $params['password'] = $password;
        $params['password_confirmation'] = $password;

        $user = new User($params);

        if ($googleProfile['picture']) {
            $user->avatar = (new File)->fromUrl($googleProfile['picture']);
        }

        Event::fire('appgoogle.logingoogle.beforeCreate', [$user]);

        $user->save();

        return $user;
    }

    private static function _getGoogleProfile()
    {
        $client = new Google_Client([
            'client_id' => env('GOOGLE_CLIENT_ID')
        ]);

        $payload = $client->verifyIdToken(input('code'));

        if (!$payload) throw new BadRequestException("Couldn't login.");

        return [
            'given_name'  => $payload['given_name'],
            'family_name' => $payload['family_name'],
            'email'       => $payload['email'],
            'picture'     => $payload['picture'] ?? null
        ];
    }
}
