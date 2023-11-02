<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ManageController;

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

Route::get('/',[ShopController::class,'index']);

Route::get('/search',[ShopController::class,'search']);

Route::get('/detail/{id}', [ShopController::class, 'detail']);

Route::get('/manage', [ShopController::class, 'manage']);

Route::post('/manager-register', [ShopController::class, 'register']);

Route::post('/store-register', [ShopController::class, 'store']);

Route::patch('/store-update/{id}',[ShopController::class,'update']);

Route::get('/search2', [ShopController::class, 'search2']);

Route::post('/nice/{id}',[FavoriteController::class,'store'])->name('favorite.store');

Route::delete('/unnice/{id}',[FavoriteController::class,'destroy'])->name('favorite.destroy');

Route::get('/mypage', [ReservationController::class, 'mypage']);

Route::post('/done',[ReservationController::class,'store']);

Route::patch('/update/{id}',[ReservationController::class,'update']);

Route::delete('/delete/{id}',[ReservationController::class,'destroy']);
