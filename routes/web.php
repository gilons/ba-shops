<?php

use App\Http\Controllers\API\ManageItemController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard/manage-product/{id}', [ItemController::class, 'index']);
Route::get('/dashboard/manage-product',[ItemController::class, 'index']);
Auth::routes();
Route::apiResource('/manage-product', ManageItemController::class);
Route::get('/fetch-items',[ManageItemController::class, 'fetch']);
Route::get('/fetch-item/{id}',[ItemController::class,'fetch']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
