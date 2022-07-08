<?php

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

Route::get('/{id?}', [UserController::class, 'index'])->where(['id' => '[0-9]+']);

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/{id?}', [UserController::class, 'index'])->where(['id' => '[0-9]+'])->name('index');
    Route::put('/{id}', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('update');
    Route::put('/', [UserController::class, 'store'])->name('store');
});
