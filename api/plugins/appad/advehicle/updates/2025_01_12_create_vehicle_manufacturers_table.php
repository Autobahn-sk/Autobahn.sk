<?php namespace AppAd\AdVehicle\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateVehicleManufacturersTable Migration
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
        Schema::create('appad_advehicle_vehicle_manufacturers', function(Blueprint $table) {
            $table->id();

			$table->string('code')->unique();
			$table->string('name');

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
        Schema::dropIfExists('appad_advehicle_vehicle_manufacturers');
    }
};
