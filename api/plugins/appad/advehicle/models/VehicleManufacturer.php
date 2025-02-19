<?php namespace AppAd\AdVehicle\Models;

use Model;
use System\Models\File;

/**
 * VehicleManufacturer Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class VehicleManufacturer extends Model
{
	use \October\Rain\Database\Traits\Sortable;
	use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	/**
     * @var string table name
     */
    public $table = 'appad_advehicle_vehicle_manufacturers';

    /**
     * @var array rules for validation
     */
    public $rules = [
		'code' => 'required|string|unique:appad_advehicle_vehicle_manufacturers',
		'name' => 'required|string',
		'logo' => 'required|image'
	];

	/**
	 * @var array relations
	 */
	public $hasMany = [
		'vehicles' => Vehicle::class
	];

	public $attachOne = [
		'logo' => File::class
	];
}
