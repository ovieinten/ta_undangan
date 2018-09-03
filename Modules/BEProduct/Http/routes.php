<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/product', 'namespace' => 'Modules\BEProduct\Http\Controllers'], function()
{
    Route::get('/all', 'BEProductController@index')->name('backend.product.index');
    Route::get('/form', 'BEProductController@form')->name('backend.product.form');
    Route::get('/getdata', 'BEProductController@getData')->name('backend.product.getdata');
    Route::get('/getdataPublished', 'BEProductController@getDataPublished')->name('backend.product.getdataPublished');
    Route::get('/getdataDrafted', 'BEProductController@getDataDrafted')->name('backend.product.getdataDrafted');
    Route::get('/getdataTrashed', 'BEProductController@getDataTrashed')->name('backend.product.getdataTrashed');
    Route::post('/store', 'BEProductController@store')->name('backend.product.store');
    Route::get('/published', 'BEProductController@published')->name('backend.product.published');
    Route::get('/drafted', 'BEProductController@drafted')->name('backend.product.drafted');
    Route::get('/trashed', 'BEProductController@trashed')->name('backend.product.trashed');
    Route::get('/getslug/{id}', 'BEProductController@getSlug')->name('backend.product.getslug');
    Route::post('/update/{slug}', 'BEProductController@update')->name('backend.product.update');
    Route::post('/restore/{id}', 'BEProductController@restore')->name('backend.product.restore');
    Route::post('/draft/{id}', 'BEProductController@draft')->name('backend.product.draft');
    Route::delete('/trash/{id}', 'BEProductController@trash')->name('backend.product.trash');
    Route::delete('/delete/{id}', 'BEProductController@delete')->name('backend.product.delete');
    Route::get('/edit/{slug}', 'BEProductController@edit')->name('backend.product.edit');
    Route::get('/view-product/{slug}', 'BEProductController@viewProduct')->name('backend.product.view');
    Route::post('/publishing/{id}', 'BEProductController@publishing')->name('backend.product.publishing');
    Route::post('upload-image',['as'=>'image.upload','uses'=>'BEProductController@uploadImages']);
});
