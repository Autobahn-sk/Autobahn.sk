<?php namespace AppUser\UserFlag\Http\Resources;

use October\Rain\Support\Facades\Event;
use AppUser\UserApi\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AppUser\UserFlag\Classes\Services\UserFlagService;

class UserFlagResource extends JsonResource
{
    public function toArray($request)
    {
        $flaggableResource = UserFlagService::getResourceClass_byModelClass(get_class($this->flaggable));

        $data = [
            'id'         => $this->id,
            'type'       => $this->type,
            'text'       => $this->text,
            'value'      => $this->value,
            'user'       => new UserResource($this->user),
            'flaggable'   => new $flaggableResource($this->flaggable),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        Event::fire('appuser.userflag.userflag.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
