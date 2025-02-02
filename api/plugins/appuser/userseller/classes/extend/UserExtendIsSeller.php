<?php namespace AppUser\UserSeller\Classes\Extend;

use Backend\Widgets\Form;
use Backend\Widgets\Lists;
use Rainlab\User\Models\User;
use RainLab\User\Controllers\Users;
use October\Rain\Support\Facades\Event;

class UserExtendIsSeller
{
	public static function extend()
	{
		self::addIsSellerToColumns();
		self::addIsSellerToFieldsFilterScopes();
		self::addIsSellerToFields();
		self::addIsSellerToResource();
		self::extendUser_addCasts();
		self::extendUser_addFillable();
		self::extendUser_addRules();
	}
	
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

	public static function addIsSellerToFieldsFilterScopes()
	{
		Users::extendListFilterScopes(function($filter) {
			$filter->addScopes([
				'is_seller' => [
					'label'      => 'Is Seller',
					'type'       => 'switch',
					'default'    => 0,
					'conditions' => [
						'is_seller = false',
						'is_seller = true'
					]
				]
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
	
	public static function extendUser_addCasts(): void
	{
		User::extend(function(User $user) {
			$user->addCasts([
				'is_seller' => 'boolean'
			]);
		});
	}

	public static function extendUser_addFillable(): void
	{
		User::extend(function(User $user) {
			$user->addFillable([
				'is_seller'
			]);
		});
	}

	public static function extendUser_addRules(): void
	{
		User::extend(function(User $user) {
			$user->bindEvent('model.beforeValidate', function () use ($user) {
				$user->rules['is_seller'] = [
					'boolean'
				];
			});
		});
	}
}
