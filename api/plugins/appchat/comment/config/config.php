<?php

use AppAd\Ad\Models\Ad;
use AppChat\Comment\Models\Comment;
use AppChat\Comment\Http\Resources\AuthorResource;

return [
    'unregistered_user_allowed_to_read' => true,
    'models_map'                        => [
		'ad' => [
			'class' => Ad::class
		],
        'comment' => [
            'class' => Comment::class
        ]
    ],
    'resources'                         => [
        'author' => AuthorResource::class
    ]
];