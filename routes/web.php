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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/upload', 'HomeController@uploadAvatar')->name('uploadavatar');
Route::group(['middleware'=>'auth'], function () {
    Route::resource('admin', 'AdminController');
    Route::resource('todo', 'TodoController');
    Route::put('/todo/{todo}/complete', 'TodoController@completeTodo')->name('todo.complete');
    Route::put('/todo/{todo}/incomplete', 'TodoController@incompleteTodo')->name('todo.incomplete');
    // Route::get('/admin', 'AdminController@index')->name('admin.index');
    // Route::get('/admin/{id}/edit', 'AdminController@index')->name('admin.edit');
});
