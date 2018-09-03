<?php

Route::group(['middleware' => 'web', 'prefix' => 'products', 'namespace' => 'Modules\FEProduct\Http\Controllers'], function()
{
    Route::get('/', 'FEProductController@index')->name('frontend.product.index');
    Route::get('/{slug}', 'FEProductController@show')->name('frontend.product.show');
    Route::post('/{slug}/review', 'FEProductController@reviewProduct')->name('frontend.product.review');
    Route::get('/{slug}/cart/{prod_id}', 'FEProductController@cart')->name('frontend.product.cart');
    Route::get('categories/{pageName}', 'FEProductController@categories');
});
