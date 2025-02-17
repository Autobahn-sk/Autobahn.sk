<?php namespace AppAd\AdPrice\Models;

use Model;
use AppAd\Ad\Models\Ad;
use RainLab\User\Models\User;

/**
 * PriceOffer Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class PriceOffer extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	/**
     * @var string table name
     */
    public $table = 'appad_adprice_price_offers';

    /**
     * @var array rules for validation
     */
    public $rules = [
		'price' => 'required|numeric',
		'message' => 'nullable|string',
		'ad_id' => 'required|integer|exists:appad_ad_ads,id',
		'user_id' => 'required|integer|exists:users,id'
	];

	/**
	 * @var array relations
	 */
	public $belongsTo = [
		'ad' => Ad::class,
		'user' => User::class
	];
}
