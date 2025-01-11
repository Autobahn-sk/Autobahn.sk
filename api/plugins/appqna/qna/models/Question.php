<?php namespace AppQna\Qna\Models;

use Model;
use Illuminate\Validation\Rule;
use AppQna\Qna\Classes\Enums\QuestionCategoryEnum;

/**
 * Question Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Question extends Model
{
	use \October\Rain\Database\Traits\Sortable;
	use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

	public $table = 'appqna_qna_questions';

    public $rules = [
        'question' => 'required|string',
        'answer' => 'required|string',
        'sort_order' => 'nullable|integer'
    ];

	public function scopeIsPublished($query)
	{
		return $query->where('is_published', true);
	}

	public function beforeValidate()
	{
		$this->rules['category'] = Rule::in(QuestionCategoryEnum::values()) . '|string';
	}

	public function getCategoryOptions()
	{
		return QuestionCategoryEnum::optionsForBackend();
	}
}
