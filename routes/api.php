<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
// });

Route::get('category', [CategoryController::class, 'allCategory']);

Route::get('category/{id}', [CategoryController::class, 'findCategoryId']);

Route::post('category/store', [CategoryController::class, 'store']);

Route::post('category/{id}/update', [CategoryController::class, 'update']);

Route::delete('category/{id}/destroy', [CategoryController::class, 'destroy']);

Route::get('post', [PostController::class, 'allPost']);

Route::get('post/{id}', [PostController::class, 'findPostId']);

Route::post('post/store', [PostController::class, 'store']);

Route::post('post/{id}/update', [PostController::class, 'update']);

Route::delete('post/{id}/destroy', [PostController::class, 'destroy']);

Route::post('user/store', [UserController::class, 'store']);

Route::post('user/{id}/update', [UserController::class, 'update']);

Route::delete('user/{id}/destroy', [UserController::class, 'destroy']);

Route::post('user/login', [UserController::class, 'login']);

Route::get('rol', [RolController::class, 'allRol']);
