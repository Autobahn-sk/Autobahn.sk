<?php namespace AppAd\AdVehicle\Models;

use Model;
use AppAd\Ad\Models\Ad;

/**
 * Vehicle Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Vehicle extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	public $incrementing = false;

	/**
     * @var string table name
     */
    public $table = 'appad_advehicle_vehicles';

    /**
     * @var array rules for validation
     */
    public $rules = [];

	public $belongsTo = [
		'ad' => [
			Ad::class,
			'key' => 'id',
			'otherKey' => 'id'
		]
	];
}
