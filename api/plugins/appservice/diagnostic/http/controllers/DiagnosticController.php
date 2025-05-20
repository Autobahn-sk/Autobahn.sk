<?php namespace AppService\Diagnostic\Http\Controllers;

use Illuminate\Http\Request;
use RainLab\User\Models\User;
use Illuminate\Routing\Controller;
use AppService\Diagnostic\Models\Diagnostic;
use AppApi\ApiResponse\Resources\ApiResource;
use AppService\Diagnostic\Http\Resources\DiagnosticResource;
use AppService\Diagnostic\Classes\Enums\DiagnosticStatusEnum;

class DiagnosticController extends Controller
{
	/**
	 * Handles the display of a diagnostic resource and returns a success response.
	 *
	 * @param Request $request The incoming HTTP request instance.
	 * @param Diagnostic $diagnostic The diagnostic entity to be processed.
	 * @return ApiResource The formatted API success response containing the diagnostic resource.
	 */
	public function show(Request $request, Diagnostic $diagnostic): ApiResource
	{
		$response = new DiagnosticResource($diagnostic);

		return ApiResource::success(data: $response);
	}

	/**
	 * Handles the creation of a new diagnostic resource and returns a success response.
	 *
	 * @param Request $request The incoming HTTP request instance.
	 * @param User $user The user associated with the diagnostic entity.
	 * @return ApiResource The formatted API success response containing the newly created diagnostic resource.
	 */
	public function store(Request $request, User $user): ApiResource
	{
		$diagnostic = new Diagnostic();

		$diagnostic->prompt = $request->input('prompt');

		$diagnostic->user = $user;

		$diagnostic->status = DiagnosticStatusEnum::PENDING->value;

		$diagnostic->save();

		$response = new DiagnosticResource($diagnostic);

		return ApiResource::success(data: $response);
	}
}
