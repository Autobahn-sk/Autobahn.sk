<?php namespace AppUtil\Logger\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateLogsTable extends Migration
{
    public function up()
    {
        Schema::create('logs', function(Blueprint $table) {
            $table->id();

            $table->uuid('request_id')->index();
            $table->string('level', 5)->index();
            $table->text('log_text');
            $table->text('exception')->nullable();

            $table->timestamp('created_at', 6);
		});
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
