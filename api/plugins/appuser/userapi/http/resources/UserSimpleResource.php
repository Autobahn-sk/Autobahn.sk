<?php namespace AppUser\UserApi\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSimpleResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
			'avatar' => $this->avatar,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
			'location' => $this->location,
			'google_place_id' => $this->google_place_id
        ];

		Event::fire('appuser.userapi.user.beforeReturnSimpleResource', [&$data, $this->resource]);

		return $data;
    }
}
