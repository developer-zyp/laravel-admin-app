<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\EasyCookingApiController;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
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
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/loginusers', [AuthController::class, 'loginusers']);

    Route::controller(AuthController::class)->group(function () {
        Route::post('/products', 'store');
        Route::post('/products/{id}', 'update');
        Route::delete('/products/{id}', 'destroy');
    });
});
