<?php namespace AppAd\Ad\Http\Controllers;

use AppAd\Ad\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AppAd\Ad\Http\Resources\AdResource;
use AppAd\Ad\Http\Resources\AdSimpleResource;
use AppApi\ApiResponse\Resources\ApiResource;

class AdController extends Controller
{
    public function index(Request $request)
    {
		$ads = Ad::isPublished()
			->when($request->get('condition'), function($query, $condition){
				$query->where('vehicle.condition', $condition);
			})
			->when($request->get('body_type'), function($query, $bodyType){
				$query->where('vehicle.body_type', $bodyType);
			})
			->when($request->get('manufacturer'), function($query, $manufacturer){
				$query->where('vehicle.manufacturer.id', $manufacturer);
			})
			->when($request->get('fuel_type'), function($query, $fuelType){
				$query->where('vehicle.fuel_type', $fuelType);
			})
			->when($request->get('price'), function($query, $price){
				$query->where('vehicle.current_price', $price);
			})
			->get();

		$response = AdSimpleResource::collection($ads);

		return ApiResource::success(data: $response);
	}

    public function show(Request $request, $slug)
    {
        $ad = Ad::isPublished()
			->with('vehicle')
			->with('prices')
			->where('slug', $slug)
			->firstOrFail();

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}
}
