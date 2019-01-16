<?php

Route::get('/', 'IndexController@index');
Route::get('/idea_box', 'IdeaBoxController@index');
Route::get('/activities', 'ActivitiesController@index');
Route::get('/shop', 'ShopController@index');
Route::get('/register', 'RegistrationController@index');
Route::get('/connection', 'ConnectionController@index');

