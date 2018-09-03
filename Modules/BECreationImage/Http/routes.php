<?php

Route::group(['middleware' => 'web', 'prefix' => 'becreationimage', 'namespace' => 'Modules\BECreationImage\Http\Controllers'], function()
{
    Route::get('/', 'BECreationImageController@index');
});
