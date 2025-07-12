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

// Simple test route
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Laravel Web Routes are working on Vercel!',
        'timestamp' => now()->toDateTimeString()
    ]);
});

Route::group(['middleware' => 'tenancy.enforce'], function () {
    Auth::routes();
});

Route::get('/home', 'HomeController@index')->name('home');
