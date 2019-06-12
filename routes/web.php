<?php
//用户相关接口
    Route::prefix('/user')->group(function (){
        //用户注册页面
        Route::get('/register','\App\Http\Controllers\RegisterController@index');
        //用户注册逻辑
        Route::post('/register','\App\Http\Controllers\RegisterController@register');
        //用户登录界面
        Route::get('/login','\App\Http\Controllers\LoginController@index');
        //用户登录逻辑
        Route::post('/login','\App\Http\Controllers\LoginController@login');
        //用户登出逻辑
        Route::get('/logout','\App\Http\Controllers\LoginController@logout');
        //个人设置页面
        Route::get('/myself/setting','\App\Http\Controllers\UserController@setting');
        //个人设置逻辑
        Route::post('/myself/setting','\App\Http\Controllers\UserController@settingStore');
    });

//文章相关接口
    Route::prefix('/posts')->group(function () {
        //文章列表页
        Route::get('/', '\App\Http\Controllers\PostController@index');
        //创建文章
        Route::get('/create', '\App\Http\Controllers\PostController@create');
        Route::post('/', '\App\Http\Controllers\PostController@store');
        //文章详情页
        Route::get('/{post}', '\App\Http\Controllers\PostController@show');
        //文章赞
        Route::get('/{post}/zan', '\App\Http\Controllers\PostController@zan');
        //取消文章赞
        Route::get('/{post}/unZan', '\App\Http\Controllers\PostController@unZan');
        //编辑文章
        Route::get('/{post}/edit', '\App\Http\Controllers\PostController@edit');
        Route::put('/{post}', '\App\Http\Controllers\PostController@update');
        //删除文章
        Route::get('/{post}/delete', '\App\Http\Controllers\PostController@delete');
        //图片上传
        Route::post('/image/upload', '\App\Http\Controllers\PostController@imageUpload');
        //文章评论
        Route::post('/{post}/comment','\App\Http\Controllers\PostController@comment');
    });


