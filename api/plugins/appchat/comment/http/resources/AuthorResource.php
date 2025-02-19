<?php namespace AppChat\Comment\Http\Resources;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'   => $this->id,
            'name' => $this->name,
            'username' => $this->username,
			'avatar' => $this->avatar
		];
        
        Event::fire('appchat.comment.author.beforeReturnResource', [&$data, $this->resource]);
        
        return $data;
    }
}