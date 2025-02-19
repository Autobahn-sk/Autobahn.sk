<?php namespace AppAd\AdVehicle\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateVehiclesTable Migration
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
        Schema::create('appad_advehicle_vehicles', function(Blueprint $table) {
            $table->id();

			$table->string('vin')->unique();
			$table->string('license_plate')->nullable();
			$table->integer('manufacturer_id')->unsigned()->index();
			$table->string('model');
			$table->string('body_type');
			$table->string('color');
			$table->integer('kilowatts');
			$table->integer('torque');
			$table->decimal('displacement', 2, 1);
			$table->integer('top_speed');
			$table->string('fuel_type');
			$table->string('drive');
			$table->string('transmission');
			$table->integer('gears');
			$table->string('engine_type');
			$table->integer('cylinders');
			$table->integer('doors');
			$table->integer('seats');
			$table->integer('year');
			$table->integer('mileage');
			$table->string('condition');

			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appad_advehicle_vehicles');
    }
};
