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

Route::get('/', 'IndexController@index');
Route::get('/idea_box', 'IdeaBoxController@index');
Route::get('/activities/store', ['as'=>'store', 'uses'=>'ActivitiesController@store']);
Route::get('/activities/create', ['as'=>'create', 'uses'=>'PostsController@create']);
Route::get('/activities', ['as'=>'index', 'uses'=>'ActivitiesController@index']);
Route::get('/shop', 'ShopController@index');
Route::get('/register', 'RegistrationController@index');
Route::get('/connection', 'ConnectionController@index');


