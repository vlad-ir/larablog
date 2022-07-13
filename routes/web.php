<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostController@index')->name('post.index');

Route::group(['prefix' => 'post'], function () {
    Route::get('/search', 'PostController@search')->name('post.search');
    Route::get('/create', 'PostController@create')->name('post.create');
    Route::post('/store', 'PostController@store')->name('post.store');
    Route::get('/{post}', 'PostController@show')->name('post.show');
    Route::get('/edit/{post}', 'PostController@edit')->name('post.edit');
    Route::patch('/update/{post}', 'PostController@update')->name('post.update');
    Route::delete('/destroy/{post}', 'PostController@destroy')->name('post.delete');
    Route::post('/subscribe/{post}', 'SubscriberController@store')->name('post.subscribe');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
