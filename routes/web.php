<?php

Route::get('/', 'EntranceController@index');
Route::post('/check_password', 'EntranceController@check_password');
Route::post('/new_prefix', 'EntranceController@new_prefix');
Route::get('/credentials', 'EntranceController@show_credentials');

Route::get('/editor', 'EditorController@index');
Route::post('/editor', 'EditorController@update');