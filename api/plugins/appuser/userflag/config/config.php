<?php

use RainLab\User\Models\User;
use AppUser\UserApi\Http\Resources\UserResource;

return [
    /*
    |--------------------------------------------------------------------------
    | Aliases
    |--------------------------------------------------------------------------
    | Aliases are used when Frontend is sending information which model will be
    | flagged and also which models are allowed to be flagged
    |
    */

    'aliases' => [
        'user' =>
            [
                'model'    => User::class,
                'resource' => UserResource::class
            ]
    ],
    'type'  => [
        'bookmark' => 'Bookmark',
        'visit'    => 'Visit'
    ]
];
