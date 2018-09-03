<?php

Route::group(['middleware' => 'web', 'prefix' => 'checkout', 'namespace' => 'Modules\FECheckout\Http\Controllers'], function()
{
    Route::get('/', 'FECheckoutController@index')->name('checkout');
    Route::post('/store', 'FECheckoutController@store')->name('frontend.order.store');
    Route::post('/payment', 'FECheckoutController@show')->name('frontend.payment');
    Route::get('/getdataproduk/{id}', 'FECheckoutController@getDataProduk')->name('backend.order.getdataproduk');
});
