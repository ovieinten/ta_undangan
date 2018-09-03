<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/category', 'namespace' => 'Modules\BECategory\Http\Controllers'], function()
{
    Route::get('/', 'BECategoryController@index')->name('backend.category.index');
    Route::get('/getdata', 'BECategoryController@getData')->name('backend.category.getdata');
    Route::get('/{id}', 'BECategoryController@detail')->name('backend.category.detail');
    Route::post('/store', 'BECategoryController@store')->name('backend.category.store');
    Route::post('/update/{id}', 'BECategoryController@update')->name('backend.category.update');
    Route::delete('/delete/{id}', 'BECategoryController@delete')->name('backend.category.delete');
    
});
