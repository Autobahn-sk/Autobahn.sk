<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

		'uploads' => env('FILESYSTEM_DRIVER', 'local') === 'local' ? [
			'driver' => 'local',
			'root' => storage_path('app/uploads'),
			'url' => '/storage/app/uploads',
			'visibility' => 'public',
			'throw' => false,
		] : [
			'driver' => 's3',
			'key'    => env('AWS_ACCESS_KEY_ID', null),
			'secret' => env('AWS_SECRET_ACCESS_KEY', null),
			'region' => env('AWS_DEFAULT_REGION'),
			'bucket' => env('AWS_BUCKET'),
			'url' => rtrim(env('AWS_URL', ""), '/') . '/uploads',
			'root' => 'uploads',
			'visibility' => 'private',
			'endpoint' => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
			'throw' => false,
		],

		'media' => env('FILESYSTEM_DRIVER', 'local') === 'local' ? [
			'driver' => 'local',
			'root' => storage_path('app/media'),
			'url' => '/storage/app/media',
			'visibility' => 'public',
			'throw' => false,
		] : [
			'driver' => 's3',
			'key'    => env('AWS_ACCESS_KEY_ID', null),
			'secret' => env('AWS_SECRET_ACCESS_KEY', null),
			'region' => env('AWS_DEFAULT_REGION'),
			'bucket' => env('AWS_BUCKET'),
			'url' => rtrim(env('AWS_URL', ""), '/') . '/media',
			'root' => 'media',
			'visibility' => 'private',
			'endpoint' => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
			'throw' => false,
		],

		'resources' => env('FILESYSTEM_DRIVER', 'local') === 'local' ? [
			'driver' => 'local',
			'root' => storage_path('app/resources'),
			'url' => '/storage/app/resources',
			'visibility' => 'public',
			'throw' => false,
		] : [
			'driver' => 's3',
			'key'    => env('AWS_ACCESS_KEY_ID', null),
			'secret' => env('AWS_SECRET_ACCESS_KEY', null),
			'region' => env('AWS_DEFAULT_REGION'),
			'bucket' => env('AWS_BUCKET'),
			'url' => rtrim(env('AWS_URL', ""), '/') . '/resources',
			'root' => 'resources',
			'visibility' => 'private',
			'endpoint' => env('AWS_ENDPOINT'),
			'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
			'throw' => false,
		],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

];
