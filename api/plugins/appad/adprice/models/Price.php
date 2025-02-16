<?php namespace AppAd\AdPrice\Models;

use Model;
use AppAd\Ad\Models\Ad;

/**
 * Price Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Price extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	/**
     * @var string table name
     */
    public $table = 'appad_adprice_prices';

    /**
     * @var array rules for validation
     */
    public $rules = [
		'price' => 'required|numeric',
		'ad_id' => 'required|integer|exists:appad_ad_ads,id'
	];

	/**
	 * @var array relations
	 */
	public $belongsTo = [
		'ad' => Ad::class
	];

	public $hasMany = [
		'price_offers' => PriceOffer::class
	];
}
