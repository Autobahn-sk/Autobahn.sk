<?php namespace AppUser\Report\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use October\Rain\Exception\SystemException;
use AppApi\ApiResponse\Resources\ApiResource;

class UserReportsController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        $reportableTypes = config('appuser.report::types', []);

        $type = $request->input('type');
        $reportableClass = array_get($reportableTypes, $type);
        if (!$reportableClass) {
            throw new SystemException(sprintf('Reportable type "%s" not configured', $type));
        }

        $reportable = (new $reportableClass)->findOrFail($request->input('id'));

        $report = $user->reports()->make();
        $report->reportable = $reportable;
        $report->save();

		return ApiResource::success();
	}
}
