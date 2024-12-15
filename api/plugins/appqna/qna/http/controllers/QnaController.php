<?php namespace AppQna\Qna\Http\Controllers;

use AppQna\Qna\Models\Question;
use Illuminate\Routing\Controller;
use AppApi\ApiResponse\Resources\ApiResource;
use AppQna\Qna\Http\Resources\QuestionResource;

class QnaController extends Controller
{
    public function __invoke()
    {
        $questions = Question::isPublished()->orderBy('sort_order')->get();

        $response = QuestionResource::collection($questions);

		return ApiResource::success(data: $response);
	}
}