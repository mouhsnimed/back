<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieAnnonceController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\IllustrationController;
use App\Http\Controllers\ShooterController;

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
Route::get('/user/{id}',  [UserController::class,'show']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    // User Routes
    Route::put('/user/{id}',  [UserController::class,'update']);
    Route::delete('/user/{id}',  [UserController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/addAnnonce',[AnnonceController::class,'store']);
    Route::post('/uploadFiles',[MediaController::class,'store']);
    Route::get('/myAnnonces',[AnnonceController::class,'myAnnonces']);
    Route::delete('/Annonce/{id}',  [AnnonceController::class,'destroy']);
});

// Catégorie Routes
Route::get('/categorieAnnonce', [CategorieAnnonceController::class,'index']);
Route::get('/categorieAnnonce/{id}',  [CategorieAnnonceController::class,'show']);


// Catégorie Routes
Route::get('/Annonce', [AnnonceController::class,'index']);
Route::get('/AnnonceList', [AnnonceController::class,'list']);
Route::get('/Annonce/{id}',  [AnnonceController::class,'show']);
Route::post('/Annonce/search',  [AnnonceController::class,'search']);

// Illustration Route
Route::get('/Illustration', [IllustrationController::class,'index']);
Route::get('/Illustration/{id}',  [IllustrationController::class,'show']);
Route::post('/Illustration/search',  [IllustrationController::class,'search']);
Route::put('/Illustration/vote/{id}',  [IllustrationController::class,'vote']);
Route::put('/Illustration/search',  [IllustrationController::class,'search']);

// Shooter Route
Route::get('/Shooter', [ShooterController::class,'index']);