<?php namespace AppAd\AdPrice\Http\Controllers;

use Illuminate\Http\Request;
use AppAd\AdPrice\Models\Price;
use Illuminate\Routing\Controller;
use AppAd\AdPrice\Models\PriceOffer;
use AppApi\ApiResponse\Resources\ApiResource;
use AppAd\AdPrice\Http\Resources\PriceResource;
use AppAd\AdPrice\Http\Resources\PriceOfferResource;

class PriceController extends Controller
{
	public function adPriceHistory(Request $request, $ad)
	{
		$prices = $ad->prices()
			->orderBy('created_at', 'desc')
			->get();

		$response = PriceResource::collection($prices);

		return ApiResource::success(data: $response);
	}

	public function storePriceOffer(Request $request, $ad)
	{
		$priceOffer = new PriceOffer();

		$priceOffer->ad_id = $ad->id;

		$priceOffer->user()->associate($request->user());

		$priceOffer->fill($request->all());

		$priceOffer->save();

		$response = new PriceOfferResource($priceOffer);

		return ApiResource::success(data: $response);
	}
}
