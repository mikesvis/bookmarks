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

Route::get('/', 'BookmarkController@index')->name('bookmark.index');
Route::get('/create', 'BookmarkController@create')->name('bookmark.create');
Route::get('/bookmark/export', 'BookmarkController@export')->name('bookmark.export');
Route::get('/bookmark/{bookmark}', 'BookmarkController@show')->name('bookmark.show');
Route::post('/bookmark', 'BookmarkController@store')->name('bookmark.store');
Route::delete('/bookmark/{bookmark}', 'BookmarkController@destroy')->name('bookmark.destroy');
