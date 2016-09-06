<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return Response::redirectTo('join');
});


//简单的路由例子
Route::get('test',function() {
    $param = array();
    $param['content'] = '欢迎来到测试界面~';
    return view('child',$param);
});

//路由传参例子
Route::get('posts/{post1}/{post2}',function($post1,$post2) {
   return 'posts:'.$post1. ' '.$post2;
});



Route::group([
    'middleware' => ['base'],
],function() {
    Route::match(['get','post'],'/{controller}/{action}', function($controller,$action) {
        return App::make('App\Http\Controllers\Test\\'.$controller.'Controller')->$action();
    });
});

Route::group([
    'middleware' => ['base'],
],function() {
    Route::match(['get','post'],'/{controller}/{action}', function($controller,$action) {
        return App::make('App\Http\Controllers\Join\\'.$controller.'Controller')->$action();
    });
});

Route::group([
    'middleware' => ['base'],
],function() {
    Route::match(['get'],'/{controller}', function($controller) {
        return App::make('App\Http\Controllers\\'.ucwords($controller).'\\'.$controller.'Controller')->index();
    });
});


