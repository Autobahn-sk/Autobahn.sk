<?php namespace AppAd\AdVehicle\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleManufacturerResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'         => $this->id,
            'code'       => $this->code,
			'name'       => $this->name,
			'logo'       => $this->logo,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at
        ];

        Event::fire('appad.advehicle.vehiclemanufacturer.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
