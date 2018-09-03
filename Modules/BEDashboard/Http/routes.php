<?php

Route::group(
    [
        'middleware' => ['web', 'auth'],
        'prefix' => 'b/dashboard',
        'namespace' => 'Modules\BEDashboard\Http\Controllers'
    ],
    function()
    {
        Route::get('/', 'BEDashboardController@index')->name('backend.dashboard.index');
    }
);
