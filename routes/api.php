<?php

use Illuminate\Http\Request;

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


Route::middleware([ 'auth:api'])->get('/user', function (Request $request) {
// Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api', 'middleware' => 'return-json'], function () {

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
});


Route::group(['prefix' => 'user'], function () {

    Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/create', [App\Http\Controllers\Api\UserController::class, 'saveUserData']);
    Route::get('/get-user', [App\Http\Controllers\Api\UserController::class, 'getUserData']);

    Route::post('/create', [App\Http\Controllers\Api\UserController::class, 'saveUserData']);
    Route::post('/update-user', [App\Http\Controllers\Api\UserController::class, 'updateUserData']);
    Route::post('/update-user-status', [App\Http\Controllers\Api\UserController::class, 'activateAndDeactivateUserData']);
    Route::post('/delete-user',  [App\Http\Controllers\Api\UserController::class, 'deleteUserData']);
});

});

});
