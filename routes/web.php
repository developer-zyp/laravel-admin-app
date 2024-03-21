<?php

use App\Http\Controllers\EasyCookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('easycooking')->name('easycooking.')->group(function () {
    Route::get('/recipeslist', [EasyCookingController::class, 'index'])->name('recipeslist');
    Route::get('/recipes/{id}', [EasyCookingController::class, 'show'])->name('recipes.details');
    
});
