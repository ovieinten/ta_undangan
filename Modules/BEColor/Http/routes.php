<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/color', 'namespace' => 'Modules\BEColor\Http\Controllers'], function()
{
    Route::get('/', 'BEColorController@index')->name('backend.color.index');
    Route::get('/select', 'BEColorController@select')->name('backend.color.select');
    Route::get('/getdata', 'BEColorController@getData')->name('backend.color.getdata');
    Route::get('/{id}', 'BEColorController@detail')->name('backend.color.detail');
    Route::post('/store', 'BEColorController@store')->name('backend.color.store');
    Route::post('/update/{id}', 'BEColorController@update')->name('backend.color.update');
    Route::delete('/delete/{id}', 'BEColorController@delete')->name('backend.color.delete');
});
