<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplePostController;
use App\Http\Controllers\TempleCommentController;
use App\Http\Controllers\MetaController;
use App\Models\User;

use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {  

    return $request->user();
});
 
Route::controller(UserController::class)->group(function(){
    Route::post('login','login');
    Route::post('create','create');
});
Route::post('createPost', [TemplePostController::class , 'createPost']); 
Route::post('showDetail', [TemplePostController::class , 'showDetail']); 

Route::post('upload', [MetaController::class , 'upload']); 
Route::post('createMeta', [MetaController::class , 'createMeta']); 


Route::post('createComment', [TempleCommentController::class , 'createComment']); 


