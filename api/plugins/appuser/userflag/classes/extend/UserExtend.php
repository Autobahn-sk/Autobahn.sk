<?php namespace AppUser\UserFlag\Classes\Extend;

use RainLab\User\Models\User;
use AppUser\UserFlag\Models\UserFlag;

class UserExtend
{
    public static function addMethod_getFlaggedModels()
    {
        User::extend(function(User $user) {
            $user->addDynamicMethod('getFlaggedModels', function($modelClass, $requestedTypes = null) use ($user) {

                $query = UserFlag::with('flaggable')
                    ->where('user_id', $user->id)
                    ->where('flaggable_type', $modelClass);

                if ($requestedTypes) {
                    $types = $requestedTypes;

                    if (is_string($requestedTypes)) {
                        $types = collect(explode(',', $requestedTypes))->map(function($type) {
                            return trim($type);
                        });
                    }

                    $query->whereIn('type', $types);
                }

                $query->where('value', '>', 0);

                $flags = $query->get();

                return $flags->pluck('flaggable');
            });
        });
    }
}
