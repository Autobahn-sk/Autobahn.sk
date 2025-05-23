<?php namespace AppUser\Report\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use October\Rain\Support\Facades\Url;
use Illuminate\Support\Facades\Session;
use October\Rain\Support\Facades\Flash;
use Illuminate\Support\Facades\Redirect;

/**
 * User Reports Back-end Controller
 */
class UserReports extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AppUser.Report', 'report', 'userreports');
    }

    public function onClearFiler()
    {
        Flash::success('Filters are cleared!');
        Session::forget('widget');

        $current = Url::current();

        return Redirect::to($current);
    }
}
