<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

/** Index page / Welcome page */
Route::get('/{id?}', [UserController::class, 'index'])->where(['id' => '[0-9]+']);

/** Group route for users record. */
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/{id?}', [UserController::class, 'index'])->where(['id' => '[0-9]+'])->name('index'); // users.index
    Route::put('/{id}', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('update'); // users.update
    Route::put('/', [UserController::class, 'store'])->name('store'); // users.store
});
