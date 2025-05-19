<?php namespace AppPayment\Plan\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
			'price'       => $this->price,
			'is_featured' => $this->is_featured,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ];

		Event::fire('apppayment.plan.beforeReturnResource', [&$data, $this->resource]);

		return $data;
	}
}
