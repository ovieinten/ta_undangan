<?php

Route::group(['middleware' => 'web', 'prefix' => 'b/login', 'namespace' => 'Modules\BELogin\Http\Controllers'], function()
{
    Route::get('/', 'BELoginController@index')->name('login');
    Route::get('logout', 'BELoginController@logout')->name('logout');
    Route::post('/', 'BELoginController@login');
});
