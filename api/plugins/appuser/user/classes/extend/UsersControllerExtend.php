<?php namespace AppUser\User\Classes\Extend;

use Backend\Widgets\Form;
use Backend\Widgets\Lists;
use RainLab\User\Models\User;
use October\Rain\Database\Model;
use RainLab\User\Controllers\Users;

class UsersControllerExtend
{
	public static function extend()
	{
		UsersControllerExtend::updateListColumns_addAdsCount();
		UsersControllerExtend::updateListColumns_addLastLogin();
		UsersControllerExtend::updateListColumns_removeSurname();
		UsersControllerExtend::updateListColumns_addIsPublished();
		UsersControllerExtend::updateListFilterScopes_addIsPublished();
		UsersControllerExtend::updateFormFields_addUsername();
		UsersControllerExtend::updateFormFields_removeSurname();
		UsersControllerExtend::updateFormFields_makeNameFullSpan();
		UsersControllerExtend::updateFormFields_addSuperUser();
		UsersControllerExtend::updateFormFields_addIsPublished();
		UsersControllerExtend::updateFormFields_addGDPRConsent();
		UsersControllerExtend::updateFormFields_addNewsletterSubscriber();
	}

	public static function updateListColumns_addLastLogin()
	{
		Users::extendListColumns(function($column, $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($column->alias !== 'list') {
				return;
			}

			$column->addColumns([
				'last_login' => [
					'label' => 'Last login',
					'type'  => 'timetense'
				],
			]);
		});
	}

	public static function updateListColumns_addIsPublished()
	{
		Users::extendListColumns(function(Lists $list, $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($list->alias !== 'list') {
				return;
			}

			$list->addColumns([
				'is_published' => [
					'label' => 'Is published',
					'type'  => 'switch'
				],
			]);
		});
	}

	public static function updateFormFields_addIsPublished()
	{
		Users::extendFormFields(function(Form $form, Model $model) {
			if (!$model instanceof User) {
				return;
			}
			if ($form->alias !== 'form') {
				return;
			}

			$form->addFields([
				'is_published' => [
					'label'    => 'Is published',
					'type'     => 'switch',
					'default'  => 'true',
					'span'     => 'right',
					'on'       => 'Yes',
					'off'      => 'No',
					'disabled' => $form->context === 'preview'
				],
			]);
		});
	}

	public static function updateListColumns_removeSurname()
	{
		Users::extendListColumns(function(Lists $list, $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($list->alias !== 'list') {
				return;
			}

			$list->removeColumn('surname');
		});
	}

	public static function updateFormFields_removeSurname()
	{
		Users::extendFormFields(function(Form $form, $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($form->alias !== 'form') {
				return;
			}

			$form->removeField('surname');
		});
	}

	public static function updateFormFields_addUsername()
	{
		Users::extendFormFields(function(Form $form, Model $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($form->alias !== 'form') {
				return;
			}

			$form->addFields([
				'username' => [
					'label' => 'Username',
					'type'  => 'text',
					'span'  => 'full'
				],
			]);
		});
	}

	public static function updateFormFields_makeNameFullSpan()
	{
		Users::extendFormFields(function(Form $form, Model $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($form->alias !== 'form') {
				return;
			}

			$form->addFields([
				'name' => [
					'label' => 'Name',
					'span'  => 'full'
				]
			]);
		});
	}

	public static function updateFormFields_addSuperUser()
	{
		Users::extendFormFields(function(Form $form, Model $model) {
			if (!$model instanceof User) {
				return;
			}

			if ($form->alias !== 'form') {
				return;
			}

			$form->addFields([
				'is_superuser' => [
					'label'    => 'Superuser',
					'type'     => 'switch',
					'default'  => 'false',
					'span'     => 'left',
					'on'       => 'Yes',
					'off'      => 'No',
					'disabled' => $form->context === 'preview'
				],
			]);
		});
	}

	public static function updateListFilterScopes_addIsPublished()
	{
		Users::extendListFilterScopes(function($filter) {
			$filter->addScopes([
				'is_published' => [
					'label'      => 'Is published',
					'type'       => 'switch',
					'default'    => 0,
					'conditions' => [
						'is_published = false',
						'is_published = true'
					]
				]
			]);
		});
	}

	public static function updateListColumns_addAdsCount()
	{
		Users::extendListColumns(function($column, $model) {
			if (!$model instanceof User) {
				return;
			}

			$column->addColumns([
				'ads_count' => [
					'label'            => 'Ads',
					'type'             => 'number',
					'relation'         => 'ads',
					'useRelationCount' => true
				],
			]);
		});
	}

	public static function updateFormFields_addGDPRConsent()
	{
		Users::extendFormFields(function(Form $form, $model) {
			if (!$model instanceof User) {
				return;
			}
			if ($form->alias !== 'form') {
				return;
			}

			$form->addFields([
				'gdpr_consent' => [
					'label'    => 'Agreed with Terms and Conditions',
					'type'     => 'switch',
					'span'     => 'left',
					'on'       => 'Yes',
					'off'      => 'No'
				]
			]);
		});
	}

	public static function updateFormFields_addNewsletterSubscriber()
	{
		Users::extendFormFields(function(Form $form, $model) {
			if (!$model instanceof User) {
				return;
			}
			if ($form->alias !== 'form') {
				return;
			}

			$form->addFields([
				'newsletter_subscriber' => [
					'label' => 'Newsletter subscriber',
					'type'  => 'switch',
					'span'  => 'right',
					'on'    => 'Yes',
					'off'   => 'No'
				]
			]);
		});
	}
}
