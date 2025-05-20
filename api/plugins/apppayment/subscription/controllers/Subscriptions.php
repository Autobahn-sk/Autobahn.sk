<?php namespace AppPayment\Subscription\Controllers;

use Exception;
use BackendMenu;
use Backend\Classes\Controller;
use October\Rain\Support\Facades\Flash;
use AppPayment\Subscription\Classes\SubscriptionCronUpdater;

/**
 * Subscriptions Back-end Controller
 */
class Subscriptions extends Controller
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

        BackendMenu::setContext('AppPayment.Subscription', 'subscription', 'subscriptions');
    }

	public function onStripeSync(): void
	{
		try {
			(new SubscriptionCronUpdater())->checkAllSubscriptions();

			Flash::success('Successfully synced with Stripe.');
		} catch (Exception $e) {
			Flash::error($e->getMessage());
		}
	}
}
