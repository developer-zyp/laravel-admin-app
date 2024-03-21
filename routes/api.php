<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\EasyCookingApiController;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/recipe', RecipeController::class);

Route::prefix('easycooking')->name('easycooking.')->group(function () {
    Route::get('/homedata', [EasyCookingApiController::class, 'getHomeData'])->name('homedata');
    Route::get('/recipes', [EasyCookingApiController::class, 'getRecipe'])->name('recipeslist');
    Route::get('/category', [EasyCookingApiController::class, 'getCategory'])->name('category');
    Route::get('/noeat', [EasyCookingApiController::class, 'getNoEat'])->name('noeat');
});


Route::post('/sync-data', [ApiController::class, 'syncData'])->name('syncdata')->middleware('api_key');