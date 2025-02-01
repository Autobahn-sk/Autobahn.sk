<?php namespace AppUser\Report\Classes\Extend;

use RainLab\User\Models\User;
use AppUser\Report\Models\UserReport;

class UserExtend
{
    public static function addReportsRelationToUser()
    {
        User::extend(function ($model) {
            $model->hasMany['reports'] = [
                UserReport::class,
                'delete'     => true,
                'softDelete' => true
            ];
        });
    }
}
