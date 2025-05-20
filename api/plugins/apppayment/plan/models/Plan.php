<?php namespace AppPayment\Plan\Models;

use Model;
use AppPayment\Stripe\Classes\PlansService;
use AppPayment\Stripe\Classes\ProductService;

/**
 * Plan Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Plan extends Model
{
	use \October\Rain\Database\Traits\Sortable;
	use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

    /**
     * @var string table name
     */
    public $table = 'apppayment_plan_plans';

    /**
     * @var array rules for validation
     */
    public $rules = [
		'name'                 => 'required',
		'description'          => 'required',
		'price'                => 'required|numeric',
		'diagnostics_per_hour' => 'required|integer',
		'stripe_id'            => 'required',
		'stripe_product_id'    => 'required',
		'is_published'         => 'boolean',
		'is_featured'          => 'boolean',
		'sort_order'           => 'integer'
	];

	/**
	 * @var array Fillable fields
	 */
	protected $fillable = [
		'name',
		'description',
		'price',
		'diagnostics_per_hour',
		'stripe_id',
		'stripe_product_id',
		'is_published',
		'is_featured',
		'sort_order'
	];

	/**
	 * @var array Attributes to be cast to native types
	 */
	protected $casts = [
		'price'                => 'float',
		'diagnostics_per_hour' => 'integer',
		'stripe_id'            => 'string',
		'stripe_product_id'    => 'string',
		'is_published'         => 'boolean',
		'is_featured'          => 'boolean',
		'sort_order'           => 'integer'
	];

	/**
	 * @var array Attributes to be removed from the API representation of the model (ex. toArray())
	 */
	protected $hidden = [
		'deleted_at'
	];

	/**
	 * @var array Attributes to be cast to Argon (Carbon) instances
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	// Scopes
	public function scopeIsPublished($query)
	{
		return $query->where('is_published', true);
	}

	// Events
	public function afterCreate()
	{
		PlansService::createPlan(
			$this->stripe_id,
			$this->price * 100,
			'month',
			$this->stripe_product_id,
			$this->name
		);
	}

	public function afterUpdate()
	{
		PlansService::updatePlan(
			$this->stripe_id,
			$this->price * 100,
			'month',
			$this->stripe_product_id,
			$this->name
		);
	}

	public function afterDelete()
	{
		PlansService::deletePlan($this->stripe_id);
	}

	// Options
	public function getStripeIdOptions()
	{
		return collect(
			PlansService::getAllPlans()['data']
		)->mapWithKeys(function ($value) {
			return [
				$value['id'] => $value['id'] . ' - ' . number_format((float) $value['amount'] / 100, 2, '.', ' ') . ' ' . strtoupper($value['currency'])
			];
		})->toArray();
	}

	public function getStripeProductIdOptions()
	{
		return collect(
			ProductService::getAllProducts()['data']
		)->mapWithKeys(function ($value) {
			return [
				$value['id'] => $value['id'] . ' - ' . $value['name']
			];
		})->toArray();
	}
}
