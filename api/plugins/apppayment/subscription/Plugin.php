<?php namespace AppPayment\Subscription;

use Backend\Facades\Backend;
use System\Classes\PluginBase;
use AppPayment\Subscription\Console\SubscriptionsSync;
use AppPayment\Subscription\Classes\Extend\PlanExtend;
use AppPayment\Subscription\Classes\Extend\UserExtend;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
	/*
     * Dependencies
     */
    public $require = [
		'AppUtil.Logger',
        'AppPayment.Stripe'
	];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Subscription',
            'description' => 'No description provided yet...',
            'author' => 'AppPayment',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
		//
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
	 */
    public function boot()
    {
		PlanExtend::addIsUserSubscribedToResource();

        UserExtend::addSubscriptionsToModelUser();
        UserExtend::cancelSubscriptionsOnUserDelete();

        $this->registerConsoleCommand('subscriptions.sync', SubscriptionsSync::class);
    }

    public function registerNavigation()
    {
        return [
            'subscription' => [
                'label' => 'Subscriptions',
                'url' => Backend::url('apppayment/subscription/subscriptions'),
                'icon' => 'icon-credit-card',
                'order' => 50
            ]
        ];
    }
}

