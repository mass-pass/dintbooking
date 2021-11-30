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

Route::prefix('boats')->name('boats::')->group(function () {

    $guestDomain = config('services.domain.guest');
    $partnerDomain = config('services.domain.partner');

    Route::group(['domain' => $guestDomain, 'middleware' => ['guest:users']], function () {
        Route::get('/', 'BoatsController@index')->name('index');
    });

    Route::group(['domain' => $partnerDomain, 'middleware' => ['guest:partner']], function () {
        Route::get('/', 'BoatsController@myBoats')->name('my_boats');
        Route::get('dashboard', 'BoatsController@dashboard')->name('dashboard');
        //Route::post('signup', 'BoatsController@postSignup')->name('postSignup');
        //Route::get('signup/{sid?}', 'BoatsController@signup')->name('signup');
    });
});
