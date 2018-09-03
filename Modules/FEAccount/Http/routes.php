<?php

Route::group(['middleware' => 'web', 'prefix' => 'account', 'namespace' => 'Modules\FEAccount\Http\Controllers'], function()
{
    Route::get('/', 'FEAccountController@index')->name('account');
});
