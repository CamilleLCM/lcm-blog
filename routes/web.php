<?php

    Route::prefix('/posts')->group(function () {
        //文章列表页
        Route::get('/', '\App\Http\Controllers\PostController@index');
        //创建文章
        Route::get('/create', '\App\Http\Controllers\PostController@create');
        Route::post('/', '\App\Http\Controllers\PostController@store');
        //文章详情页
        Route::get('/{post}', '\App\Http\Controllers\PostController@show');
        //编辑文章
        Route::get('/{post}/edit', '\App\Http\Controllers\PostController@edit');
        Route::put('/{post}', '\App\Http\Controllers\PostController@update');
        //删除文章
        Route::get('/{post}/delete', '\App\Http\Controllers\PostController@delete');
        //图片上传
        Route::post('/image/upload', '\App\Http\Controllers\PostController@imageUpload');
    });


