<?php namespace AppUser\UserApi\Http\Controllers;

use Cache;
use RainLab\User\Models\User;
use AppUser\UserApi\Classes\UserApiHook;
use AppApi\ApiResponse\Resources\ApiResource;
use AppApi\ApiException\Exceptions\NotFoundException;
use AppApi\ApiException\Exceptions\BadRequestException;
use AppUser\UserApi\Classes\Services\UserForgotPasswordService;

class ForgotApiController extends UserApiController
{
    /**
     * Forgot password.
     */
    public function handle()
    {
        $params = [
            'email' => input('email')
        ];

        $user = User::where('email', $params['email'])->first();

        if (!$user) {
            throw new NotFoundException('User not found');
        }

        if (!$user->is_activated) {
            throw new BadRequestException('User is not activated');
        }
        Cache::store('file')->put('reset_code_'.$user->id, $user->getResetPasswordCode(), config('appuser.userapi::config.password_reset_code_expiration_time'));

        (new UserForgotPasswordService($user))->sendResetCode();

        $user->reset_password_code = null;
        $user->save();

        return $afterProcess = UserApiHook::hook('afterProcess', [$this], function () use ($user) {
            return ApiResource::success(
               'Reset code sent successfully',
                config('app.debug') ? ['reset_code' => Cache::store('file')->get('reset_code_'.$user->id)] : null
            );
        });
    }
}
