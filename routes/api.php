<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(
    function () {

        Route::prefix('account')->group(function () {
            // Lấy thông tin quản lý
            Route::get('/get', 'Admin\ManagerController@get')->name('admin.manager.get');
        });
        Route::prefix('transaction')->group(function () {
            // Lấy thông tin quản lý
            Route::get('/get', 'Admin\ManagerController@get_transaction')->name('admin.transaction.get');
        });
    }
);
