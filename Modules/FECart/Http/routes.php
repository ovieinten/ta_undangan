<?php

Route::group(['middleware' => 'web', 'prefix' => 'cart', 'namespace' => 'Modules\FECart\Http\Controllers'], function()
{
    Route::get('/', 'FECartController@index')->name('frontend.cart.index');
    Route::post('/store', 'FECartController@store')->name('frontend.cart.store');
    Route::post('/update/{id}', 'FECartController@update')->name('frontend.cart.update');
    Route::delete('/delete/{id}', 'FECartController@delete')->name('frontend.cart.delete');
});
