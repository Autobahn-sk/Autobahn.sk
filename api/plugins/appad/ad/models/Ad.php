<?php namespace AppAd\Ad\Models;

use Model;
use System\Models\File;
use RainLab\User\Models\User;
use AppAd\AdPrice\Models\Price;
use Illuminate\Validation\Rule;
use AppAd\AdVehicle\Models\Vehicle;
use AppAd\AdPrice\Models\PriceOffer;
use AppAd\Ad\Classes\Enums\AdStatusEnum;

/**
 * Ad Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Ad extends Model
{
	use \October\Rain\Database\Traits\Sluggable;
	use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	/**
     * @var string table name
     */
    public $table = 'appad_ad_ads';

    /**
     * @var array rules for validation
     */
    public $rules = [
		'title'           => 'required|string',
		'description'     => 'required|string',
		'status'          => 'required|string',
		'user' 		      => 'required',
		'user_id'         => 'required|integer|exists:users,id',
		'prices'          => 'required|array',
		'location'        => 'required_without:google_place_id|string',
		'google_place_id' => 'nullable|string',
		'youtube_url'     => 'nullable|url',
		'images'          => 'required|array',
		'attachments'     => 'nullable|array',
	];

	/**
	 * @var array fillable fields
	 */
	protected $fillable = [
		'title',
		'description',
		'status',
		'user_id',
		'location',
		'google_place_id',
		'youtube_url',
	];

	/*
     * Attributes casted to carbon object
     */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	/**
	 * @var array slugs
	 */
	public $slugs = [
		'slug' => 'title'
	];

	/**
	 * @var array relations
	 */
	public $belongsTo = [
		'user' => User::class
	];

	public $hasOne = [
		'vehicle' => [
			Vehicle::class,
			'key' => 'id',
			'otherKey' => 'id'
		]
	];

	public $hasMany = [
		'prices' => [
			Price::class,
			'key' => 'ad_id',
			'otherKey' => 'id'
		],
		'price_offers' => [
			PriceOffer::class,
			'key' => 'ad_id',
			'otherKey' => 'id'
		]
	];

	public $attachMany = [
		'images' => File::class,
		'attachments' => File::class
	];

	// Events
	public function beforeValidate()
	{
		$this->rules['status'] = Rule::in(AdStatusEnum::values()) . '|required|string';
	}

	// Scopes
	public function scopeIsDraft($query)
	{
		return $query->where('status', AdStatusEnum::DRAFT->value);
	}

	public function scopeIsPublished($query)
	{
		return $query->where('status', AdStatusEnum::PUBLISHED->value);
	}

	public function scopeIsArchived($query)
	{
		return $query->where('status', AdStatusEnum::ARCHIVED->value);
	}

	public function getStatusOptions()
	{
		return AdStatusEnum::optionsForBackend();
	}

	public function getCurrentPriceAttribute()
	{
		return $this->prices()->orderByDesc('created_at')->first();
	}

	public function getHighestPriceAttribute()
	{
		if (!$this->prices->count() > 1) {
			return null;
		}

		$highestPrice = $this->prices()->orderByDesc('price')->first();

		if ($highestPrice->price == $this->current_price->price) {
			return null;
		}

		return $highestPrice;
	}

	public function getDifferencePriceAttribute()
	{
		if (!$this->highest_price) {
			return null;
		}

		return $this->highest_price->price - $this->current_price->price;
	}
}
