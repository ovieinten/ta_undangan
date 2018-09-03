<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\FEHome\Http\Controllers'], function()
{
    Route::get('/', 'FEHomeController@index')->name('frontend.home.index');
});
