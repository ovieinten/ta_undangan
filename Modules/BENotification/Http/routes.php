<?php

Route::group(['middleware' => 'web', 'prefix' => 'benotification', 'namespace' => 'Modules\BENotification\Http\Controllers'], function()
{
    Route::get('/', 'BENotificationController@index');
});
