<?php namespace AppPayment\Plan\Http\Controllers;

use Illuminate\Http\Request;
use AppPayment\Plan\Models\Plan;
use Illuminate\Routing\Controller;
use AppApi\ApiResponse\Resources\ApiResource;
use AppPayment\Plan\Http\Resources\PlanResource;

class PlanController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param Request $request
	 * @return ApiResource
	 */
    public function __invoke(Request $request): ApiResource
    {
        $response = PlanResource::collection(
			Plan::isPublished()
				->orderBy('sort_order')
				->get()
		);

		return ApiResource::success(data: $response);
	}
}
