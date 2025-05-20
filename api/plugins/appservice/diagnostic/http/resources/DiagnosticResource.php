<?php namespace AppService\Diagnostic\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;
use AppUser\UserApi\Http\Resources\UserSimpleResource;

class DiagnosticResource extends JsonResource
{
    public function toArray($request)
    {
		$data = [
			'id'         => $this->id,
			'prompt'     => $this->prompt,
			'response'   => $this->response,
			'error'      => $this->error,
			'status'     => $this->status,
			'user' 	     => new UserSimpleResource($this->user),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'deleted_at' => $this->deleted_at
		];

        Event::fire('appad.adprice.priceoffer.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
