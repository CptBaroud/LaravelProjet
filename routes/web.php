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

Route::post('/idea_box/create', array('as' => 'idea_box_create', 'uses' => 'IdeaBoxController@Create'));
Route::get('/idea_box/create', array('as' => 'idea_box_Form', 'uses' => 'IdeaBoxController@Form'));

Route::get('/idea_box/delete/{id}', array('as' => 'idea_box_delete', 'uses' => 'IdeaBoxController@Delete'));

Route::get('/idea_box', array('as' => 'idea_box', 'uses' => 'IdeaBoxController@index'));

Route::post('/activities/store', array('as'=>'activitiesStore', 'uses'=>'PostsController@store'));
Route::get('/activities/create', ['as'=>'activitiesCreate', 'uses'=>'PostsController@create']);
Route::get('/activities', ['as'=>'activitiesIndex', 'uses'=>'ActivitiesController@index']);

Route::get('/shop', 'ShopController@index');
Route::post('/shop/create', array('as' => 'Items_create', 'uses' => 'ShopController@CreateItems'));

Route::get('/register', 'RegistrationController@index');
Route::post('/register', 'RegistrationController@processing');

Route::get('/log_out', 'ConnectionController@log_out');

Route::get('/connection', 'ConnectionController@index');
Route::post('/connection', 'ConnectionController@processing');
