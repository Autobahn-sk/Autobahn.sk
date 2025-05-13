<?php namespace AppAd\Ad\Models;

use Model;
use System\Models\File;
use ValidationException;
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
		'slug' 		      => 'required|string|unique:appad_ad_ads',
		'description'     => 'required|string',
		'status'          => 'required|string',
		'user' 		      => 'required',
		'user_id'         => 'required|integer|exists:users,id',
		'location'        => 'required_without:google_place_id|string',
		'google_place_id' => 'nullable|string',
		'youtube_url'     => 'nullable|url',
		'images.*'        => 'required',
		'attachments'     => 'nullable'
	];

	/**
	 * @var array fillable fields
	 */
	protected $fillable = [
		'title',
		'slug',
		'description',
		'status',
		'user_id',
		'location',
		'google_place_id',
		'youtube_url',
		'images',
		'attachments'
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
	 * @var array Attributes to be cast to native types
	 */
	protected $casts = [
		'title' => 'string',
		'description' => 'string',
		'status' => 'string',
		'images' => 'array',
		'attachments' => 'array',
		'location' => 'string',
		'google_place_id' => 'string',
		'youtube_url' => 'string'
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
			'otherKey' => 'id',
			'delete' => true
		]
	];

	public $hasMany = [
		'prices' => [
			Price::class,
			'key' => 'ad_id',
			'otherKey' => 'id',
			'delete' => true
		],
		'price_offers' => [
			PriceOffer::class,
			'key' => 'ad_id',
			'otherKey' => 'id',
			'delete' => true
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

		if ((!$this->vehicle || !$this->current_price) && $this->status == AdStatusEnum::PUBLISHED->value) {
			throw new ValidationException([
				'status' => 'You must add a vehicle and price before publishing the ad.'
			]);
		}
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

	public function getFormStatusOptions()
	{
		if (!$this->exists) {
			return [
				AdStatusEnum::DRAFT->value => title_case(AdStatusEnum::DRAFT->value)
			];
		}

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

		if ($highestPrice?->price == $this->current_price?->price) {
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

	public function getBadgeAttribute()
	{
		if ($this->difference_price) {
			return 'price';
		}

		if ($this->vehicle) {
			if ($this->vehicle->mileage <= 150000) {
				return 'mileage';
			}

			if ($this->vehicle->year >= 2015) {
				return 'year';
			}
		}

		return null;
	}

	public function getThumbnailAttribute()
	{
		return $this->images->first();
	}

	public function getSummaryAttribute()
	{
		if (!$this->vehicle) {
			return null;
		}

		return $this->vehicle->displacement . ' ' . substr($this->vehicle->engine_type, 0, 1) . $this->vehicle->cylinders . ' ' . $this->vehicle->kilowatts . 'kW' . ' ' . title_case($this->vehicle->body_type) . ' ' . strtoupper($this->vehicle->drive);
	}

	public function saveRelations($request)
	{
		if ($request->has('price')) {
			$this->prices()->create($request->input('price'));
		}

		if ($request->has('vehicle')) {
			$vehicle = $this->vehicle()->updateOrCreate(['id' => $this->vehicle?->id], $request->input('vehicle'));

			$vehicle->saveRelations($request);
		}
	}
}
