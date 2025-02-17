<?php namespace AppAd\AdVehicle\Models;

use Model;
use AppAd\Ad\Models\Ad;
use AppAd\AdVehicle\Classes\Enums\VehicleDriveEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleBodyTypeEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleFuelTypeEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleConditionEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleCylindersEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleTransmissionEnum;

/**
 * Vehicle Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Vehicle extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	const VIN_REGEX = '/^[A-HJ-NPR-Z0-9]{17}$/';
	const ECV_REGEX = '/^[A-Z]{2}\d{2,3}[A-Z]{1,2}$/';

	public $incrementing = false;

	/**
     * @var string table name
     */
    public $table = 'appad_advehicle_vehicles';

	/**
	 * @var array rules for validation
	 */
	public $rules = [
		'vin' => 'required|string|regex:' . self::VIN_REGEX . '|unique:appad_advehicle_vehicles,vin',
		'manufacturer' => 'required|string',
		'model' => 'required|string',
		'body_type' => 'required|string',
		'color' => 'required|string',
		'fuel_type' => 'required|string',
		'drive' => 'required|string',
		'transmission' => 'required|string',
		'cylinders' => 'required|integer',
		'year' => 'required|integer|min:1900|max:2025',
		'mileage' => 'required|integer',
		'condition' => 'required|string',
		'license_plate' => 'nullable|string|regex:' . self::ECV_REGEX . '|unique:appad_advehicle_vehicles,license_plate'
	];

	public $belongsTo = [
		'ad' => [
			Ad::class,
			'key' => 'id',
			'otherKey' => 'id'
		]
	];

	public function getBodyTypeOptions()
	{
		return VehicleBodyTypeEnum::optionsForBackend();
	}

	public function getConditionOptions()
	{
		return VehicleConditionEnum::optionsForBackend();
	}

	public function getFuelTypeOptions()
	{
		return VehicleFuelTypeEnum::optionsForBackend();
	}

	public function getDriveOptions()
	{
		return VehicleDriveEnum::optionsForBackend();
	}

	public function getTransmissionOptions()
	{
		return VehicleTransmissionEnum::optionsForBackend();
	}

	public function getCylindersOptions()
	{
		return VehicleCylindersEnum::optionsForBackend();
	}
}
