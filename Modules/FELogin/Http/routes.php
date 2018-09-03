<?php

Route::group(['middleware' => 'web', 'prefix' => 'f/login', 'namespace' => 'Modules\FELogin\Http\Controllers'], function()
{
    Route::get('/', 'FELoginController@index')->name('frontend.login');
    Route::get('logout', 'FELoginController@logout')->name('frontend.logout');
    Route::post('/', 'FELoginController@login');
});
