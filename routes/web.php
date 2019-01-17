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

Route::get('/', array('as' => 'index', 'uses' => 'IndexController@index'));

Route::post('/idea_box', array('as' => 'idea_box_create', 'uses' => 'IdeaBoxController@Create'));
Route::get('/idea_box', array('as' => 'idea_box', 'uses' => 'IdeaBoxController@index'));

Route::get('/activities', 'ActivitiesController@index');

Route::get('/shop', 'ShopController@index');

Route::get('/register', 'RegistrationController@index');

Route::get('/connection', 'ConnectionController@index');


