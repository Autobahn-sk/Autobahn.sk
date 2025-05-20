<?php namespace AppAd\AdPrice\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreatePriceOffersTable Migration
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
        Schema::create('appad_adprice_price_offers', function(Blueprint $table) {
            $table->id();

			$table->decimal('price', 10, 2)->nullable();
			$table->text('message')->nullable();

			$table->integer('ad_id')->unsigned()->nullable()->index();
			$table->integer('user_id')->unsigned()->nullable()->index();

			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appad_adprice_price_offers');
    }
};
