<?php

namespace App\Http\Controllers\easycooking;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use App\Models\EasyCooking\Post;
use Validator;

class PostController extends Controller
{
    // index
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")->with("user:id,name,image")->withCount("comments", "likes")->get(); //->paginate(10);

        $response = new ApiResponse(true, "posts", $posts);
        return response()->json($response);

    }

    public function show($id)
    {
        $posts = Post::where('id', $id)->with("user:id,name,image")->withCount("comments", "likes")->get();

        $response = new ApiResponse(true, "posts", $posts);
        return response()->json($response);

    }

    public function store(Request $request)
    {
        // $attr = $request->validate([
        //     "title" => "required|string",
        //     "content" => "nullable|string",
        // ]);

        $validator = Validator::make($request->all(), [
            "title" => "required|string",
        ]);

        if ($validator->fails()) {
            $response = new ApiResponse(false, "Validation failed.", error: $validator->errors()->all());
            return response()->json($response, 422);
        }

        $attr = $request->all();
        $attr['user_id'] = auth()->user()->id;

        $post = Post::create($attr);

        $response = new ApiResponse(true, "Post created.", $post);
        return response()->json($response);

    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = new ApiResponse(false, "Post not found.");
            return response()->json($response, 403);
        }

        if ($post->user_id != auth()->user()->id) {
            $response = new ApiResponse(false, "Permission denied.");
            return response()->json($response, 403);
        }

        $validator = Validator::make($request->all(), [
            "title" => "required",
        ]);

        if ($validator->fails()) {
            $response = new ApiResponse(false, "Validation failed.", error: $validator->errors()->all());
            return response()->json($response, 422);
        }

        // $attr = $request->validate([
        //     "title" => "required|string",
        //     "content" => "nullable|string",
        // ]);

        $post->update($request->all());

        $response = new ApiResponse(true, "Post updated.", $post);
        return response()->json($response);

    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            $response = new ApiResponse(false, "Post not found.");
            return response()->json($response, 403);
        }

        if ($post->user_id != auth()->user()->id) {
            $response = new ApiResponse(false, "Permission denied.");
            return response()->json($response, 403);
        }

        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();

        $response = new ApiResponse(true, "Post deleted.");
        return response()->json($response);

    }


}
