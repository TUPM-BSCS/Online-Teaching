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

Route::resource('main-admin', 'MainAdminController');
Route::resource('institution', 'InstitutionController');

Route::post('user/change/{user_param}', 'UserController@change');
Route::post('main_admin/accept', 'MainAdminController@accept_inst');
Route::post('main_admin/decline', 'MainAdminController@decline_inst');

Route::post('institution/accept', 'InstitutionController@accept_prof');
Route::post('institution/decline', 'InstitutionController@decline_prof');

// Authentication routes...
Route::get('login/{id}', 'Auth\AuthController@getLogin');
Route::post('login/{id}', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register/{id}', 'Auth\AuthController@getRegister');
Route::post('register/institution', 'Auth\AuthController@postInstRegister');
Route::post('register/professor', 'Auth\AuthController@postProfRegister');