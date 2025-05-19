<?php namespace AppAd\Ad\Http\Controllers;

use Db;
use AppAd\Ad\Models\Ad;
use Illuminate\Http\Request;
use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppAd\Ad\Http\Resources\AdResource;
use AppAd\Ad\Http\Resources\AdSimpleResource;
use AppApi\ApiResponse\Resources\ApiResource;
use AppUtil\Util\Classes\Utils\PaginationUtil;
use AppAd\AdPrice\Http\Resources\PriceResource;
use AppOpenAI\OpenAIChat\Classes\Services\OpenAIChatService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use AppAlgolia\AlgoliaSearch\Classes\Services\AlgoliaSearchService;

class AdController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
	{
		$sortMap = [
			'price_lowest'    => ['column' => 'latest_prices.price',     'order' => 'asc',  'join' => 'price'],
			'price_highest'   => ['column' => 'latest_prices.price',     'order' => 'desc', 'join' => 'price'],
			'mileage_lowest'  => ['column' => 'v.mileage',               'order' => 'asc',  'join' => 'vehicle'],
			'mileage_highest' => ['column' => 'v.mileage',               'order' => 'desc', 'join' => 'vehicle'],
			'year_newest'     => ['column' => 'v.year',                  'order' => 'desc', 'join' => 'vehicle'],
			'year_oldest'     => ['column' => 'v.year',                  'order' => 'asc',  'join' => 'vehicle'],
			'created_newest'  => ['column' => 'appad_ad_ads.created_at', 'order' => 'desc'],
			'created_oldest'  => ['column' => 'appad_ad_ads.created_at', 'order' => 'asc']
		];

		$sortAlias = $request->input('sort', 'created_newest');
		$sortConfig = $sortMap[$sortAlias] ?? $sortMap['created_newest'];

		$adsQuery = Ad::isPublished()->with(['vehicle.manufacturer']);

		if (!empty($sortConfig['join']) && $sortConfig['join'] === 'vehicle') {
			$adsQuery->leftJoin('appad_advehicle_vehicles as v', 'appad_ad_ads.id', '=', 'v.id');
		}

		if (!empty($sortConfig['join']) && $sortConfig['join'] === 'price') {
			$latestPricesSub = DB::table('appad_adprice_prices as p1')
				->select('p1.ad_id', 'p1.price')
				->join(DB::raw('(SELECT ad_id, MAX(created_at) as max_created FROM appad_adprice_prices GROUP BY ad_id) as p2'), function ($join) {
					$join->on('p1.ad_id', '=', 'p2.ad_id')
						->on('p1.created_at', '=', 'p2.max_created');
				});

			$adsQuery->leftJoinSub($latestPricesSub, 'latest_prices', function ($join) {
				$join->on('appad_ad_ads.id', '=', 'latest_prices.ad_id');
			});
		}

		$ads = $adsQuery
			->when($request->input('condition'), function ($query, $condition) {
				$query->whereHas('vehicle', fn($q) => $q->where('condition', $condition));
			})
			->when($request->input('body_type'), function ($query, $bodyType) {
				$query->whereHas('vehicle', fn($q) => $q->where('body_type', $bodyType));
			})
			->when($request->input('manufacturer'), function ($query, $manufacturer) {
				$query->whereHas('vehicle.manufacturer', fn($q) => $q->where('code', $manufacturer));
			})
			->when($request->input('fuel_type'), function ($query, $fuelType) {
				$query->whereHas('vehicle', fn($q) => $q->where('fuel_type', $fuelType));
			})
			->orderBy($sortConfig['column'], $sortConfig['order'])
			->paginate(PaginationUtil::getPagination());

		return AdSimpleResource::collection($ads);
	}

	public function search(Request $request): ApiResource
	{
		$algolia = new AlgoliaSearchService(env('ALGOLIA_INDEX'));

		$params = [
			'hitsPerPage' => PaginationUtil::getPagination()
		];

		$ads = $algolia->search($request->input('query'), $params);

		return ApiResource::success(data: $ads['hits']);
	}

    public function show(Request $request, $ad): ApiResource
    {
		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function store(Request $request, User $user): ApiResource
	{
		$request->validate([
			'title'       => 'required',
			'description' => 'required',
			'status' 	  => 'required',
			'images'      => 'required'
		]);

		$ad = new Ad();

		$ad->fill($request->all());

		$ad->user()->associate($user);

		$ad->slugAttributes();

		$ad->save();

		$ad->saveRelations($request);

		$ad->load(['images', 'attachments', 'vehicle', 'vehicle.manufacturer', 'vehicle.features', 'prices']);

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function update(Request $request, $ad): ApiResource
	{
		$ad->update($request->all());

		$ad->images()
			->whereIn('id', post('images_ids_to_delete', []))
			->delete();

		$ad->attachments()
			->whereIn('id', post('attachments_ids_to_delete', []))
			->delete();

		$ad->saveRelations($request);

		$ad->load(['images', 'attachments', 'vehicle', 'vehicle.manufacturer', 'vehicle.features', 'prices']);

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function destroy(Request $request, $ad): ApiResource
	{
		$ad->delete();

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}

	public function adPriceHistory(Request $request, $ad): ApiResource
	{
		$prices = $ad->prices()
			->orderBy('created_at', 'desc')
			->get();

		$response = PriceResource::collection($prices);

		return ApiResource::success(data: $response);
	}

	public function generateAdDescription(Request $request, $ad): ApiResource
	{
		$adData = $ad->load(['vehicle', 'vehicle.manufacturer', 'vehicle.features'])->toArray();

		$description = (new OpenAIChatService)->generateAdDescription($adData);

		if ($description) {
			$ad->description = $description;
			$ad->save();
		}

		$response = new AdResource($ad);

		return ApiResource::success(data: $response);
	}
}
