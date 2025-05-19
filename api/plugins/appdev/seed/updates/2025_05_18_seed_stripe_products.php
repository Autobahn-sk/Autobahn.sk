<?php namespace AppDev\Seed\Updates;

use October\Rain\Database\Updates\Migration;
use AppPayment\Stripe\Classes\ProductService;

/**
 * SeedStripeProducts Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
		ProductService::createProduct(
			'plan-subscription',
			'Plan',
			'Plan subscription'
		);
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
		//
    }
};
