<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

/** Group route for API on users record. */
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']); // index view
    Route::get('/{id}', [UserController::class, 'show'])->where(["id" => "[0-9]+"]); // show specific user
    Route::post('/', [UserController::class, 'store']); // store user record
    Route::put('/', [UserController::class, 'update']); // update user record
});