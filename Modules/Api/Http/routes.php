<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    Route::get('/', 'ApiController@index');
    Route::get('/get/location', 'ApiController@getSelect2Location')->name('api.select2.get.location');
});
