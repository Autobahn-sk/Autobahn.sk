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
	public function store(Request $request)
	{
		$price = new Price();

		$price->fill($request->all());

		$price->save();

		$response = new PriceResource($price);

		return ApiResource::success(data: $response);
	}

	public function storePriceOffer(Request $request)
	{
		$priceOffer = new PriceOffer();

		$priceOffer->user_id = $request->user()->id;

		$priceOffer->fill($request->all());

		$priceOffer->save();

		$response = new PriceOfferResource($priceOffer);

		return ApiResource::success(data: $response);
	}
}
