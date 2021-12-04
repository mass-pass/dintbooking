<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup', 'API\UserController@create');
Route::post('authenticate', 'API\LoginController@authenticate');
Route::match(['GET', 'POST'], '/check-availability', 'API\BookingsController@checkAvailability');
Route::match(['GET', 'POST'], '/boats/create', 'API\BoatsController@create');
Route::match(['GET', 'POST'], '/boats/{id}/update', 'API\BoatsController@update');

Route::match(['GET', 'POST'], '/bookings/create', 'API\BookingsController@create');
Route::match(['GET', 'POST'], '/pricing_intervals/create', 'API\RatesAvailabiityController@create');
Route::match(['GET', 'POST'], '/pricing_intervals', 'API\RatesAvailabiityController@getIntervals');
Route::match(['GET', 'POST'], '/pricing_intervals/{id}/update', 'API\RatesAvailabiityController@update');
Route::match(['GET', 'POST'], '/pricing_intervals/{id}/delete', 'API\RatesAvailabiityController@delete');
Route::match(['GET', 'POST'], '/pricing/get', 'API\RatesAvailabiityController@getPricing');

Route::match(['GET', 'POST'], '/blocked_dates/create', 'API\BookingsController@addBlockedDates');
Route::match(['GET', 'POST'], '/blocked_dates', 'API\BookingsController@getBlockedDates');
Route::match(['GET', 'POST'], '/blocked_dates/{id}/delete', 'API\BookingsController@deleteBlockedDates');

Route::match(['GET', 'POST'], '/discounts/create', 'API\BookingsController@addDiscount');
Route::match(['GET', 'POST'], '/discounts', 'API\BookingsController@getDiscounts');
Route::match(['GET', 'POST'], '/discounts/{id}/delete', 'API\BookingsController@deleteDiscounts');


Route::match(['GET', 'POST'], '/images/save', 'API\ImagesController@save');
Route::match(['GET', 'POST'], '/images/get/{type}/{id}', 'API\ImagesController@get');
Route::post('images/delete/{id}', 'API\ImagesController@delete');

Route::group(['middleware' => 'auth:api'], function(){
Route::post('changephoto', 'API\UserController@photoUpload');
});