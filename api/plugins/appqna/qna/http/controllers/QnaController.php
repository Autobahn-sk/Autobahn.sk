<?php namespace AppQna\Qna\Http\Controllers;

use AppQna\Qna\Models\Question;
use Illuminate\Routing\Controller;
use AppApi\ApiResponse\Resources\ApiResource;
use AppQna\Qna\Http\Resources\QuestionResource;

class QnaController extends Controller
{
    public function __invoke()
    {
		$category = request()->input('category');

        $questions = Question::isPublished()
			->when($category, function($query, $category) {
				return $query->where('category', $category);
			})
			->orderBy('sort_order')->get();

        $response = QuestionResource::collection($questions);

		return ApiResource::success(data: $response);
	}
}