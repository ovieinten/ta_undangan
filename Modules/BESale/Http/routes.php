<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/sale', 'namespace' => 'Modules\BESale\Http\Controllers'], function()
{
    Route::get('/', 'BESaleController@index')->name('backend.sale.index');
	Route::get('/create', 'BESaleController@form')->name('backend.sale.form');
    Route::get('/getdata', 'BESaleController@getData')->name('backend.sale.getdata');
    Route::get('/form-report', 'BESaleController@dataReport')->name('backend.sale.formReport');
    Route::get('/report', 'BESaleController@report')->name('backend.sale.report');
    Route::post('/store', 'BESaleController@store')->name('backend.sale.store');
    Route::get('/{id}', 'BESaleController@detail')->name('backend.sale.detail');
    Route::get('/edit/{id}', 'BESaleController@edit')->name('backend.sale.edit');
    Route::post('/update/{id}', 'BESaleController@update')->name('backend.sale.update');
    Route::delete('/delete/{id}', 'BESaleController@delete')->name('backend.sale.delete');
});
