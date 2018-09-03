<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'b/comment', 'namespace' => 'Modules\BEComment\Http\Controllers'], function()
{
    Route::get('/', 'BECommentController@index')->name('backend.comment.index');
    Route::get('/getdata', 'BECommentController@getData')->name('backend.comment.getdata');
    Route::get('/create', 'BECommentController@form')->name('backend.comment.form');
    Route::post('/store', 'BECommentController@store')->name('backend.comment.store');
    Route::get('/edit/{id}', 'BECommentController@edit')->name('backend.comment.edit');
    Route::post('/update/{id}', 'BECommentController@update')->name('backend.comment.update');
    Route::delete('/delete/{id}', 'BECommentController@delete')->name('backend.comment.delete');
});
