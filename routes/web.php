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


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');


Route::get('/', function () {
    return view('home');
});


Route::get('/profile', 'SettingController@editProfile')->name('profile');
Route::put('/profile/action', 'SettingController@updateProfile')->name('profile.action');


Route::get('detail/device/{id}', 'HomeController@detail')->name('detail');


// Route::get('/{tracks}', function () {
//     return response()->view('maps');
// })->where('tracks', '(.*)');





