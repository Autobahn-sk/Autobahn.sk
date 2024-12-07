<?php namespace AppUser\UserApi\Http\Controllers;

use Cache;
use RainLab\User\Models\User;
use AppUser\UserApi\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use AppUser\UserApi\Classes\UserApiHook;
use AppApi\ApiResponse\Resources\ApiResource;
use AppApi\ApiException\Exceptions\BadRequestException;

class VerifyEmailApiController extends UserApiController
{
    /**
     * Verify email.
     */
    public function handle()
    {
        $response = [];
        $user = null;

        $params = [
            'code' => input('code'),
            'email' => input('email')
        ];

        if (!isset($params['email'])) {
            $user = JWTAuth::parseToken()->authenticate();
        }

        //$user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            if (!isset($params['code']) && isset($params['email'])) {
                throw new BadRequestException('Code is required');
            }
            $user = User::where('email', $params['email'])->firstOrFail();
            $user_id = $user->id;
            $user = Auth::loginUsingId($user->id);
            $token = JWTAuth::fromUser($user);

            // add token to headers
            request()->headers->set('Authorization', 'Bearer '.$token);
            // add token to request headers

        } else {
            if (!isset($params['code'])) {
                throw new BadRequestException('Code is required');
            }
            $user = Auth::loginUsingId($user->id);
            $user_id = $user->id;
            $token = JWTAuth::fromUser($user);
            // add token to headers
            request()->headers->set('Authorization', 'Bearer '.$token);
        }

        $email_verification_code = Cache::store('file')->get('email_verification_'.$user_id);

        if ($email_verification_code != $params['code']) {
            throw new BadRequestException('Invalid code');
        }

        $verified_email = Cache::store('file')->get('email_'.$user_id);
        if (!$verified_email) {
            throw new BadRequestException('Invalid email');
        }
        $user->email = $verified_email;
        $user->username = $verified_email;
        $user->is_email_verified = 1;
        $user->save();
        Cache::store('file')->forget('email_verification_'.$user_id);
        Cache::store('file')->forget('email_'.$user_id);

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () {
            return ApiResource::success();
        });
    }
}
