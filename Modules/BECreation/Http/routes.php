<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/creation', 'namespace' => 'Modules\BECreation\Http\Controllers'], function()
{
    Route::get('/all', 'BECreationController@index')->name('backend.creation.index');
    Route::get('/form', 'BECreationController@form')->name('backend.creation.form');
    Route::get('/select', 'BECreationController@select')->name('backend.creation.select');
    Route::get('/form-acc/{slug}', 'BECreationController@formAcc')->name('backend.creation.formAcc');
    Route::get('/getdata', 'BECreationController@getData')->name('backend.creation.getdata');
    Route::get('/getdataSent', 'BECreationController@getDataSent')->name('backend.creation.getdataSent');
    Route::get('/getdataAccepted', 'BECreationController@getDataAccepted')->name('backend.creation.getdataAccepted');
    Route::post('/store', 'BECreationController@store')->name('backend.creation.store');
    Route::post('/store-acc/{slug}', 'BECreationController@storeAcc')->name('backend.creation.storeAcc');
    Route::get('/sent', 'BECreationController@sent')->name('backend.creation.sent');
    Route::get('/accepted', 'BECreationController@accepted')->name('backend.creation.accepted');
    Route::get('/getslug/{id}', 'BECreationController@getSlug')->name('backend.creation.getslug');
    Route::post('/update/{slug}', 'BECreationController@update')->name('backend.creation.update');
    Route::post('/accept/{id}', 'BECreationController@accept')->name('backend.creation.accept');
    Route::delete('/delete/{id}', 'BECreationController@delete')->name('backend.creation.delete');
    Route::get('/edit/{slug}', 'BECreationController@edit')->name('backend.creation.edit');
    Route::get('/view-creation/{slug}', 'BECreationController@viewCreation')->name('backend.creation.view');
    Route::get('/confirm/{slug}', 'BECreationController@confirm')->name('backend.creation.confirm');
    Route::post('/sending/{id}', 'BECreationController@sending')->name('backend.creation.sending');
});
