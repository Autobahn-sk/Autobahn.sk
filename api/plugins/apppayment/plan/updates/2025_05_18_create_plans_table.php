<?php namespace AppPayment\Plan\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreatePlansTable Migration
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
        Schema::create('apppayment_plan_plans', function(Blueprint $table) {
            $table->id();

			$table->string('name')->nullable()->index();
			$table->text('description')->nullable();
			$table->decimal('price', 13, 2)->unsigned()->default(0);
			$table->integer('diagnostics_per_hour')->default(0);

			$table->string('stripe_id')->index();
			$table->string('stripe_product_id')->index();


			$table->boolean('is_published')->default(false)->index();
			$table->boolean('is_featured')->default(false)->index();

			$table->unsignedInteger('sort_order')->default(0)->index();

			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('apppayment_plan_plans');
    }
};
