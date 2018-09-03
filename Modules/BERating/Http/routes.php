<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/rating', 'namespace' => 'Modules\BERating\Http\Controllers'], function()
{
    Route::get('posts', 'BERatingController@posts')->name('posts');
	Route::post('posts', 'BERatingController@postPost')->name('posts.post');
	Route::get('posts/{id}', 'BERatingController@show')->name('posts.show');
});
