<?php namespace AppUser\Report\Http\Controllers;

use Illuminate\Routing\Controller;
use AppUser\UserApi\Facades\JWTAuth;
use October\Rain\Exception\SystemException;

class UserReportsController extends Controller
{
    public function store()
    {
        $user = JWTAuth::getUser();

        $reportableTypes = config('appuser.report::types', []);

        $type = input('type');
        $reportableClass = array_get($reportableTypes, $type);
        if (!$reportableClass) {
            throw new SystemException(sprintf('Reportable type "%s" not configured', $type));
        }

        $reportable = (new $reportableClass)->findOrFail(input('id'));

        $report = $user->reports()->make();
        $report->reportable = $reportable;
        $report->save();

        return [
            'success' => true
        ];
    }
}
