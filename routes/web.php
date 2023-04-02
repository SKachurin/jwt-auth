<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\RowsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Auth
Route::post('/web_login',[WebAuthController::class,'web_login'])->name('web_login');
Route::get('/cms/auth_check',[WebAuthController::class,'auth_check'])->name('auth.check');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// File save
Route::post('/store',[RowsController::class,'store'])->name('store');

// Import
Route::get('/get_rows', [RowsController::class, 'index'])->name('get_rows');
//Route::post('rows/import/', [RowsController::class, 'import'])->name('rows.import');
Route::post('rows/validate_import/', [RowsController::class, 'validateAndImport'])->name('rows.validate_import');
