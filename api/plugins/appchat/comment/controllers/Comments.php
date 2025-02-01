<?php namespace AppChat\Comment\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use October\Rain\Support\Facades\Url;
use Illuminate\Support\Facades\Session;
use October\Rain\Support\Facades\Flash;
use Illuminate\Support\Facades\Redirect;

/**
 * Comments Back-end Controller
 */
class Comments extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];
    
    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';
    
    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';
    
    /**
     * @var string Configuration file for the `RelationController` behavior.
     */
    public $relationConfig = 'config_relation.yaml';
    
    public function __construct()
    {
        parent::__construct();
        
        BackendMenu::setContext('AppChat.Comment', 'comment', 'comments');
    }

	public function onClearFiler()
	{
		Flash::success('Filters are cleared!');
		Session::forget('widget');

		$current = Url::current();

		return Redirect::to($current);
	}
}
