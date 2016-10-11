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

/**
 * Home
 */
Route::get('/',  'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin::'], function () {

	/**
	 * Dashbord
	 */
	Route::get('/',  'DashbordController@index')->name('dashbord');

	/**
	 * Squares
	 */
	Route::resource('square', 'SquareController');

	/**
	 * Villes
	 */
	Route::resource('city', 'CityController');

	/**
	 * Type d'équipement
	 */
	Route::resource('equipment-type', 'EquipmentTypeController');

	/**
	 * Équipement
	 */
	Route::resource('equipment', 'EquipmentController');

	/**
	 * Crawler
	 */
	Route::get('crawler/{id}', [
		'as'   => 'crawler', 
		'uses' => 'CityController@crawler'
	]);

});

Auth::routes();
