<?php namespace AppAd\AdPrice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AppAd\AdPrice\Models\PriceOffer;
use AppApi\ApiResponse\Resources\ApiResource;
use AppAd\AdPrice\Http\Resources\PriceOfferResource;

class PriceOfferController extends Controller
{
	public function getPriceOffers(Request $request, $ad): ApiResource
	{
		$priceOffers = PriceOffer::where('ad_id', $ad->id)
			->get();

		$response = PriceOfferResource::collection($priceOffers);

		return ApiResource::success(data: $response);
	}

	public function storePriceOffer(Request $request, $ad, $user): ApiResource
	{
		$priceOffer = new PriceOffer();

		$priceOffer->ad_id = $ad->id;

		$priceOffer->user()->associate($user);

		$priceOffer->fill($request->all());

		$priceOffer->save();

		$response = new PriceOfferResource($priceOffer);

		return ApiResource::success(data: $response);
	}
}
