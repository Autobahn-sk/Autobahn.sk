<?php namespace AppService\Diagnostic\Classes\Extend;

use RainLab\User\Models\User;
use AppService\Diagnostic\Models\Diagnostic;

class UserExtend
{
	/**
	 * Adds a one-to-many relationship to the User model for diagnostics.
	 *
	 * @return void
	 */
	public static function addDiagnosticsToModelUser(): void
	{
		User::extend(function (User $user) {
			$user->hasMany = [
				'diagnostics' => Diagnostic::class
			];
		});
	}
}
