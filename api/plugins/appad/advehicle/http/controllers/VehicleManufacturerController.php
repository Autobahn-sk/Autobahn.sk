<?php namespace AppAd\AdVehicle\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AppApi\ApiResponse\Resources\ApiResource;
use AppAd\AdVehicle\Models\VehicleManufacturer;
use AppAd\AdVehicle\Http\Resources\VehicleManufacturerResource;

class VehicleManufacturerController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param Request $request
	 * @return ApiResource
	 */
    public function __invoke(Request $request): ApiResource
	{
		$vehicleManufacturers = VehicleManufacturer::isPublished()
			->get();

		$response = VehicleManufacturerResource::collection($vehicleManufacturers);

		return ApiResource::success(data: $response);
	}
}
