<?php namespace AppChat\Comment\Http\Resources;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray($request)
    {
        $userResourceClass = config('appchat.comment::resources.author');
        
        $data = [
            'id'               => $this->id,
            'author_id'        => $this->when($this->creatable, function() {
                return $this->creatable->id;
            }),
            'author'           => $this->when($this->creatable, function() use ($userResourceClass) {
                return new $userResourceClass($this->creatable);
            }),
            'commentable_id'   => $this->commentable_id,
            'commentable_type' => $this->commentable_type,
            'content'          => $this->content,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at
        ];
        
        Event::fire('appchat.comment.answer.beforeReturnResource', [&$data, $this->resource]);
        
        return $data;
    }
}