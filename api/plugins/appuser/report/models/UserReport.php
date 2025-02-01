<?php namespace AppUser\Report\Models;

use RainLab\User\Models\User;
use October\Rain\Database\Model;

/**
 * UserReport Model
 */
class UserReport extends Model
{
    use \October\Rain\Database\Traits\SoftDelete;

    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'appuser_report_user_reports';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => User::class
    ];

    public $morphTo = [
        'reportable' => []
    ];

    public function getReportableTypeOptions()
    {
        return collect(config('appuser.report::types', []))->flip()->toArray();
    }
}
