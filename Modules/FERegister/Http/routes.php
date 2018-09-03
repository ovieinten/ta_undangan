<?php

Route::group(['middleware' => 'web', 'prefix' => 'register', 'namespace' => 'Modules\FERegister\Http\Controllers'], function()
{
    Route::get('/customer', 'FERegisterController@index')->name('frontend.register.index');
    Route::get('/designer', 'FERegisterController@indexDesigner')->name('frontend.register.indexdesigner');
    Route::get('/getdata', 'FERegisterController@getData')->name('frontend.register.getdata');
    Route::get('/create', 'FERegisterController@form')->name('frontend.register.form');
    Route::post('/store', 'FERegisterController@store')->name('frontend.register.store');
});
