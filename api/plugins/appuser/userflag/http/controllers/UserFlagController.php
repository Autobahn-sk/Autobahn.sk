<?php namespace AppUser\UserFlag\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppUser\UserFlag\Models\UserFlag;
use AppUtil\Util\Classes\BooleanValue;
use AppApi\ApiResponse\Resources\ApiResource;
use AppUser\UserFlag\Http\Resources\UserFlagResource;

class UserFlagController extends Controller
{
    /*
     * Create or update
     */
    public function storeOrUpdate(Request $request, $model, $id, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);

        $flag = UserFlag::firstOrNew([
            'flaggable_type' => $modelClass,
            'flaggable_id'   => $id,
            'user_id'       => $user->id,
            'type'          => $request->input('type')
        ]);

        $flag->value = BooleanValue::getBooleanValue($request->input('value'));
        $flag->text = $request->input('text');

        $flag->save();

        $response = new UserFlagResource($flag);

		return ApiResource::success(data: $response);
	}

    /*
     * Get models with given type
     */
    public function getModels_modelAndType(Request $request, $model, $type, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);

        $resourceClass = config('appuser.userflag::aliases.' . $model . '.resource');
        $models = $user->getFlaggedModels($modelClass, $type);

		$response = $resourceClass::collection($models);

		return ApiResource::success(data: $response);
	}

    /*
     * Returns flags for specific model
     */
    public function getFlags_modelAndId(Request $request, $model, $id, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);

        $flags = UserFlag::where([
            'user_id'       => $user->id,
            'flaggable_type' => $modelClass,
            'flaggable_id'   => $id
        ])->get();

        $response = UserFlagResource::collection($flags);

		return ApiResource::success(data: $response);
	}

    /*
     * Returns flags for all models
     */
    public function getFlags_model(Request $request, $model, User $user)
    {
        $modelClass = $this->_getModelClassFromAlias($model);

        $flags = UserFlag::where([
            'user_id'       => $user->id,
            'flaggable_type' => $modelClass
        ])->get();

		$response = UserFlagResource::collection($flags);

		return ApiResource::success(data: $response);
	}

    /*
     * Get all models with given type
     */
    public function getModels_type(Request $request, $type, User $user)
    {
        $flags = UserFlag::where([
            'user_id' => $user->id,
            'type'    => $type
        ])->get();

        $response = UserFlagResource::collection($flags);

		return ApiResource::success(data: $response);
	}

    /*
     * Get model class from alias and throw error if not found
     */
    protected function _getModelClassFromAlias($model)
    {
        if (!array_key_exists($model, config('appuser.userflag::aliases', []))) {
            throw new Exception('Model not allowed');
        }

        return config('appuser.userflag::aliases.' . $model . '.model');
    }
}
