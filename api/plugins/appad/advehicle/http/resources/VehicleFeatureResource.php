<?php namespace AppAd\AdVehicle\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleFeatureResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'       => $this->id,
			'title'    => $this->title,
			'category' => $this->category
        ];

        Event::fire('appad.advehicle.vehiclefeature.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
