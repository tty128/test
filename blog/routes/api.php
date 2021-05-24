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
Route::get('/post', 'PostController@apiIndex')->name('posts');
Route::get('/post/{post}', 'PostController@show')->name('postshow');
