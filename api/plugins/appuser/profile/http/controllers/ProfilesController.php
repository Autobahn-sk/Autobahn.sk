<?php namespace AppUser\Profile\Http\Controllers;

use Illuminate\Http\Request;
use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppUser\UserApi\Facades\JWTAuth;
use October\Rain\Support\Facades\Event;
use AppApi\ApiResponse\Resources\ApiResource;
use AppUser\Profile\Http\Resources\ProfileResource;

class ProfilesController extends Controller
{
	/**
	 * Handles the invocation of the user profile request.
	 *
	 * @param Request $request The incoming HTTP request instance.
	 * @param mixed $key The unique identifier, such as a username, used to locate the user.
	 * @return ApiResource Returns an ApiResource containing the user's profile data.
	 */
    public function __invoke(Request $request, mixed $key): ApiResource
    {
        $loggedUser = JWTAuth::getUser();

        $user = User::isPublished()
            ->where('username', $key)
            ->firstOrFail();

        if ($loggedUser) {
            Event::fire('appuser.userprofile.action.show', [$user]);
        }

        $response = new ProfileResource($user);

		return ApiResource::success(data: $response);
	}
}
