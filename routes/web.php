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
Route::get('/getstarted', 'Auth\LoginController@start')->name('getstarted');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/turf', 'HomeController@turf')->name('home-turf');
Route::get('/home/turf/{id}/bookings', 'HomeController@turfbookings')->name('home-turf-bookings');
Route::post('/home/turf', 'HomeController@newTurf')->name('new-turf');

Route::get('/turfs', 'TurfController@index')->name('turfs');
Route::get('/turfs/{id}', 'TurfController@permalink')->name('permalink');
Route::get('/turfs/{id}/book', 'TurfController@book')->name('book');
Route::get('/turfs/{id}/payment', 'TurfController@payment')->name('payment');
//Route::get('/turfs/{id}/rate', 'TurfController@rate')->name('rate');

Route::get ( '/redirect/{service}', 'Auth\SocialAuthController@redirect' );
Route::get ( '/callback/{service}', 'Auth\SocialAuthController@callback' );


//API Routes

Route::get('/ajax/turfs', 'TurfController@getAllTurfs')->name('ajax-turfs');
Route::get('/ajax/turfs/{id}', 'TurfController@getTurfById')->name('ajax-turf-id');
Route::get('/ajax/turfs/{id}/delete', 'TurfController@deleteTurfById')->name('ajax-turf-id-delete');
Route::post('/ajax/turfs/{id}/rate', 'TurfController@rateTurfById')->name('ajax-turf-id-rate');
Route::get('/ajax/turfs/image/{id}', 'TurfController@getTurfImage')->name('ajax-turf-image-id');
Route::get('/ajax/user/image/{id}', 'UserController@getUserImage')->name('ajax-user-image-id');
Route::get('/ajax/user/{id}/verify', 'UserController@verify')->name('ajax-user-id-verify');

Route::post('ajax/turfs/{id}/validate', 'BookingController@validateBooking')->name('ajax-turf-validate-id');
Route::post('ajax/turfs/book', 'BookingController@bookTurfById')->name('ajax-turf-book');

