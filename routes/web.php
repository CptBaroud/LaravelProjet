<?php

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
Route::get('/activities/{id}', ['as'=>'showActivity', 'uses'=>'ActivitiesController@showActivity']);
Route::post('/activities/{id}', ['as'=>'activitiesImage', 'uses'=>'ActivitiesController@AddPicture']);
Route::get('/activities/{id}/images/{id_image}', ['as'=>'activitiesComment', 'uses'=>'ActivitiesController@showComments']);
Route::post('/activities/comment/images/{id_image}', ['as'=>'activitiesCommentSend', 'uses'=>'ActivitiesController@sendComment']);


Route::get('/markAsRead',function(){
	Auth()->user()->unreadNotifications->markAsRead();
});

Route::get('/shop/mail',array('as' => 'ShopMail', 'uses' => 'mailcontroller@send'));

Route::get('/activities/edit/{id}', array('as' => 'Activity_Edit', 'uses' => 'PostsController@Edit'));
Route::post('/activities/update/{id}', array('as' => 'Activity_Update', 'uses' => 'PostsController@Update'));

Route::get('/shop',array('as' => 'shop', 'uses' => 'ShopController@index'));

Route::post('/shop/create', array('as' => 'Items_create', 'uses' => 'ShopController@CreateItems'));
Route::get('/shop/create', array('as' => 'Items_form', 'uses' => 'ShopController@Itemform'));

Route::get('/shop/delete/{id}', array('as' => 'Itemsdelete', 'uses' => 'ShopController@Delete'));

Route::get('/shop/edit/{id}', array('as' => 'shop_Edit', 'uses' => 'shopController@Edit'));
Route::post('/shop/update/{id}', array('as' => 'shop_update', 'uses' => 'shopController@Update'));
Route::get('/shop/purchase/{id}', array('as' => 'shop_achat', 'uses' => 'shopController@Purchase'));
Route::get('/shop/category/{id}', array('as' => 'shop_category', 'uses' => 'shopController@Category'));
Route::get('/shop/PriceFilterDesc', array('as' => 'shop_Price_fitler_Desc', 'uses' => 'shopController@PriceFilterDesc'));
Route::get('/shop/PriceFilterAsc', array('as' => 'shop_Price_fitler_Asc', 'uses' => 'shopController@PriceFilterAsc'));

Route::get('/autocomplete', 'shopController@index');
Route::post('/autocomplete/fetch', 'shopController@fetch')->name('autocomplete.fetch');
Route::get('/shop/request/{product_name}', 'shopController@display');

Route::get('/basket', array('as' => 'Basket', 'uses' => 'BasketController@Index'));
Route::get('/basket/delete', array('as' => 'Basket', 'uses' => 'BasketController@Delete'));
Route::get('/basket/add/{id}', array('as' => 'Basket', 'uses' => 'BasketController@Add'));
Route::get('/basket/change/{id}/value/{value}', array('as' => 'Basket_Change', 'uses' => 'BasketController@Change'));

Route::get('/register', 'RegistrationController@index');
Route::post('/register', 'RegistrationController@processing');

Route::get('/log_out', 'ConnectionController@log_out');

Route::get('/connection', 'ConnectionController@index');
Route::post('/connection', 'ConnectionController@processing');
