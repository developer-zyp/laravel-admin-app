<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Models\EasyCooking\Category;
use App\Models\EasyCooking\HomeItem;
use App\Models\EasyCooking\NoEat;
use App\Models\EasyCooking\ViewType;
use App\Models\EasyCooking\Recipe;
use DB;
use Exception;

class EasyCookingApiController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function getRecipe(Request $request)
    {
        try {
            $recipeId = $request->query('id');
            $categoryId = $request->query('categoryid');
            $categoryType = $request->query('categorytype');
            $postId = $request->query('postid');
            $recipeType = $request->query('recipetype');

            $recipes = [];
            if ($recipeId) {
                $recipes = $this->getRecipeDetails($recipeId);
            } else if ($categoryId) {
                $recipes = $this->getRecipesByCategory($categoryId);
            } else if ($categoryType !== null) {
                $recipes = $this->getRecipesByCategoryType($categoryType);
            } else if ($postId) {
                $recipes = $this->getRecipesByPost($postId);
            } else if ($recipeType) {
                $recipes = $this->getRecipesByType($recipeType);
            } else {
                $response = new ApiResponse(false, 'Either categoryid or postid is required.');
                return response()->json($response, 400); // 400 Bad Request status code
            }

            $total = $recipes->count();

            $response = new ApiResponse(true, 'success', $recipes, $total);
            return response()->json($response);

        } catch (Exception $e) {
            $response = new ApiResponse(false, $e->getMessage());

            return response()->json($response, 500);
        }

    }

    private function getRecipeDetails($recipeId)
    {
        return Recipe::with('category')
            ->select('id', 'name', 'imageurl', 'seen', 'fav', 'categoryid')
            ->selectRaw('CONCAT("easycooking/recipes/", id) as detailsurl')
            ->where('id', $recipeId)
            ->get();
    }

    private function getRecipesByCategory($categoryId)
    {
        return Recipe::with('category')
            ->select('id', 'name', 'imageurl', 'seen', 'fav', 'categoryid')
            ->where('categoryid', $categoryId)
            ->get();

        //     DB::select('SELECT 
        //     ec_recipe.*,
        //     (
        //         SELECT JSON_OBJECT(
        //             "id", ec_category.id,
        //             "name", ec_category.name,
        //             "imageurl", ec_category.imageurl,
        //             "type", ec_category.type,
        //             "isdelete", ec_category.isdelete,
        //             "created_at", ec_category.created_at,
        //             "updated_at", ec_category.updated_at
        //         )
        //         FROM ec_category
        //         WHERE ec_category.id = ec_recipe.categoryid
        //     ) AS ec_category
        // FROM ec_recipe');


    }

    private function getRecipesByCategoryType($type)
    {
        return Recipe::with('category')
            ->select('id', 'name', 'imageurl', 'seen', 'fav', 'categoryid')
            ->whereHas('category', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->get();

        // DB::table('ec_recipe')
        //     ->join('ec_category', 'ec_recipe.categoryid', '=', 'ec_category.id')
        //     ->select(
        //         'ec_recipe.id',
        //         'ec_recipe.name',
        //         'ec_recipe.imageurl',
        //         'ec_recipe.seen',
        //         'ec_recipe.fav',
        //         'ec_category.* as category'
        //     ) // Adjust the columns as needed
        //     ->where('ec_category.type', $type)
        //     ->get();
    }

    private function getRecipesByPost($postId)
    {
        return Recipe::with('post')
            ->select('id', 'name', 'imageurl', 'seen', 'fav', 'postid')
            ->where('ec_post.id', $postId)
            ->get();
    }

    private function getRecipesByType($type)
    {
        if ($type == 'NEW_RECIPE') {
            return Recipe::with('category')
                ->select('id', 'name', 'imageurl', 'seen', 'fav', 'categoryid')
                ->orderBy('id', 'desc')
                ->limit(20)
                ->get();

        } else if ($type == 'POPULAR_RECIPE') {
            return Recipe::with('category')
                ->select('id', 'name', 'imageurl', 'seen', 'fav', 'categoryid')
                ->orderBy('seen', 'desc')
                ->limit(20)
                ->get();

        } else if ($type == 'COOKING_KNOWLEDGE') {
            return Recipe::with('category')
                ->select('id', 'name', 'imageurl', 'seen', 'fav', 'categoryid')
                ->whereHas('category', function ($query) {
                    $query->where('type', 3);
                })
                ->get();
        }
    }

    public function getCategory(Request $request)
    {
        $type = $request->query('type', 0);

        $category = DB::table('ec_category')->where('type', $type)->get();
        $total = $category->count();

        $response = new ApiResponse(true, 'success', $category, $total);

        return response()->json($response);
    }

    public function getNoEat(Request $request)
    {
        $noEatItems = DB::table(NoEat::tableName)->get();
        $total = $noEatItems->count();

        $response = new ApiResponse(true, 'success', $noEatItems, $total);

        return response()->json($response);
    }


    public function getHomeData()
    {

        $homeList = [new HomeItem(viewType: new ViewType()), new HomeItem()];
        $total = count($homeList);

        $response = new ApiResponse(true, 'success', $homeList, $total);

        return response()->json($response);
    }
}