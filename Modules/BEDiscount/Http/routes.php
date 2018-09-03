<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/discount', 'namespace' => 'Modules\BEDiscount\Http\Controllers'], function()
{
    Route::get('/', 'BEDiscountController@index')->name('backend.discount.index');
    Route::get('/select', 'BEDiscountController@select')->name('backend.discount.select');
    Route::get('/getdata', 'BEDiscountController@getData')->name('backend.discount.getdata');
    Route::get('/{id}', 'BEDiscountController@detail')->name('backend.discount.detail');
    Route::post('/store', 'BEDiscountController@store')->name('backend.discount.store');
    Route::post('/update/{id}', 'BEDiscountController@update')->name('backend.discount.update');
    Route::delete('/delete/{id}', 'BEDiscountController@delete')->name('backend.discount.delete');
});
