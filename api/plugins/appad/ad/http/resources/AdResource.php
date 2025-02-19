<?php namespace AppAd\Ad\Http\Resources;

use October\Rain\Support\Facades\Event;
use AppAd\AdPrice\Http\Resources\PriceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'            => $this->id,
            'title'         => $this->title,
            'slug'          => $this->slug,
			'description'   => $this->description,
            'current_price' => $this->current_price->price,
			'highest_price' => $this->highest_price?->price,
			'difference_price'    => $this->difference_price,
            'prices'        => PriceResource::collection($this->prices)
        ];

        Event::fire('appad.ad.ad.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
