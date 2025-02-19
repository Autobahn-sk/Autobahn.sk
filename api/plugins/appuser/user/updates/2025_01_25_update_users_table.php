<?php namespace AppUser\UserApi\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			if (!Schema::hasColumn('users', 'phone_number')) {
				$table->string('phone_number')->nullable();
			}
			if (!Schema::hasColumn('users', 'location')) {
				$table->string('location')->nullable();
			}
			if (!Schema::hasColumn('users', 'google_place_id')) {
				$table->string('google_place_id')->nullable();
			}
			if (!Schema::hasColumn('users', 'is_email_verified')) {
				$table->boolean('is_email_verified')->default(false);
			}
			if (!Schema::hasColumn('users', 'is_published')) {
				$table->boolean('is_published')->default(true);
			}
			if (!Schema::hasColumn('users', 'gdpr_consent')) {
				$table->boolean('gdpr_consent')->default(false);
			}
			if (!Schema::hasColumn('users', 'newsletter_subscriber')) {
				$table->boolean('newsletter_subscriber')->default(true);
			}
		});
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
			if (Schema::hasColumn('users', 'phone_number')) {
				$table->dropColumn('phone_number');
			}
			if (Schema::hasColumn('users', 'location')) {
				$table->dropColumn('location');
			}
			if (Schema::hasColumn('users', 'google_place_id')) {
				$table->dropColumn('google_place_id');
			}
			if (Schema::hasColumn('users', 'is_email_verified')) {
				$table->dropColumn('is_email_verified');
			}
			if (Schema::hasColumn('users', 'is_published')) {
				$table->dropColumn('is_published');
			}
			if (Schema::hasColumn('users', 'gdpr_consent')) {
				$table->dropColumn('gdpr_consent');
			}
			if (Schema::hasColumn('users', 'newsletter_subscriber')) {
				$table->dropColumn('newsletter_subscriber');
			}
		});
    }
};
