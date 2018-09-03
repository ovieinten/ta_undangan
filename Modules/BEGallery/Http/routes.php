<?php

Route::group(['middleware' => 'web', 'prefix' => 'b/gallery', 'namespace' => 'Modules\BEGallery\Http\Controllers'], function()
{
    Route::get('/', 'BEGalleryController@index')->name('backend.gallery.index');
});
