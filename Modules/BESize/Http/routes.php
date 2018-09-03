<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/size', 'namespace' => 'Modules\BESize\Http\Controllers'], function()
{
    Route::get('/', 'BESizeController@index')->name('backend.size.index');
    Route::get('/getdata', 'BESizeController@getData')->name('backend.size.getdata');
    Route::get('/{id}', 'BESizeController@detail')->name('backend.size.detail');
    Route::post('/store', 'BESizeController@store')->name('backend.size.store');
    Route::post('/update/{id}', 'BESizeController@update')->name('backend.size.update');
    Route::delete('/delete/{id}', 'BESizeController@delete')->name('backend.size.delete');
});
