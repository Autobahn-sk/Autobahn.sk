<?php namespace AppAd\AdVehicle\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'            => $this->id,
			'vin'           => $this->vin,
			'license_plate' => $this->license_plate,
			'manufacturer'  => new VehicleManufacturerResource($this->manufacturer),
			'model'         => $this->model,
			'year'          => $this->year,
			'body_type'     => $this->body_type,
			'fuel_type'     => $this->fuel_type,
			'color'         => $this->color,
			'kilowatts'     => $this->kilowatts,
			'torque'        => $this->torque,
			'displacement'  => $this->displacement,
			'top_speed'     => $this->top_speed,
			'drive'         => $this->drive,
			'transmission'  => $this->transmission,
			'gears'         => $this->gears,
			'engine_type'   => $this->engine_type,
			'cylinders'     => $this->cylinders,
			'doors'         => $this->doors,
			'seats'         => $this->seats,
			'mileage'       => $this->mileage,
			'condition'     => $this->condition,
			'created_at'    => $this->created_at,
			'updated_at'    => $this->updated_at,
			'deleted_at'    => $this->deleted_at
        ];

        Event::fire('appad.advehicle.vehicle.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
