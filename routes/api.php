<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
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

// 
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum']], function(){
    // Person Routes
    Route::get('/person', [PersonController::class,'index']);
    Route::get('/person/{id}',  [PersonController::class,'show']);
    Route::post('/person',  [PersonController::class,'store']);
    Route::put('/person/{id}',  [PersonController::class,'update']);
    Route::delete('/person/{id}',  [PersonController::class,'destroy']);

    // Catégorie Routes
    Route::get('/categorieAnnonce', [CategorieAnonnceController::class,'index']);
    Route::get('/categorieAnnonce/{id}',  [CategorieAnonnceController::class,'show']);
    Route::post('/categorieAnnonce',  [CategorieAnonnceController::class,'store']);
    Route::put('/categorieAnnonce/{id}',  [CategorieAnonnceController::class,'update']);
    Route::delete('/categorieAnnonce/{id}',  [CategorieAnonnceController::class,'destroy']);

    Route::post('/logout',[AuthController::class,'logout']);
});