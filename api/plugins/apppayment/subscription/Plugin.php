<?php namespace AppPayment\Subscription;

use Backend\Facades\Backend;
use System\Classes\PluginBase;
use AppPayment\Subscription\Console\SubscriptionsSync;
use AppPayment\Subscription\Classes\Extend\PlanExtend;
use AppPayment\Subscription\Classes\Extend\UserExtend;

/**
 * Subscription Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
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
     * @return array
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

