<?php

Route::group(['middleware' => 'web', 'prefix' => 'pages', 'namespace' => 'Modules\FEPage\Http\Controllers'], function()
{
    Route::get('/{pageName}', 'FEPageController@show');
});
