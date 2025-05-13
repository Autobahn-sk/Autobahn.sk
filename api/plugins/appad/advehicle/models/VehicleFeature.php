<?php namespace AppAd\AdVehicle\Models;

use Model;
use Illuminate\Validation\Rule;
use AppAd\AdVehicle\Classes\Enums\VehicleFeatureCategoryEnum;

/**
 * VehicleFeature Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class VehicleFeature extends Model
{
	use \October\Rain\Database\Traits\Sortable;
	use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	/**
     * @var string table name
     */
    public $table = 'appad_advehicle_vehicle_features';

    /**
     * @var array rules for validation
     */
    public $rules = [
		'title'      => 'required|string',
		'category'   => 'nullable|string',
		'sort_order' => 'nullable|integer'
	];

	/**
	 * @var array relations
	 */
	public $belongsToMany = [
		'vehicles' => [
			Vehicle::class,
			'table'    => 'appad_advehicle_vehicles_vehicle_features',
			'order'    => 'sort_order',
			'key'      => 'feature_id',
			'otherKey' => 'vehicle_id'
		]
	];

	// Events
	public function beforeValidate()
	{
		$this->rules['category'] = Rule::in(VehicleFeatureCategoryEnum::values()) . '|nullable|string';
	}

	public function getCategoryOptions()
	{
		return VehicleFeatureCategoryEnum::optionsForBackend();
	}
}
