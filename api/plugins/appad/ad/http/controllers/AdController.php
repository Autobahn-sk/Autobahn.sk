<?php namespace AppAd\Ad\Http\Controllers;

use AppAd\Ad\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AppAd\Ad\Http\Resources\AdResource;
use AppAd\Ad\Http\Resources\AdSimpleResource;
use AppApi\ApiResponse\Resources\ApiResource;
use AppUtil\Util\Classes\Utils\PaginationUtil;
use AppAlgolia\AlgoliaSearch\Classes\Services\AlgoliaSearchService;

class AdController extends Controller
{
    public function index(Request $request)
    {
		$sort = $request->input('sort', 'created_at');
		$order = $request->input('order', 'desc');

		$ads = Ad::isPublished()
			->when($request->input('condition'), function($query, $condition){
				$query->whereHas('vehicle', function($query) use ($condition){
					$query->where('condition', $condition);
				});
			})
			->when($request->input('body_type'), function($query, $bodyType){
				$query->whereHas('vehicle', function($query) use ($bodyType){
					$query->where('body_type', $bodyType);
				});
			})
			->when($request->input('manufacturer'), function($query, $manufacturer){
				$query->whereHas('vehicle', function($query) use ($manufacturer){
					$query->whereHas('manufacturer', function($query) use ($manufacturer){
						$query->where('code', $manufacturer);
					});
				});
			})
			->when($request->input('fuel_type'), function($query, $fuelType){
				$query->whereHas('vehicle', function($query) use ($fuelType){
					$query->where('fuel_type', $fuelType);
				});
			})
			->when($request->input('price'), function($query, $price){
				$query->whereHas('current_price', function($query) use ($price){
					$query->where('current_price', $price);
				});
			})
			->orderBy($sort, $order)
			->paginate(PaginationUtil::getPagination());

		return AdSimpleResource::collection($ads);
	}

	public function search(Request $request)
	{
		$algolia = new AlgoliaSearchService(env('ALGOLIA_INDEX'));

		$ads = $algolia->search($request->input('query'));

		return ApiResource::success(data: $ads['hits']);
	}

    public function show(Request $request, $ad)
    {
		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function store(Request $request)
	{
		$ad = new Ad();

		$ad->fill($request->all());

		$ad->user_id = $request->user()->id;

		$ad->save();

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
