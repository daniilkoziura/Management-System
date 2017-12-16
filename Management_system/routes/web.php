<?php

/**
 * start page
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * for registration
 */
Auth::routes();

/**
 * for management system
 */
Route::group(['prefix' => 'manager', 'middleware' => ['role:Manager']], function() {

    Route::get('/home', 'ManagerController@show');

    Route::post('/search', 'ManagerController@search');

    Route::post('/meeting/{user}', 'MeetingController@create');

    Route::post('/meeting/{user}/choice', 'MeetingController@choiceStatus' );

});
/**
 * for meeting
 */
Route::get('/meeting/{user}', 'MeetingController@showMeetings');

Route::get('/meeting/{user}/{meeting}', 'MeetingController@media');

Route::post('/meeting/{user}/{meeting}', 'CommentController@create');

/**
 * default page
 */
Route::get('/home', 'HomeController@index')->name('home');