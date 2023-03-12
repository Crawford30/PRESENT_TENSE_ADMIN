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

    Route::get('/download-song-template',  [App\Http\Controllers\Api\UserController::class, 'download']);
});



});



Route::group(['middleware' => ['auth:api']], function () {

    //============God Ten Major Songs ======
    Route::group(['prefix' => 'ten-major'], function () {
    Route::get('/list', 'GodTenMajorSongsController@getAllGodMajorSongs');
    Route::post('/import-ten-major-songs', 'GodTenMajorSongsController@importGodTenMajorTemplate');
    Route::post('/create-ten-major-song', 'GodTenMajorSongsController@saveTenMajorSong');
    Route::post('/delete-ten-major-song', 'GodTenMajorSongsController@deleteTenMajorSong');
  });


   //============Praises and Worship Songs ======
   Route::group(['prefix' => 'praises-and-worship'], function () {
    Route::get('/list', 'PraisesAndWorshipSongsController@getAllPraisesAndWhorshipSongs');
    Route::post('/import-praises-and-worship-songs', 'PraisesAndWorshipSongsController@importPraisesAndWorshipTemplate');
    Route::post('/create-praises-and-worship-song', 'PraisesAndWorshipSongsController@savePraisesAndWorshipSong');
    Route::post('/delete-praises-and-worship-song', 'PraisesAndWorshipSongsController@deletePraisesAndWorshipSong');
  });


  //============Present Tense Songs ======
  Route::group(['prefix' => 'present-tense'], function () {
    Route::get('/list', 'PresentTenseSongsController@getAllPresentTenseSongs');
    Route::post('/import-present-tense-songs', 'PresentTenseSongsController@importPresentTenseTemplate');
    Route::post('/create-present-tense-song', 'PresentTenseSongsController@savePresentTenseSong');
    Route::post('/delete-present-tense-song', 'PresentTenseSongsController@deletePresentTenseSong');
  });


   //============The Big SongBook Songs ======
   Route::group(['prefix' => 'big-song-book'], function () {
    Route::get('/list', 'BigSongBookSongsController@getAllBigSongBookSongs');
    Route::post('/import-big-song-book-songs', 'BigSongBookSongsController@importBigSongBookTemplate');
    Route::post('/create-big-song-book-song', 'BigSongBookSongsController@saveBigSongBookSong');
    Route::post('/delete-big-song-book-song', 'BigSongBookSongsController@deleteBigSongBookSong');
  });





  });



});
