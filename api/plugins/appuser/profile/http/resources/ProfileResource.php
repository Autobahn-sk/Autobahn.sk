<?php namespace AppUser\Profile\Http\Resources;

use October\Rain\Support\Facades\Event;
use AppAd\Ad\Http\Resources\AdSimpleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        $response = [
            'id'       => $this->id,
			'name'     => $this->name,
			'username' => $this->username,
            'avatar'   => $this->avatar,
            'ads'      => AdSimpleResource::collection($this->ads()->isPublished()->get())
        ];

        Event::fire('appuser.profile.profile.beforeReturnResource', [&$response, $this->resource]);

        return $response;
    }
}
