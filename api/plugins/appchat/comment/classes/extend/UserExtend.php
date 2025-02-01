<?php namespace AppChat\Comment\Classes\Extend;

use RainLab\User\Models\User;
use AppChat\Comment\Models\Comment;

class UserExtend
{
    public static function addCommentRelationToUser()
    {
        User::extend(function ($user) {
            $user->morphMany['comments'] = [
                Comment::class,
                'name' => 'creatable',
                'softDelete' => true,
                'delete' => true
            ];
        });
    }
}
