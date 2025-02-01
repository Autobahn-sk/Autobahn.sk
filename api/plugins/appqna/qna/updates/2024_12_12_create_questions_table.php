<?php namespace AppQna\Qna\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appqna_qna_questions', function (Blueprint $table) {
            $table->id();

            $table->text('question');
            $table->text('answer');

			$table->text('category')->nullable();

			$table->boolean('is_published')->default(false);

			$table->unsignedTinyInteger('sort_order')->default(0);

            $table->timestamps();
			$table->softDeletes();
		});
    }

    public function down()
    {
        Schema::dropIfExists('appqna_qna_questions');
    }
};
