<?php

Route::get('/', 'EntranceController@index');
Route::post('/check_prefix', 'EntranceController@check_prefix');
Route::post('/check_password', 'EntranceController@check_password');

Route::get('/editor', 'EditorController@index');
Route::post('/editor/create', 'EditorController@create');
Route::post('/editor/delete', 'EditorController@delete');
Route::post('/editor/save', 'EditorController@save');