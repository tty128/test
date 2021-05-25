<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login')->name('api_login');
Route::post('register', 'API\UserController@register')->name('api_register');

Route::middleware('auth:api')->get('details', 'API\UserController@details');
//Route::get('/post', 'PostController@apiIndex')->name('posts');

Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get('/', 'PostController@apiIndex')->name('all');
    Route::get('/{post}', 'PostController@show')->name('show');
    Route::post('/create', 'PostController@store')->name('create');

    Route::post('/update/{id}', 'PostController@update')->name('update');
    Route::post('/delete/{id}', 'PostController@destroy')->name('delete');
});
// 今回は外部APIでPOSTたたかないため関係ないが、一応apiでPOSTした場合のチェックしてみたい。
//Route::middleware('auth:api')->post('/post/create', 'PostController@store')->name('api_postcreate'); //未チェック
