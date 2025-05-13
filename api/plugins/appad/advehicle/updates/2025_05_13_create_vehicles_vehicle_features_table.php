<?php namespace AppAd\AdVehicle\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateVehiclesVehicleFeaturesTable Migration
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
		Schema::create('appad_advehicle_vehicles_vehicle_features', function(Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->integer('vehicle_id');
			$table->integer('feature_id');
			$table->primary(['vehicle_id', 'feature_id']);
		});
	}

	/**
	 * down reverses the migration
	 */
	public function down()
	{
		Schema::dropIfExists('appad_advehicle_vehicles_vehicle_features');
	}
};
