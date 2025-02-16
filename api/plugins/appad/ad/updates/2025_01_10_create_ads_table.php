<?php namespace AppAd\Ad\Updates;

use Schema;
use AppAd\Ad\Classes\Enums\AdStatusEnum;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateAdsTable Migration
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
        Schema::create('appad_ad_ads', function(Blueprint $table) {
            $table->id();
			$table->string('slug')->unique();

			$table->string('title');
			$table->longText('description');

			$table->string('status')->default(AdStatusEnum::DRAFT->value);

			$table->integer('user_id')->unsigned()->index();

			$table->string('location')->nullable();
			$table->string('google_place_id')->nullable();

			$table->string('youtube_url')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('appad_ad_ads');
    }
};
