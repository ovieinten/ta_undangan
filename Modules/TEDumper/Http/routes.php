<?php

Route::group(['middleware' => 'web', 'prefix' => 't/dumper', 'namespace' => 'Modules\TEDumper\Http\Controllers'], function()
{
    Route::get('/index', 'TEDumperController@index');
    Route::get('/test1', 'TEDumperController@test1');
});
