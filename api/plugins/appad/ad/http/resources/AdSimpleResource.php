<?php namespace AppAd\Ad\Http\Resources;

use October\Rain\Support\Facades\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class AdSimpleResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'                => $this->id,
			'title' 			=> $this->title,
			'slug' 				=> $this->slug,
			'summary' 			=> $this->summary,
			'thumbnail' 		=> $this->thumbnail,
			'badge' 			=> $this->badge,
			'current_price'     => $this->current_price->price,
			'mileage' 			=> $this->vehicle->mileage,
			'fuel_type' 		=> $this->vehicle->fuel_type,
			'transmission' 		=> $this->vehicle->transmission
        ];

        Event::fire('appad.ad.adSimple.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
