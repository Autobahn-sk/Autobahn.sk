<?php namespace AppUser\UserFlag\Models;

use RainLab\User\Models\User;
use October\Rain\Database\Model;

/**
 * UserFlag Model
 */
class UserFlag extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'appuser_userflag_user_flags';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'flaggable_type',
        'flaggable_id',
        'user_id',
        'type',
        'value',
        'text'
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'user'          => 'required',
        'flaggable_id'   => 'required',
        'flaggable_type' => 'required'
    ];

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
    public $morphTo = [
        'flaggable' => []
    ];

    public $belongsTo = [
        'user' => User::class
    ];

    public function getUserOptions()
    {
        $users[] = [];

        foreach (User::all() as $user) {
            $users += [
                $user->id => $user->username
            ];
        }

        return array_filter($users);
    }

    public function getFlaggableTypeOptions()
    {
        return collect(config('appuser.userflag::aliases', []))->map(function($config) {
            return $config['model'];
        })->flip()->toArray();
    }

    public function getTypeOptions()
    {
        return config('appuser.userflag::type', []);
    }
}
