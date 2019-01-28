<?php

Route::get('/', array('as' => 'index', 'uses' => 'IndexController@index'));

Route::get('/admin', 'AdminController@index');
Route::get('/admin/get_datatable', array('as' => 'admin_getdatable', 'uses' => 'AdminController@get_Datatable'));
Route::get('/admin/removedata', array('as' => 'admin_remove', 'uses' => 'AdminController@removedata'));
Route::get('/admin/fetchdata', array('as' => 'admin_fetchdata', 'uses' => 'AdminController@fetchdata'));
Route::post('/admin/postdata', array('as' => 'admin_postdata', 'uses' => 'AdminController@postdata'));


Route::post('/idea_box/create', array('as' => 'idea_box_create', 'uses' => 'IdeaBoxController@Create'));
Route::get('/idea_box/create', array('as' => 'idea_box_Form', 'uses' => 'IdeaBoxController@Form'));
Route::get('/idea_box/delete/{id}', array('as' => 'idea_box_delete', 'uses' => 'IdeaBoxController@Delete'));
Route::get('/idea_box', array('as' => 'idea_box', 'uses' => 'IdeaBoxController@index'));

Route::get('/idea_box/edit/{id}', array('as' => 'idea_box_Edit', 'uses' => 'IdeaBoxController@Edit'));
Route::post('/idea_box/update/{id}', array('as' => 'idea_box_update', 'uses' => 'IdeaBoxController@Update'));
Route::get('/idea_box/report/{id}', array('as' => 'idea_box_report', 'uses' => 'IdeaBoxController@Report'));

Route::get('/idea_box/save/{id}', array('as' => 'idea_box_Save', 'uses' => 'IdeaBoxController@Save'));
Route::post('/idea_box/savetodb/{id}', array('as' => 'idea_box_Savetodb', 'uses' => 'IdeaBoxController@Savetodb'));

Route::get('/idea_box/like/{id}', array('as' => 'idea_box_update', 'uses' => 'IdeaBoxController@Like'));
Route::get('/idea_box/unlike/{id}', array('as' => 'idea_box_unlike', 'uses' => 'IdeaBoxController@UnLike'));

Route::get('/activities/download_users/{id}', array('as'=>'activitiesDownloadUsers', 'uses'=>'ActivitiesController@DownloadUsers'));
Route::get('/idea_box/download_users/{id}', array('as' => 'idea_box_Download_Users', 'uses' => 'IdeaBoxController@DownloadUsers'));


Route::post('/activities/store', array('as'=>'activitiesStore', 'uses'=>'ActivitiesController@store'));
Route::get('/activities/create', ['as'=>'activitiesCreate', 'uses'=>'ActivitiesController@create']);
Route::get('/activities', ['as'=>'activitiesIndex', 'uses'=>'ActivitiesController@index']);
Route::get('/activities/delete/{id}', array('as' => 'Activity_Delete', 'uses' => 'ActivitiesController@Delete'));
Route::get('/activities/{id}', ['as'=>'showActivity', 'uses'=>'ActivitiesController@showActivity']);
Route::post('/activities/{id}', ['as'=>'activitiesImage', 'uses'=>'ActivitiesController@AddPicture']);
Route::get('/activities/like/{id}', ['as'=>'LikeActivity', 'uses'=>'ActivitiesController@Like']);
Route::get('/activities/unlike/{id}', ['as'=>'UnLikeActivity', 'uses'=>'ActivitiesController@UnLike']);
Route::get('/activities/{id}/images/{id_image}', ['as'=>'activitiesComment', 'uses'=>'ActivitiesController@showComments']);
Route::get('/activities/comment/delete/{id_comment}', ['as'=>'activitiesComment', 'uses'=>'ActivitiesController@DeleteComment']);
Route::get('/activities/comment/like/{id_comment}', ['as'=>'activitiesComment', 'uses'=>'ActivitiesController@LikeComment']);
Route::get('/activities/comment/unlike/{id_comment}', ['as'=>'activitiesComment', 'uses'=>'ActivitiesController@UnLikeComment']);
Route::get('/activities/{id}/images/showComment/report/{id_comment}', ['as'=>'activitiesReport', 'uses'=>'ActivitiesController@Report']);
Route::post('/activities/comment/images/{id_image}', ['as'=>'activitiesCommentSend', 'uses'=>'ActivitiesController@SendComment']);
Route::get('/activities/image/delete/{id_image}', ['as'=>'activitiesDeleteImage', 'uses'=>'ActivitiesController@DeleteImageActivity']);


Route::get('/markAsRead',function(){
	Auth()->user()->unreadNotifications->markAsRead();
});

Route::get('/shop/mail/{id}',array('as' => 'ShopMail', 'uses' => 'mailcontroller@send'));

Route::get('/activities/edit/{id}', array('as' => 'Activity_Edit', 'uses' => 'ActivitiesController@Edit'));
Route::post('/activities/update/{id}', array('as' => 'Activity_Update', 'uses' => 'ActivitiesController@Update'));

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

Route::get('/dlpicture', array('as' => 'dlpicture', 'uses' => 'dlpicture@Download'));

Route::get('/legalmention', array('as' => 'legalmention', 'uses' => 'legalmention@index'));
Route::get('/purchasemention', array('as' => 'vendormention', 'uses' => 'legalmention@mention'));

Route::get('/basket', array('as' => 'Basket', 'uses' => 'BasketController@Index'));
Route::get('/basket/delete', array('as' => 'Basket', 'uses' => 'BasketController@Delete'));
Route::get('/basket/add/{id}', array('as' => 'Basket', 'uses' => 'BasketController@Add'));
Route::get('/basket/change/{id}/value/{value}', array('as' => 'Basket_Change', 'uses' => 'BasketController@Change'));

Route::get('/register', 'RegistrationController@index');
Route::post('/register', 'RegistrationController@processing');

Route::get('/log_out', 'ConnectionController@log_out');

Route::get('/connection', 'ConnectionController@index');
Route::post('/connection', 'ConnectionController@processing');
