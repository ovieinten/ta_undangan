<?php

Route::group(['middleware' => 'web', 'prefix' => 'gallery', 'namespace' => 'Modules\FEGallery\Http\Controllers'], function()
{
    Route::get('/', 'FEGalleryController@index')->name('frontend.gallery.index');
    Route::get('/{slug}', 'FEGalleryController@detail');
});
