<?php namespace AppQna\Qna\Updates;

use Schema;
use AppQna\Qna\Models\Question;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appqna_qna_questions', function (Blueprint $table) {
            $table->id();

            $table->text('question');
            $table->text('answer');

			$table->boolean('is_published')->default(false);

			$table->unsignedTinyInteger('sort_order')->default(0);

            $table->timestamps();
			$table->softDeletes();
		});

        $faqs = json_decode(file_get_contents(__DIR__.'/../seeds/faqs.json'), true);

        foreach ($faqs as $faq) {
            $question = new Question();
            $question->question = $faq['question'];
            $question->answer = $faq['answer'];
			$question->is_published = $faq['is_published'];
            $question->sort_order = $faq['sort_order'];
            $question->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('appqna_qna_questions');
    }
};
