<?php namespace AppUser\UserSeller\Classes\Extend;

use Backend\Widgets\Form;
use Backend\Widgets\Lists;
use Rainlab\User\Models\User;
use RainLab\User\Controllers\Users;
use October\Rain\Support\Facades\Event;

class UserExtendIsSeller
{
	public static function addIsSellerToColumns()
	{
		Users::extendListColumns(function(Lists $list, $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($list->alias !== 'list') {
				return;
			}

			$list->addColumns([
				'is_seller' => [
					'label' => 'Is Seller',
					'type'  => 'switch'
				],
			]);
		});
	}

	public static function addIsSellerToFields()
	{
		Users::extendFormFields(function(Form $form, $model) {
			if (!$model instanceof User) {
				return;
			}
			if ($form->alias !== 'form') {
				return;
			}

			$form->addFields([
				'is_seller' => [
					'label' => 'Is Seller',
					'type'  => 'switch'
				]
			]);
		});
	}

	public static function addIsSellerToResource()
	{
		Event::listen('appuser.userapi.user.beforeReturnResource', function(&$data, User $user){
			$data['is_seller'] = $user->is_seller;
		});
	}

	public static function addIsSellerAsFillable()
	{
		User::extend(function (User $user){
			$user->addFillable([
				'is_seller'
			]);
		});
	}

	public static function addIsSellerRules()
	{
		User::extend(function($user) {
			$user->rules['is_seller'] = [
				'boolean'
			];
		});
	}
}
