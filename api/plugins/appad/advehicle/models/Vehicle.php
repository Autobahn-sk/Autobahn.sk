<?php namespace AppAd\AdVehicle\Models;

use Model;
use AppAd\Ad\Models\Ad;
use Illuminate\Validation\Rule;
use AppAd\AdVehicle\Classes\Enums\VehicleDriveEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleBodyTypeEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleFuelTypeEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleConditionEnum;
use AppAd\AdVehicle\Classes\Enums\VehicleEngineTypeEnum;
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
		'vin' => 'required|string|regex:' . self::VIN_REGEX,
		'license_plate' => 'nullable|string|regex:' . self::ECV_REGEX,
		'manufacturer_id' => 'required|exists:appad_advehicle_vehicle_manufacturers,id',
		'model' => 'required|string',
		'body_type' => 'required|string',
		'color' => 'required|string',
		'kilowatts' => 'required|integer',
		'torque' => 'required|integer',
		'displacement' => 'required|numeric',
		'top_speed' => 'required|integer',
		'fuel_type' => 'required|string',
		'drive' => 'required|string',
		'transmission' => 'required|string',
		'gears' => 'required|integer|min:1',
		'engine_type' => 'required|string',
		'cylinders' => 'required|integer|min:0|max:24',
		'doors' => 'required|integer|min:2|max:5',
		'seats' => 'required|integer|min:1|max:10',
		'year' => 'required|integer|min:1900|max:2025',
		'mileage' => 'required|integer|min:0',
		'condition' => 'required|string'
	];

	/**
	 * @var array fillable fields
	 */
	protected $fillable = [
		'vin',
		'license_plate',
		'manufacturer_id',
		'model',
		'body_type',
		'color',
		'kilowatts',
		'torque',
		'displacement',
		'top_speed',
		'fuel_type',
		'drive',
		'transmission',
		'gears',
		'engine_type',
		'cylinders',
		'doors',
		'seats',
		'year',
		'mileage',
		'condition'
	];

	/**
	 * @var array relations
	 */
	public $belongsTo = [
		'ad' => [
			Ad::class,
			'key' => 'id',
			'otherKey' => 'id'
		],
		'manufacturer' => [
			VehicleManufacturer::class,
			'key' => 'manufacturer_id',
			'otherKey' => 'id'
		]
	];

	public $belongsToMany = [
		'features' => [
			VehicleFeature::class,
			'table'    => 'appad_advehicle_vehicles_vehicle_features',
			'order'    => 'sort_order',
			'key'      => 'vehicle_id',
			'otherKey' => 'feature_id'
		]
	];

	// Events
	public function beforeValidate()
	{
		$this->rules['body_type'] = Rule::in(VehicleBodyTypeEnum::values()) . '|required|string';
		$this->rules['condition'] = Rule::in(VehicleConditionEnum::values()) . '|required|string';
		$this->rules['fuel_type'] = Rule::in(VehicleFuelTypeEnum::values()) . '|required|string';
		$this->rules['engine_type'] = Rule::in(VehicleEngineTypeEnum::values()) . '|required|string';
		$this->rules['transmission'] = Rule::in(VehicleTransmissionEnum::values()) . '|required|string';
		$this->rules['drive'] = Rule::in(VehicleDriveEnum::values()) . '|required|string';
	}

	public function getHorsepowerAttribute()
	{
		return round($this->kilowatts * 1.34102);
	}

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

	public function getEngineTypeOptions()
	{
		return VehicleEngineTypeEnum::optionsForBackend();
	}

	public function saveRelations($request)
	{
		if ($request->has('vehicle.manufacturer')) {
			$this->manufacturer = VehicleManufacturer::isPublished()
				->where('id', $request->input('vehicle.manufacturer'))
				->orWhere('code', $request->input('vehicle.manufacturer'))
				->firstOrFail();

			$this->manufacturer_id = $this->manufacturer->id;

			$this->save();
		}

		if ($request->has('vehicle.features')) {
			$features[] = [];

			foreach ($request->input('vehicle.features') as $featureTitle) {
				$featureTitle = trim($featureTitle);

				$feature = VehicleFeature::where('title', $featureTitle)
					->first();

				if (!$feature) {
					$feature = new VehicleFeature();
					$feature->title = $featureTitle;
					$feature->save();
				}

				$features[] = $feature;
			}

			$this->features = array_filter($features);

			$this->save();
		}
	}
}
