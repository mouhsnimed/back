<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieAnonnceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/user', [UserController::class,'index']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    // User Routes
    Route::get('/user/{id}',  [UserController::class,'show']);
    Route::put('/user/{id}',  [UserController::class,'update']);
    Route::delete('/user/{id}',  [UserController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);
});

// Catégorie Routes
Route::get('/categorieAnnonce', [CategorieAnonnceController::class,'index']);
Route::get('/categorieAnnonce/{id}',  [CategorieAnonnceController::class,'show']);
Route::post('/categorieAnnonce',  [CategorieAnonnceController::class,'store']);
Route::put('/categorieAnnonce/{id}',  [CategorieAnonnceController::class,'update']);
Route::delete('/categorieAnnonce/{id}',  [CategorieAnonnceController::class,'destroy']);