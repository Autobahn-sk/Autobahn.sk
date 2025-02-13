<?php namespace AppAd\Ad\Models;

use Model;
use System\Models\File;
use RainLab\User\Models\User;
use Illuminate\Validation\Rule;
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
		'user_id'         => 'required|integer|exists:users,id',
		'location'        => 'required|string',
		'google_place_id' => 'nullable|string',
		'youtube_url'     => 'nullable|url',
		'images'          => 'nullable|array',
		'images.*'        => 'nullable|integer|exists:system_files,id',
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

	public $attributeNames = [
		'title'           => 'Názov',
		'description'     => 'Popis',
		'user_id'         => 'Používateľ',
		'location'        => 'Lokácia',
		'google_place_id' => 'Google Place ID',
		'youtube_url'     => 'Youtube URL',
		'images'          => 'Obrázky',
	];

	public $customMessages = [
		'required' => 'Pole :attribute je povinné',
		'exists'   => 'Pole :attribute neexistuje',
		'date'     => 'Pole :attribute musí byť dátum'
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

	public $attachMany = [
		'images' => File::class
	];

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
		return AdStatusEnum::toArray();
	}
}
