<?php namespace AppAd\Ad\Http\Resources;

use October\Rain\Support\Facades\Event;
use AppAd\AdPrice\Http\Resources\PriceResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AppAd\AdVehicle\Http\Resources\VehicleResource;
use AppUser\UserApi\Http\Resources\UserSimpleResource;

class AdResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'               => $this->id,
			'objectID'         => $this->id,
            'title'            => $this->title,
            'slug'             => $this->slug,
			'description'      => $this->description,
			'user'             => new UserSimpleResource($this->user),
            'current_price'    => $this->current_price->price,
			'highest_price'    => $this->highest_price?->price,
			'difference_price' => $this->difference_price,
            'prices'           => PriceResource::collection($this->prices),
			'vehicle'          => new VehicleResource($this->vehicle),
			'images'           => $this->images,
			'attachments'      => $this->attachments,
			'status'           => $this->status,
			'location'         => $this->location,
			'google_place_id'  => $this->google_place_id,
			'youtube_url'      => $this->youtube_url,
			'created_at'       => $this->created_at,
			'updated_at'       => $this->updated_at,
			'deleted_at'       => $this->deleted_at
		];

        Event::fire('appad.ad.ad.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
