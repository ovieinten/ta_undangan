<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/order', 'namespace' => 'Modules\BEOrder\Http\Controllers'], function()
{
    Route::get('/all', 'BEOrderController@index')->name('backend.order.index');
    Route::get('/form', 'BEOrderController@form')->name('backend.order.form');
    Route::get('/getdata', 'BEOrderController@getData')->name('backend.order.getdata');
    Route::get('/getdataConfirmed', 'BEOrderController@getDataConfirmed')->name('backend.order.getdataConfirmed');
    Route::get('/getdataPayment', 'BEOrderController@getDataPayment')->name('backend.order.getdataPayment');
    Route::get('/getdataPackage', 'BEOrderController@getDataPackage')->name('backend.order.getdataPacked');
    Route::get('/getdataShippedOut', 'BEOrderController@getDataShippedOut')->name('backend.order.getdataShippedOut');
    Route::get('/getdataDelivered', 'BEOrderController@getdataDelivered')->name('backend.order.getdataDelivered');
    Route::get('/getdataTrashed', 'BEOrderController@getDataTrashed')->name('backend.order.getdataTrashed');
    Route::post('/store', 'BEOrderController@store')->name('backend.order.store');
    Route::get('/confirmed', 'BEOrderController@confirmed')->name('backend.order.confirmed');
    Route::get('/packed', 'BEOrderController@packed')->name('backend.order.packed');
    Route::get('/shippedOut', 'BEOrderController@shippedOut')->name('backend.order.shippedOut');
    Route::get('/delivered', 'BEOrderController@delivered')->name('backend.order.delivered');
    Route::get('/trashed', 'BEOrderController@trashed')->name('backend.order.trashed');
    Route::get('/getslug/{id}', 'BEOrderController@getSlug')->name('backend.order.getslug');
    Route::post('/update/{slug}', 'BEOrderController@update')->name('backend.order.update');
    Route::post('/confirm/{id}', 'BEOrderController@confirm')->name('backend.order.confirm');
    Route::post('/packaging/{id}', 'BEOrderController@packaging')->name('backend.order.package');
    Route::post('/shippingOut/{id}', 'BEOrderController@shippingOut')->name('backend.order.shippingdOut');
    Route::post('/deliver/{id}', 'BEOrderController@deliver')->name('backend.order.deliver');
    Route::delete('/trash/{id}', 'BEOrderController@trash')->name('backend.order.trash');
    Route::delete('/delete/{id}', 'BEOrderController@delete')->name('backend.order.delete');
    Route::get('/edit/{slug}', 'BEOrderController@edit')->name('backend.order.edit');
    Route::get('/edit/{slug}', 'BEOrderController@edit')->name('backend.order.edit');


    /*get data produk*/
    Route::get('/getdataproduk/{id}', 'BEOrderController@getDataProduk')->name('backend.order.getdataproduk');

});
