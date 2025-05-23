<?php namespace AppChat\Comment\Behaviors;

use System\Classes\ModelBehavior;
use AppChat\Comment\Models\Comment;

class CommentableModel extends ModelBehavior
{
    public function __construct($model)
    {
        parent::__construct($model);
        
        $model->morphMany['comments'] = [
            Comment::class,
            'name'       => 'commentable',
            'delete'     => true,
            'softDelete' => true
        ];
    }
    
    public function createComment($data, $creatable)
    {
        $comment = $this->comments()->make($data);
        $comment->creatable = $creatable;
        $comment->save();
        
        return $comment;
    }
}