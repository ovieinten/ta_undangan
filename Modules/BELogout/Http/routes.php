<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/logout', 'namespace' => 'Modules\BELogout\Http\Controllers'], function()
{
    Route::post('/', 'BELogoutController@logout');
});
