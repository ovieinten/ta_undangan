<?php

Route::group(['middleware' => 'web', 'prefix' => 'b/user', 'namespace' => 'Modules\BEUser\Http\Controllers'], function()
{
    Route::get('/', 'BEUserController@index')->name('backend.user.index');
    Route::get('/getdata', 'BEUserController@getData')->name('backend.user.getdata');
    Route::get('/create', 'BEUserController@form')->name('backend.user.form');
    Route::post('/store', 'BEUserController@store')->name('backend.user.store');
    Route::get('/edit/{id}', 'BEUserController@edit')->name('backend.user.edit');
    Route::get('/edit-user/{id}', 'BEUserController@editUser')->name('backend.user.edituserprofile');
    Route::post('/update/{id}', 'BEUserController@update')->name('backend.user.update');
    Route::delete('/delete/{id}', 'BEUserController@delete')->name('backend.user.delete');
});
