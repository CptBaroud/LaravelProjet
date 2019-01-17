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

Route::get('/register', 'RegistrationController@index');
Route::post('/register', 'RegistrationController@processing');

Route::get('/connection', 'ConnectionController@index');
Route::post('/connection', 'ConnectionController@processing');

Route::get('/', 'IndexController@index');

Route::get('/idea_box', 'IdeaBoxController@index');

Route::get('/activities', 'ActivitiesController@index');

Route::get('/shop', 'ShopController@index');
