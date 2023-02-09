<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;


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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(PostController::class)->group(function () {
    Route::get('posts', 'index');
    Route::post('post', 'store');
    Route::get('post/{id}', 'show');
    Route::put('post/{id}', 'update')->middleware('check');;
    Route::delete('post/{id}', 'destroy')->middleware('check');;
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
