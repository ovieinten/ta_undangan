<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/payment', 'namespace' => 'Modules\BEPayment\Http\Controllers'], function()
{
    Route::get('/', 'BEPaymentController@index')->name('backend.payment.index');
    Route::get('/getdata', 'BEPaymentController@getData')->name('backend.payment.getdata');
    Route::get('/create', 'BEPaymentController@form')->name('backend.payment.form');
    Route::post('/store', 'BEPaymentController@store')->name('backend.payment.store');
    Route::get('/edit/{id}', 'BEPaymentController@edit')->name('backend.payment.edit');
    Route::post('/update/{id}', 'BEPaymentController@update')->name('backend.payment.update');
    Route::delete('/delete/{id}', 'BEPaymentController@delete')->name('backend.payment.delete');
});
