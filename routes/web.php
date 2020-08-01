<?php

use Illuminate\Support\Facades\Route;
use Auth;

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


Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/profile', 'AdminUsersController@profile')->name('profile');

    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', 'AdminUsersController@index')->name('index');
                Route::get('/create', 'AdminUsersController@create')->name('create');
                Route::post('/create', 'AdminUsersController@store')->name('store');
                Route::prefix('{user}')->group(function () {
                    Route::get('/', 'AdminUsersController@show')->name('show');
                    Route::get('/edit', 'AdminUsersController@edit')->name('edit');
                    Route::post('/edit', 'AdminUsersController@update')->name('update');
                    Route::get('/delete', 'AdminUsersController@confirmdelete')->name('confirmdelete');
                    Route::post('/delete', 'AdminUsersController@delete')->name('delete');
                });
            });
        });
    });
});

