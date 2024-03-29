<?php

namespace App\Http\Controllers\easycooking;

use App\Http\Controllers\Controller;
use App\Models\easycooking\Comment;
use Illuminate\Http\Request;
use App\Models\EasyCooking\Post;
use App\Http\Responses\ApiResponse;
use Validator;

class CommentController extends Controller
{
    //
    public function index($id)
    {

        $post = Post::find($id);

        if (!$post) {
            $response = new ApiResponse(false, "Post not found.");
            return response()->json($response, 403);
        }

        $comment = $post->comments()->with("user:id,name,image")->get();

        $response = new ApiResponse(true, "comments", $comment);
        return response()->json($response);
    }

    public function store(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = new ApiResponse(false, "Post not found.");
            return response()->json($response, 403);
        }

        $attr = $request->validate([
            "content" => "required|string",
        ]);

        Comment::create([
            "content" => $attr["content"],
            "post_id" => $id,
            "user_id" => auth()->user()->id,
        ]);

        $response = new ApiResponse(true, "Comment created.");
        return response()->json($response);

    }

    public function update(Request $request, $id)
    {

        $comment = Comment::find($id);

        if (!$comment) {
            $response = new ApiResponse(false, "Comment not found.");
            return response()->json($response, 403);
        }

        if ($comment->user_id != auth()->user()->id) {
            $response = new ApiResponse(false, "Permission denied.");
            return response()->json($response, 403);
        }

        $attr = $request->validate([
            "content" => "required|string",
        ]);

        $comment->update($request->all());

        $response = new ApiResponse(true, "Comment updated.", $comment);
        return response()->json($response);

    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            $response = new ApiResponse(false, "Comment not found.");
            return response()->json($response, 403);
        }

        if ($comment->user_id != auth()->user()->id) {
            $response = new ApiResponse(false, "Permission denied.");
            return response()->json($response, 403);
        }

        $comment->delete();

        $response = new ApiResponse(true, "Comment deleted.");
        return response()->json($response);

    }

}
