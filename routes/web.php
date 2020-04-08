<?php

Route::get('/', 'EntranceController@index');
Route::post('/check_prefix', 'EntranceController@check_prefix');
Route::post('/check_password', 'EntranceController@check_password');

Route::get('/editor', 'EditorController@index');
Route::post('/editor', 'EditorController@update');