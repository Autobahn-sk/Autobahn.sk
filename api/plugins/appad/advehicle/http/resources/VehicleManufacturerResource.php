<?php namespace AppAd\AdVehicle\Http\Resources;

use October\Rain\Support\Facades\Event;
use AppUtil\Util\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleManufacturerResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'   => $this->id,
            'code' => $this->code,
			'name' => $this->name,
			'logo' => new FileResource($this->logo)
        ];

        Event::fire('appad.advehicle.vehiclemanufacturer.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
