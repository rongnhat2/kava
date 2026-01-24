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

Route::get('/', 'Admin\DisplayController@statistic')->name('customer.index');
Route::get('/transaction', 'Admin\DisplayController@transaction')->name('customer.transaction');
Route::get('/statistic', 'Admin\DisplayController@statistic')->name('customer.statistic');
