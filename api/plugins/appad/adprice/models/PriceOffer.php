<?php namespace AppAd\AdPrice\Models;

use Mail;
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
		'user_id' => 'required|integer|exists:users,id',
		'ad' => 'required',
		'user' => 'required'
	];

	/**
	 * @var array fillable fields
	 */
	protected $fillable = [
		'price',
		'message',
		'ad_id',
		'user_id'
	];

	/**
	 * @var array casts
	 */
	protected $casts = [
		'price' => 'float',
		'message' => 'string'
	];

	/**
	 * @var array relations
	 */
	public $belongsTo = [
		'ad' => Ad::class,
		'user' => User::class
	];

	public function afterCreate()
	{
		$vars = [
			'ad'      => $this->ad,
			'user'    => $this->user,
			'price'   => $this->price,
			'request' => $this->message,
			'url'     => env('APP_FRONTEND_URL') . '/ad/' . $this->ad->slug
		];

		Mail::sendTo([$this->ad->user->email => $this->ad->user->name],'appad.adprice::mail.offer', $vars);
	}
}
