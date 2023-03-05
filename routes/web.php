<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Search for any path that match the content should redirect them somewhere
// Route::any('{slug}', 'HomeController@index')->where( 'slug', '([-a-z0-9_\s]+)' );
//Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d-/_.]+)?' );

Route::get('/{any}', 'HomeController@index')->where('any', '.*');