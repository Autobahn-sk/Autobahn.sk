<?php namespace AppAd\AdPrice\Http\Resources;

use October\Rain\Support\Facades\Event;
use AppAd\Ad\Http\Resources\AdSimpleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AppUser\UserApi\Http\Resources\UserSimpleResource;

class PriceOfferResource extends JsonResource
{
    public function toArray($request)
    {
		$data = [
			'id'         => $this->id,
			'price'      => $this->price,
			'message'    => $this->message,
			'user'       => new UserSimpleResource($this->user),
			'ad' 	     => new AdSimpleResource($this->ad),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'deleted_at' => $this->deleted_at
		];

        Event::fire('appad.adprice.priceoffer.beforeReturnResource', [&$data, $this->resource]);

        return $data;
    }
}
