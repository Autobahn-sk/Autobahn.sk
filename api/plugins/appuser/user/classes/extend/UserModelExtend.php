<?php namespace AppUser\User\Classes\Extend;

use AppAd\Ad\Models\Ad;
use Rainlab\User\Models\User;
use RainLab\User\Facades\Auth;
use Illuminate\Support\Facades\DB;
use AppUser\UserApi\Facades\JWTAuth;
use AppUser\UserFlag\Models\UserFlag;
use October\Rain\Support\Facades\Event;
use AppCommerce\Newsletter\Classes\Services\NewsletterService;

class UserModelExtend
{
	public static function extend()
	{
		UserModelExtend::extendUser_addAdRelationToUser();
		UserModelExtend::extendUser_addCasts();
		UserModelExtend::extendUser_addFillable();
		UserModelExtend::beforeCreate_setDefaultAvatar();
		UserModelExtend::beforeUpdate_subscribeOrUnsubscribeNewsletter();
		UserModelExtend::extendUserResource();
		UserModelExtend::addBookmarksRelationToUser();
		UserModelExtend::addVisitsRelationToUser();
		UserModelExtend::addIsPublishedScope();
		UserModelExtend::deleteUserFlags_onUserDelete();
		UserModelExtend::bindEvent_creatVisitFlagWhenSpecificUserIsRequested();
		UserModelExtend::beforeLogin_enableUsernameLogin();
		UserModelExtend::register_subscribeToNewsletter();
	}

	public static function extendUser_addCasts(): void
	{
		User::extend(function(User $user) {
			$user->addCasts([
				'name' => 'string',
				'email' => 'string',
				'username' => 'string',
				'is_superuser' => 'boolean',
				'last_login' => 'datetime',
				'last_seen' => 'datetime',
				'created_ip_address' => 'string',
				'last_ip_address' => 'string',
				'phone_number' => 'string',
				'is_email_verified' => 'boolean',
				'is_phone_number_verified' => 'boolean',
				'is_published' => 'boolean',
				'gdpr_consent' => 'boolean',
				'newsletter_subscriber' => 'boolean'
			]);
		});
	}

	public static function extendUser_addFillable(): void
	{
		User::extend(function(User $user) {
			$user->addFillable([
				'is_superuser',
				'last_login',
				'last_seen',
				'created_ip_address',
				'last_ip_address',
				'phone_number',
				'is_email_verified',
				'is_phone_number_verified',
				'is_published',
				'gdpr_consent',
				'newsletter_subscriber'
			]);
		});
	}

	public static function extendUser_addRules(): void
	{
		User::extend(function(User $user) {
			$user->rules['gdpr_consent'] = [
				'accepted',
				'required',
				'boolean'
			];

			$user->rules['newsletter_subscriber'] = [
				'boolean'
			];
		});
	}

	public static function beforeCreate_setDefaultAvatar(): void
	{
		User::extend(function (User $user) {
			$user->bindEvent('model.beforeCreate', function () use ($user) {
				if (!$user->avatar) {
					$user->avatar = (new \System\Models\File())->fromFile(plugins_path('appuser/user/assets/images/default-avatar.png'));
				}
			});
		});
	}

	public static function beforeUpdate_subscribeOrUnsubscribeNewsletter(): void
	{
		User::extend(function (User $user) {
			$user->bindEvent('model.beforeUpdate', function () use ($user) {
				if ($user->isDirty('newsletter_subscriber')) {
					if ($user->newsletter_subscriber) {
						NewsletterService::subscribe($user->email);
					}
					elseif (!$user->newsletter_subscriber) {
						NewsletterService::unsubscribe($user->email);
					}
				}
			});
		});
	}

    public static function addIsPublishedScope()
    {
        User::extend(function ($user) {
            $user->addDynamicMethod('scopeIsPublished', function ($query) {
                return $query->where('is_published', true);
            });
        });
    }

    public static function addBookmarksRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['bookmarks'] = [
                UserFlag::class,
                'name' => 'flaggable',
                'conditions' => "type = 'bookmark' AND value = 1 AND flaggable_type = 'AppAd\\\Ad\\\Models\\\Ad'",
                'order' => 'updated_at desc'
            ];
        });
    }

    public static function addVisitsRelationToUser()
    {
        User::extend(function (User $user) {
            $user->hasMany['visits'] = [
                UserFlag::class,
                'name' => 'flaggable',
                'conditions' => "type = 'visit' AND value = 1 AND flaggable_type = 'AppAd\\\Ad\\\Models\\\Ad'",
                'order' => 'updated_at desc'
            ];
        });
    }

    public static function extendUser_addAdRelationToUser()
    {
        User::extend(function($model) {
            $model->hasMany['ads'] = [
                Ad::class,
                'order' => 'created_at desc'
            ];
        });
    }

    public static function extendUserResource()
    {
        Event::listen('appuser.userapi.user.beforeReturnResource', function (&$data, User $user) {
			$data['is_email_verified'] = $user->is_email_verified;
			$data['is_phone_number_verified'] = $user->is_phone_number_verified;
			$data['bookmarks'] = AdResource::collection($user->bookmarks->pluck('flaggable'));
            $data['ads'] = AdResource::collection($user->ads()->where('is_published', true)->orderByDesc('created_at')->get());
        });
    }

    public static function deleteUserFlags_onUserDelete()
    {
        User::extend(function (User $user) {
            $user->bindEvent('model.beforeDelete', function () use ($user) {
                DB::table('appuser_userflag_user_flags')
                    ->where('user_id', $user->id)
                    ->where('type', '<>', 'visit')
                    ->delete();
            });
        });
    }

    public static function bindEvent_creatVisitFlagWhenSpecificUserIsRequested()
    {
        Event::listen('appuser.userprofile.action.show', function(User $requestedUser) {
            $user = JWTAuth::getUser();

            if (!$user || !$requestedUser->is_published) {
                return;
            }

            UserFlag::create([
                'type'          => 'visit',
                'value'         => true,
                'user_id'       => $user->id,
                'flaggable_id'   => $requestedUser->id,
                'flaggable_type' => User::class
            ]);
        });
    }

	public static function beforeLogin_enableUsernameLogin()
	{
		Event::listen('appuser.userapi.beforeLogin', function ($params) {
			$remember = (bool) array_get($params, 'remember', false);

			$params['login'] = User::firstOrFail()
				->where('email', $params['login'])
				->orWhere('username', $params['login'])
				->value('email');

			if (isset($params['login'])) {
				return Auth::authenticate([
					'login'    => $params['login'],
					'password' => $params['password']
				], $remember);
			}
		});
	}

	public static function register_subscribeToNewsletter()
	{
		Event::listen('rainlab.user.register', function ($data) {
			$newsletter = (bool) array_get($data, 'newsletter_subscriber', true);

			if ($newsletter) {
				NewsletterService::subscribe(array_get($data, 'email'));
			}
		});
	}
}
