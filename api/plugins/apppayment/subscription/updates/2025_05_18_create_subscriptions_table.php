<?php namespace AppPayment\Subscription\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateSubscriptionsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('apppayment_subscription_subscriptions', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('plan_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('status')->index();
            $table->string('stripe_id')->index();
            $table->timestamp('cancelled_at')->nullable();
            $table->boolean('is_primary')->default(true);

			$table->timestamps();
			$table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apppayment_subscription_subscriptions');
    }
};
