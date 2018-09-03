<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/shape', 'namespace' => 'Modules\BEShape\Http\Controllers'], function()
{
    Route::get('/', 'BEShapeController@index')->name('backend.shape.index');
    Route::get('/getdata', 'BEShapeController@getData')->name('backend.shape.getdata');
    Route::get('/{id}', 'BEShapeController@detail')->name('backend.shape.detail');
    Route::post('/store', 'BEShapeController@store')->name('backend.shape.store');
    Route::post('/update/{id}', 'BEShapeController@update')->name('backend.shape.update');
    Route::delete('/delete/{id}', 'BEShapeController@delete')->name('backend.shape.delete');
});
