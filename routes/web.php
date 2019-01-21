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

Route::get('/admin', 'AdminController@index');
Route::get('/admin/delete/{id}', array('as' => 'admin_delete', 'uses' => 'AdminController@Delete'));
Route::post('/admin/save/{id}', array('as' => 'admin_save', 'uses' => 'AdminController@Save'));

Route::post('/idea_box/create', array('as' => 'idea_box_create', 'uses' => 'IdeaBoxController@Create'));
Route::get('/idea_box/create', array('as' => 'idea_box_Form', 'uses' => 'IdeaBoxController@Form'));
Route::get('/idea_box/delete/{id}', array('as' => 'idea_box_delete', 'uses' => 'IdeaBoxController@Delete'));
Route::get('/idea_box', array('as' => 'idea_box', 'uses' => 'IdeaBoxController@index'));

Route::get('/idea_box/edit/{id}', array('as' => 'idea_box_Edit', 'uses' => 'IdeaBoxController@Edit'));
Route::post('/idea_box/update/{id}', array('as' => 'idea_box_update', 'uses' => 'IdeaBoxController@Update'));

Route::get('/idea_box/save/{id}', array('as' => 'idea_box_Save', 'uses' => 'IdeaBoxController@Save'));
Route::post('/idea_box/savetodb', array('as' => 'idea_box_Savetodb', 'uses' => 'IdeaBoxController@Savetodb'));

Route::get('/idea_box/like/{id}', array('as' => 'idea_box_update', 'uses' => 'IdeaBoxController@Like'));


Route::post('/activities/store', array('as'=>'activitiesStore', 'uses'=>'PostsController@store'));
Route::get('/activities/create', ['as'=>'activitiesCreate', 'uses'=>'PostsController@create']);
Route::get('/activities', ['as'=>'activitiesIndex', 'uses'=>'ActivitiesController@index']);
Route::get('/activities/delete/{id}', array('as' => 'Activity_Delete', 'uses' => 'PostsController@Delete'));

Route::get('/shop',array('as' => 'shop', 'uses' => 'ShopController@index'));

Route::post('/shop/create', array('as' => 'Items_create', 'uses' => 'ShopController@CreateItems'));
Route::get('/shop/create', array('as' => 'Items_form', 'uses' => 'ShopController@Itemform'));

Route::get('/shop/delete/{id}', array('as' => 'Itemsdelete', 'uses' => 'ShopController@Delete'));

Route::get('/shop/edit/{id}', array('as' => 'shop_Edit', 'uses' => 'shopController@Edit'));
Route::post('/shop/update/{id}', array('as' => 'shop_update', 'uses' => 'shopController@Update'));
Route::get('/shop/achat/{id}', array('as' => 'shop_achat', 'uses' => 'shopController@Achat'));
Route::get('/shop/category/{id}', array('as' => 'shop_category', 'uses' => 'shopController@category'));


Route::get('/register', 'RegistrationController@index');
Route::post('/register', 'RegistrationController@processing');

Route::get('/log_out', 'ConnectionController@log_out');

Route::get('/connection', 'ConnectionController@index');
Route::post('/connection', 'ConnectionController@processing');
