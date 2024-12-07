<?php namespace AppUser\UserApi\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSimpleResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'username' => $this->username,
            'email' => $this->email,
        ];

        return $data;
    }
}
