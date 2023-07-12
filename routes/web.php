<?php
use Illuminate\Support\Facades\Auth;
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


// Route::get('/',function(){
//      if (Auth::check()) {
//       return redirect('/login'); }else{ return view('auth/login');
//       }  });

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/user-register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('user.register');

Route::post('register', 'Auth\RegisterController@register')->name('register');


//Search for any path that match the content should redirect them somewhere
// Route::any('{slug}', 'HomeController@index')->where( 'slug', '([-a-z0-9_\s]+)' );
//Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d-/_.]+)?' );

Route::get('/{any}', 'HomeController@index')->where('any', '.*');






Route::group(['middleware' => 'auth'], function () {

    // Route::get('/download-song-template', [App\Http\Controllers\Api\HomeController::class, 'downloadSongTemplate'])->name('download-song-template');

    // Route::get('/receipt-files/download', 'HomeController@downloadFile')->name('receipt.download');

    // Route::get('/download-song-template', 'HomeController@downloadSongTemplate')->name('download-song-template');


});
