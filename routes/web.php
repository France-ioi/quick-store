<?php

Route::get('/', 'EntranceController@index');
Route::post('/check_password', 'EntranceController@check_password');
Route::post('/new_prefix', 'EntranceController@new_prefix');
Route::get('/credentials', 'CredentialsController@show');
Route::post('/credentials', 'CredentialsController@confirm');
Route::post('/locale', 'LocaleController@set');
Route::get('/editor', 'EditorController@index');
Route::post('/editor', 'EditorController@update');