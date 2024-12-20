<?php

return [
    'resources' => [
        'user' => 'AppUser\UserApi\Http\Resources\UserResource',
    ],

    'routes' => [
        'prefix' => 'api/v1/auth',
        'actions' => [
            'signup' => [
                'route' => 'signup',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\SignupApiController',
                'middlewares' => [],
            ],
            'login' => [
                'route' => 'login',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\LoginApiController',
                'middlewares' => [],
            ],
            'invalidate' => [
                'route' => 'invalidate',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\InvalidateApiController',
                'middlewares' => [],
            ],
            'refresh' => [
                'route' => 'refresh',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\RefreshApiController',
                'middlewares' => [],
            ],
            'forgot' => [
                'route' => 'forgot',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\ForgotApiController',
                'middlewares' => [
                    'throttle:5,1',
                ],
            ],
            'reset' => [
                'route' => 'reset',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\ResetApiController',
                'middlewares' => [],
            ],
            'info' => [
                'route' => 'info',
                'method' => 'GET',
                'controller' => 'AppUser\UserApi\Http\Controllers\InfoApiController',
                'middlewares' => [
                    'AppUser\UserApi\Http\Middlewares\Authenticate',
                ],
            ],
            'infoUpdate' => [
                'route' => 'info',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\InfoUpdateApiController',
                'middlewares' => [
                    'AppUser\UserApi\Http\Middlewares\Authenticate',
                ],
            ],
            'deactivate' => [
                'route' => 'deactivate',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\DeactivateApiController',
                'middlewares' => [
                    'AppUser\UserApi\Http\Middlewares\Authenticate',
                ],
            ],
            'checkForgotCode' => [
                'route' => 'check/forgot/code',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\CheckForgotCodeApiController',
                'middlewares' => [
                    'throttle:5,1',
                ],
            ],
            'verifyEmail' => [
                'route' => 'verify/email',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\VerifyEmailApiController',
                'middlewares' => [
                    'AppUser\UserApi\Http\Middlewares\Authenticate',
                    'throttle:5,1',
                ],
            ],
            'verifyEmailResend' => [
                'route' => 'verify/email/resend',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\VerifyEmailResendApiController',
                'middlewares' => [
                    'AppUser\UserApi\Http\Middlewares\Authenticate',
                    'throttle:5,1',
                ],
            ],
            'checkEmail' => [
                'route' => 'check/email',
                'method' => 'POST',
                'controller' => 'AppUser\UserApi\Http\Controllers\CheckEmailApiController',
                'middlewares' => [
                    'throttle:5,1',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Telephone Activation mode
    |--------------------------------------------------------------------------
    |
    | Select how a user account should be activated.
    |
    | true    You need to verify the phone number.
    | false   The user does not need to verify the phone number.
    |
    |
    */

    'phone_activation' => 'true',

    /*
    |--------------------------------------------------------------------------
    | Password Reset Code Expiration Time
    |--------------------------------------------------------------------------
    |
    | Select how many seconds a password reset code should be valid.
    |
    |  60 - 1 minute
    |
    */

    'password_reset_code_expiration_time' => 300,

    /*
    |--------------------------------------------------------------------------
    | Telephone/Email Verification Code Expiration Time
    |--------------------------------------------------------------------------
    |
    | Select how many seconds a phone verification code should be valid.
    |
    |  60 - 1 minute
    |
    */

    'phone_verification_code_expiration_time' => 300,
    'email_verification_code_expiration_time' => 300,

    /*
    |--------------------------------------------------------------------------
    | JWT token access time
    |--------------------------------------------------------------------------
    |
    | Select how a user account should be activated.
    |
    | email  After you register as Guest user and verify your email you will get JWT token
    | phone  After you register as Guest user and verify your phone_number you will get JWT token
    | login  After you login with your email and password you will get JWT token
    |
    |
    */

    'jwt_token_access_time' => 60,

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret
    |--------------------------------------------------------------------------
    |
    | Don't forget to set this in your .env file, as it will be used to sign
    | your tokens. A helper command is provided for this:
    | `php artisan jwt:secret`
    |
    | Note: This will be used for Symmetric algorithms only (HMAC),
    | since RSA and ECDSA use a private/public key combo (See below).
    |
    */

    'secret' => env('JWT_SECRET', config('app.key')),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Keys
    |--------------------------------------------------------------------------
    |
    | The algorithm you are using, will determine whether your tokens are
    | signed with a random string (defined in `JWT_SECRET`) or using the
    | following public & private keys.
    |
    | Symmetric Algorithms:
    | HS256, HS384 & HS512 will use `JWT_SECRET`.
    |
    | Asymmetric Algorithms:
    | RS256, RS384 & RS512 / ES256, ES384 & ES512 will use the keys below.
    |
    */

    'keys' => [

        /*
        |--------------------------------------------------------------------------
        | Public Key
        |--------------------------------------------------------------------------
        |
        | A path or resource to your public key.
        |
        | E.g. 'file://path/to/public/key'
        |
        */

        'public' => env('JWT_PUBLIC_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Private Key
        |--------------------------------------------------------------------------
        |
        | A path or resource to your private key.
        |
        | E.g. 'file://path/to/private/key'
        |
        */

        'private' => env('JWT_PRIVATE_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Passphrase
        |--------------------------------------------------------------------------
        |
        | The passphrase for your private key. Can be null if none set.
        |
        */

        'passphrase' => env('JWT_PASSPHRASE'),

    ],

    /*
    |--------------------------------------------------------------------------
    | JWT time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token will be valid for.
    | Defaults to 1 hour.
    |
    | You can also set this to null, to yield a never expiring token.
    | Some people may want this behaviour for e.g. a mobile app.
    | This is not particularly recommended, so make sure you have appropriate
    | systems in place to revoke the token if necessary.
    | Notice: If you set this to null you should remove 'exp' element from 'required_claims' list.
    |
    */

    'ttl' => env('JWT_TTL', 60),

    /*
    |--------------------------------------------------------------------------
    | Refresh time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token can be refreshed
    | within. I.E. The user can refresh their token within a 2 week window of
    | the original token being created until they must re-authenticate.
    | Defaults to 2 weeks.
    |
    | You can also set this to null, to yield an infinite refresh time.
    | Some may want this instead of never expiring tokens for e.g. a mobile app.
    | This is not particularly recommended, so make sure you have appropriate
    | systems in place to revoke the token if necessary.
    |
    */

    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),

    /*
    |--------------------------------------------------------------------------
    | JWT hashing algorithm
    |--------------------------------------------------------------------------
    |
    | Specify the hashing algorithm that will be used to sign the token.
    |
    | See here: https://github.com/namshi/jose/tree/master/src/Namshi/JOSE/Signer/OpenSSL
    | for possible values.
    |
    */

    'algo' => env('JWT_ALGO', 'HS256'),

    /*
    |--------------------------------------------------------------------------
    | Required Claims
    |--------------------------------------------------------------------------
    |
    | Specify the required claims that must exist in any token.
    | A TokenInvalidException will be thrown if any of these claims are not
    | present in the payload.
    |
    */

    'required_claims' => [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ],

    /*
    |--------------------------------------------------------------------------
    | Persistent Claims
    |--------------------------------------------------------------------------
    |
    | Specify the claim keys to be persisted when refreshing a token.
    | `sub` and `iat` will automatically be persisted, in
    | addition to the these claims.
    |
    | Note: If a claim does not exist then it will be ignored.
    |
    */

    'persistent_claims' => [
        // 'foo',
        // 'bar',
    ],

    /*
    |--------------------------------------------------------------------------
    | Lock Subject
    |--------------------------------------------------------------------------
    |
    | This will determine whether a `prv` claim is automatically added to
    | the token. The purpose of this is to ensure that if you have multiple
    | authentication models e.g. `App\User` & `App\OtherPerson`, then we
    | should prevent one authentication request from impersonating another,
    | if 2 tokens happen to have the same id across the 2 different models.
    |
    | Under specific circumstances, you may want to disable this behaviour
    | e.g. if you only have one authentication model, then you would save
    | a little on token size.
    |
    */

    'lock_subject' => true,

    /*
    |--------------------------------------------------------------------------
    | Leeway
    |--------------------------------------------------------------------------
    |
    | This property gives the jwt timestamp claims some "leeway".
    | Meaning that if you have any unavoidable slight clock skew on
    | any of your servers then this will afford you some level of cushioning.
    |
    | This applies to the claims `iat`, `nbf` and `exp`.
    |
    | Specify in seconds - only if you know you need it.
    |
    */

    'leeway' => env('JWT_LEEWAY', 0),

    /*
    |--------------------------------------------------------------------------
    | Blacklist Enabled
    |--------------------------------------------------------------------------
    |
    | In order to invalidate tokens, you must have the blacklist enabled.
    | If you do not want or need this functionality, then set this to false.
    |
    */

    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),

    /*
    | -------------------------------------------------------------------------
    | Blacklist Grace Period
    | -------------------------------------------------------------------------
    |
    | When multiple concurrent requests are made with the same JWT,
    | it is possible that some of them fail, due to token regeneration
    | on every request.
    |
    | Set grace period in seconds to prevent parallel request failure.
    |
    */

    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 0),

    /*
    |--------------------------------------------------------------------------
    | Cookies encryption
    |--------------------------------------------------------------------------
    |
    | By default Laravel encrypt cookies for security reason.
    | If you decide to not decrypt cookies, you will have to configure Laravel
    | to not encrypt your cookie token by adding its name into the $except
    | array available in the middleware "EncryptCookies" provided by Laravel.
    | see https://laravel.com/docs/master/responses#cookies-and-encryption
    | for details.
    |
    | Set it to true if you want to decrypt cookies.
    |
    */

    'decrypt_cookies' => false,

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    | Specify the various providers used throughout the package.
    |
    */

    'providers' => [

        /*
        |--------------------------------------------------------------------------
        | JWT Provider
        |--------------------------------------------------------------------------
        |
        | Specify the provider that is used to create and decode the tokens.
        |
        */

        'jwt' => Tymon\JWTAuth\Providers\JWT\Lcobucci::class,

        /*
        |--------------------------------------------------------------------------
        | Authentication Provider
        |--------------------------------------------------------------------------
        |
        | Specify the provider that is used to authenticate users.
        |
        */

        'auth' => Tymon\JWTAuth\Providers\Auth\Illuminate::class,

        /*
        |--------------------------------------------------------------------------
        | Storage Provider
        |--------------------------------------------------------------------------
        |
        | Specify the provider that is used to store tokens in the blacklist.
        |
        */

        'storage' => Tymon\JWTAuth\Providers\Storage\Illuminate::class,

    ],
];
