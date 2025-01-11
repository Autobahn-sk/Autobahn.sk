<?php namespace AppUser\UserSeller\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('users', 'is_seller')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_seller')->default(false);
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'is_seller')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_seller');
            });
        }
    }
};
