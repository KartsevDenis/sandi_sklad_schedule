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

/*PAGES*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('schedule', function () {
    return view('schedule');
});

Route::get('weekcalendar', function () {
    return view('weekcalendar');
});

/*FUNCTIONS*/

Route::get('event', 'EventController@event')->name('event');

Route::get('events', 'EventController@events')->name('events');

Route::post('events-ajax', 'EventController@events_ajax')->name('events_ajax');

Route::post('event-change', 'EventController@event_change')->name('event_change');

Route::post('event-delete', 'EventController@event_delete')->name('event_delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
