<?php namespace AppService\Diagnostic\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use AppService\Diagnostic\Classes\Enums\DiagnosticStatusEnum;

/**
 * CreateDiagnosticsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('appservice_diagnostic_diagnostics', function(Blueprint $table) {
            $table->id();

			$table->text('prompt');
			$table->text('response')->nullable();
			$table->text('error')->nullable();
			$table->string('status')->default(DiagnosticStatusEnum::PENDING->value);

			$table->integer('user_id')->unsigned()->nullable()->index();

			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appservice_diagnostic_diagnostics');
    }
};
