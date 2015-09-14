<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){

	return 'home';
});

Route::resource('main_admin', 'MainAdminController');
Route::resource('institution', 'InstitutionController');

Route::post('main_admin/change/{field}', 'MainAdminController@change');
Route::post('main_admin/accept', 'MainAdminController@accept');
Route::post('main_admin/decline', 'MainAdminController@decline');

// Authentication routes...
Route::get('auth/login/{id}', 'Auth\AuthController@getLogin');
Route::post('auth/login/{id}', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register/{id}', 'Auth\AuthController@getRegister');
Route::post('auth/register/{role}', 'Auth\AuthController@postRegister');