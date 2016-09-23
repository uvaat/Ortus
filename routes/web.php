<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin::'], function () {

	/**
	 * Dashbord
	 */
	Route::get('/',  'HomeController@index')->name('dashbord');

	/**
	 * Squares
	 */
	Route::resource('square', 'SquareController');

});

Auth::routes();
