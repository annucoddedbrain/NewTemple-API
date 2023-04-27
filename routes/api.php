<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplePostController;
use App\Http\Controllers\MetaController;
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

Route::post('createUser', [UserController::class , 'create']);   // for uploading User details
Route::post('show', [UserController::class , 'index']); // for showing all User details

Route::post('createPost', [TemplePostController::class , 'createPost']); 
Route::post('showDetail', [TemplePostController::class , 'showDetail']); 

Route::post('upload', [MetaController::class , 'upload']); 
Route::post('createMeta', [MetaController::class , 'createMeta']); 


