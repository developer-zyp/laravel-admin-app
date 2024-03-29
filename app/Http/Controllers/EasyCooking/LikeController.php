<?php

namespace App\Http\Controllers\easycooking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EasyCooking\Post;
use App\Http\Responses\ApiResponse;
use App\Models\EasyCooking\Like;

class LikeController extends Controller
{
    //
    public function likeOrUnlike($id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = new ApiResponse(false, "Post not found.");
            return response()->json($response, 403);
        }

        $like = $post->likes()->where("user_id", auth()->user()->id)->first();

        if (!$like) {
            Like::create([
                "user_id" => auth()->user()->id,
                "post_id" => $id,
            ]);

            $response = new ApiResponse(true, "Liked");
            return response()->json($response);
        }

        $like->delete();

        $response = new ApiResponse(true, "Unliked");
        return response()->json($response);

    }
}
