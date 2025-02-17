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
			$table->string('manufacturer');
			$table->string('model');
			$table->string('body_type');
			$table->integer('horsepower');
			$table->integer('torque');
			$table->decimal('displacement', 2, 1);
			$table->integer('max_speed');
			$table->string('color');
			$table->string('fuel_type');
			$table->string('drive');
			$table->string('transmission');
			$table->integer('cylinders');
			$table->integer('doors');
			$table->integer('year');
			$table->integer('mileage');
			$table->string('condition');
			$table->string('license_plate')->nullable();

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
