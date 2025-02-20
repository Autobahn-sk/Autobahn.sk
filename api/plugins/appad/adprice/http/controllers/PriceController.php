<?php namespace AppAd\Ad\Http\Controllers;

use AppAd\Ad\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AppAd\Ad\Http\Resources\AdResource;
use AppAd\Ad\Http\Resources\AdSimpleResource;
use AppApi\ApiResponse\Resources\ApiResource;
use AppUtil\Util\Classes\Utils\PaginationUtil;

class AdController extends Controller
{
    public function index(Request $request)
    {
		$sort = $request->get('sort', 'created_at');
		$order = $request->get('order', 'desc');

		$ads = Ad::isPublished()
			->when($request->get('condition'), function($query, $condition){
				$query->whereHas('vehicle', function($query) use ($condition){
					$query->where('condition', $condition);
				});
			})
			->when($request->get('body_type'), function($query, $bodyType){
				$query->whereHas('vehicle', function($query) use ($bodyType){
					$query->where('body_type', $bodyType);
				});
			})
			->when($request->get('manufacturer'), function($query, $manufacturer){
				$query->whereHas('vehicle', function($query) use ($manufacturer){
					$query->whereHas('manufacturer', function($query) use ($manufacturer){
						$query->where('code', $manufacturer);
					});
				});
			})
			->when($request->get('fuel_type'), function($query, $fuelType){
				$query->whereHas('vehicle', function($query) use ($fuelType){
					$query->where('fuel_type', $fuelType);
				});
			})
			->when($request->get('price'), function($query, $price){
				$query->whereHas('current_price', function($query) use ($price){
					$query->where('current_price', $price);
				});
			})
			->orderBy($sort, $order)
			->paginate(PaginationUtil::getPagination());

		return AdSimpleResource::collection($ads);
	}

    public function show(Request $request, $ad)
    {
		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function store(Request $request)
	{
		$ad = Ad::create($request->all());

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function update(Request $request, $ad)
	{
		$ad->update($request->all());

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function destroy(Request $request, $ad)
	{
		$ad->delete();

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}
}
