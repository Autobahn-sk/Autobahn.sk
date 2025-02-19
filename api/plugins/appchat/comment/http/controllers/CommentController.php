<?php namespace AppChat\Comment\Http\Controllers;

use Illuminate\Http\Request;
use AppUser\UserApi\Models\User;
use Illuminate\Routing\Controller;
use AppChat\Comment\Models\Comment;
use AppApi\ApiResponse\Resources\ApiResource;
use AppChat\Comment\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index(Request $request, $model, $modelId, User $user)
    {
        $data = Comment::where('commentable_type', $model['class'])->where('commentable_id', (int) $modelId)->get();
        
        if ($model['order_direction'] == 'asc') {
            $sorted = $data->sortBy($model['order_column']);
        } else {
            $sorted = $data->sortByDesc($model['order_column']);
        }
        
        $sorted = $sorted->each(function($item) use ($model) {
            if (!$item->answers->isEmpty()) {
                $data = $item->answers;
                
                if ($model['order_direction'] == 'asc') {
                    $sorted = $data->sortBy($model['order_column']);
                } else {
                    $sorted = $data->sortByDesc($model['order_column']);
                }
                
                $item->answers = $sorted->values();
            }
        });
        
        $response = CommentResource::collection($sorted->values());

		return ApiResource::success(data: $response);
	}

    public function show(Request $request, Comment $comment)
    {
		$response = new CommentResource($comment);

		return ApiResource::success(data: $response);
	}

    public function store(Request $request, $model, $modelId, User $user)
    {
        $comment = new Comment;
        $comment->creatable = $user;
        $comment->commentable_type = $model['class'];
        $comment->commentable_id = $modelId;
        $comment->content = $request->text;
        
        $comment->save();

		$response = new CommentResource($comment);

		return ApiResource::success(data: $response);
	}

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'content' => $request->text
        ]);
        
        $response = new CommentResource($comment->reload());

		return ApiResource::success(data: $response);
	}

    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();

		$response = new CommentResource($comment);

		return ApiResource::success(data: $response);
	}
}