<?php namespace AppPayment\Subscription\Models;

use Model;
use RainLab\User\Models\User;
use AppPayment\Plan\Models\Plan;
use AppPayment\Subscription\Classes\Services\SubscriptionService;

/**
 * Subscription Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Subscription extends Model
{
	use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'apppayment_subscription_subscriptions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
		'plan_id',
		'user_id'
	];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
		'deleted_at',
		'cancelled_at'
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
		'plan' => Plan::class,
        'user' => User::class
    ];

	// Scopes
    public function scopeActive($query)
    {
        return $query->where([
            'status' => 'active',
            'cancelled_at' => null
        ]);
    }

    public function scopeNotCancelled($query)
    {
        return $query->whereNotIn('status', [
            'past_due',
            'unpaid',
            'canceled',
            'incomplete_expired'
        ]);
    }

	// Events
    public function beforeSave()
    {
        if ($this->isDirty('status')) {
            $this->statusChange();
        }
    }

    private function statusChange()
    {
        $cancelledStatuses = ['past_due', 'unpaid', 'canceled', 'incomplete_expired'];

        if (in_array($this->status, $cancelledStatuses)) {
            $this->cancelled_at = now();

            $this->is_primary = false;

            return;
        }

        $this->cancelled_at = null;
    }

	// Attributes
    public function getCalculatedPriceAttribute()
    {
        return (new SubscriptionService)->getSubscription($this->stripe_id)->plan->amount / 100;
    }
}
