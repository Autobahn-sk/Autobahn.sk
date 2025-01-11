<?php namespace AppCommerce\ContactForm\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appcommerce_contactform_contact_forms', function (Blueprint $table) {
            $table->id();

            $table->string('email')->nullable()->index();
			$table->string('name')->nullable();
			$table->text('message')->nullable();

            $table->boolean('is_done')->default(false)->index();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appcommerce_contactform_contact_forms');
    }
};
