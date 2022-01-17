<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JwtController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get("list",[UserController::class,'list']);
// Route::post("add",[UserController::class,'add']);
Route::group(['middleware'=>['jwt']], function ($router) {
    Route::get('getuser',[JwtController::class,'get_user']);
    Route::post('logout',[JwtController::class,'logout']);
    Route::post('refresh',[JwtController::class,'refresh']);
    Route::get('profile',[JwtController::class,'profile']);
    Route::post('changePassword',[JwtController::class,'changePassword']);

        
});

Route::post('login',[JwtController::class,'login']);
Route::post('register',[JwtController::class,'register']);
Route::post('contact',[JwtController::class,'contact']);
Route::get('banner',[JwtController::class,'banner']);
Route::get('cms',[JwtController::class,'cms']);
Route::get('category',[JwtController::class,'category']);
Route::get('product',[JwtController::class,'product']);
Route::get('category/{id}',[JwtController::class,'show']);
Route::get('categories',[CategoryController::class,'apicategory']);
Route::post('checkout',[JwtController::class,'checkout']);