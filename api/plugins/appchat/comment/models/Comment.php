<?php namespace AppChat\Comment\Models;

use October\Rain\Database\Model;

/**
 * Comment Model
 */
class Comment extends Model
{
	use \October\Rain\Database\Traits\Validation;

	use \October\Rain\Database\Traits\SoftDelete;

	use \October\Rain\Database\Traits\SimpleTree;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'appchat_comment_comments';
    
    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'content'
    ];
    
    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
		'creatable_type'   => 'required',
		'creatable_id'     => 'required',
		'commentable_type' => 'required',
		'commentable_id'   => 'required',
		'content'          => 'required'
    ];
    
    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [
        'commentable_id' => 'int'
    ];
    
    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    /**
     * @var array Relations
     */
    public $morphTo = [
        'commentable' => [],
        'creatable'   => []
    ];

    public $morphMany = [
        'answers' => [
            Comment::class,
            'name' => 'commentable'
        ]
    ];

	public function getCommentableTypeOptions()
	{
		return collect(config('appchat.comment::models_map', []))->map(function($config) {
			return $config['class'];
		})->flip()->toArray();
	}
}
