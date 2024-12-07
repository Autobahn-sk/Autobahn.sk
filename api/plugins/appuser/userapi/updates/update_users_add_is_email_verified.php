<?php namespace AppUser\UserApi\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class addEmailVerify extends Migration
{
    public function up()
    {
		if (Schema::hasColumn('users', 'is_email_verified')) {
			return;
		}

		Schema::table('users', function(Blueprint $table) {
			$table->boolean('is_email_verified')->default(false);
		});
    }

    public function down()
    {
		if (!Schema::hasColumn('users', 'is_email_verified')) {
			return;
		}

		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('is_email_verified');
		});
    }
}
