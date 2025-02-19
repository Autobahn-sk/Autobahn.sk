<?php

use AppAd\Ad\Models\Ad;
use AppAd\Ad\Http\Resources\AdSimpleResource;

return [
    'aliases' => [
        'ad' =>
            [
                'model'    => Ad::class,
                'resource' => AdSimpleResource::class
            ]
    ],
    'type'  => [
        'bookmark' => 'Bookmark',
        'visit'    => 'Visit'
    ]
];
