<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'calendar', 'middleware' => ['guest:partner']], function(){
    Route::post('get-calendar-data', ['uses' => 'CalendarController@getCalendarData']);
    Route::post('get-calendar-reservation-data', ['uses' => 'CalendarController@getCalendarReservationData']);
});