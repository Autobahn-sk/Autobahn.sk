<?php namespace AppChat\Comment;

use Backend;
use System\Classes\PluginBase;
use AppChat\Comment\Classes\Extend\UserExtend;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
	/*
     * Dependencies
     */
    public $require = [
		'AppApi.ApiResponse',
        'AppUser.UserApi'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Comment',
            'description' => 'No description provided yet...',
            'author'      => 'AppChat',
            'icon'        => 'icon-leaf',
        ];
    }

	/**
	 * Register method, called when the plugin is first registered.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Boot method, called right before the request route.
	 *
	 * @return array
	 */
	public function boot()
	{
		UserExtend::addCommentRelationToUser();
	}

	/**
	 * Registers back-end navigation items for this plugin.
	 *
	 * @return array
	 */
	public function registerNavigation()
	{
		return [
			'comment' => [
				'label'       => 'Comments',
				'url'         => Backend::url('appchat/comment/comments'),
				'icon'        => 'icon-comments',
				'permissions' => ['appchat.comment.*'],
				'order'       => 500
			]
		];
	}
}
