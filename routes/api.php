<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\easycooking\CommentController;
use App\Http\Controllers\easycooking\LikeController;
use App\Http\Controllers\easycooking\PostController;
use App\Http\Controllers\EasyCookingApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::prefix('easycooking')->name('easycooking.')->group(function () {
    Route::get('/homedata', [EasyCookingApiController::class, 'getHomeData'])->name('homedata');
    Route::get('/recipes', [EasyCookingApiController::class, 'getRecipe'])->name('recipeslist');
    Route::get('/category', [EasyCookingApiController::class, 'getCategory'])->name('category');
    Route::get('/noeat', [EasyCookingApiController::class, 'getNoEat'])->name('noeat');
});


Route::post('/sync-data', [ApiController::class, 'syncData'])->name('syncdata')->middleware('api_key');

// Public routes of authtication
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

// Protected routes of product and logout
Route::middleware('auth:sanctum')->group(function () {

    // User
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/loginusers', [AuthController::class, 'loginusers']);

    Route::controller(AuthController::class)->group(function () {
        Route::post('/products', 'store');
        Route::post('/products/{id}', 'update');
        Route::delete('/products/{id}', 'destroy');
    });

    // Post
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    // Comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']);
    Route::post('/posts/{id}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // Like
    Route::get('/posts/{id}/likes', [LikeController::class, 'likeorunlike']);

});
