<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(['prefix' => 'post' , 'as' => 'post.'],function(){
    Route::get('/', 'PostController@index')->name('all');
    // Route::get('/edit','PostController@edit')->name('edit'); // vue.componentで実装予定    
    
    Route::post('/create', 'PostController@store')->name('create');

    // 未チェック
    Route::post('/update/{id}', 'PostController@update')->name('update');
    Route::post('/delete/{id}', 'PostController@destroy')->name('delete');

});
