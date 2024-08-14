<?php

namespace App\Http\Controllers;

use App\Models\easycooking\Post;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Responses\ApiResponse;

class PostsController extends Controller
{
    //
    use DisableAuthorization;
    protected $model = Post::class;

    protected function buildShowFetchQuery(Request $request, array $requestedRelations): Builder
    {
        $query = parent::buildShowFetchQuery($request, $requestedRelations);

        $query->withCount("comments", "likes");

        return $query;
    }

    protected function runShowFetchQuery(\Orion\Http\Requests\Request $request, Builder $query, $key): \Illuminate\Database\Eloquent\Model
    {
        $post = $query->find($key)?? new Post();
        return $post;
    }

}
