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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('userList','App\Http\Controllers\AuthController@getUserList')->middleware(['auth:api', 'hasAccess:Staff']);
    Route::delete('delete/{id}','App\Http\Controllers\AuthController@delete')->middleware(['auth:api', 'hasAccess:Staff']);
    Route::delete('delete-all','App\Http\Controllers\AuthController@deleteAll')->middleware(['auth:api', 'hasAccess:Staff']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'chat'], function () {
    Route::get('all', 'App\Http\Controllers\ChatController@all')->middleware('hasAccess:Staff');
    Route::get('/', 'App\Http\Controllers\ChatController@index')->middleware('hasAccess:Customer');
    Route::post('send', 'App\Http\Controllers\ChatController@send');
    Route::post('feedback', 'App\Http\Controllers\ChatController@feedback')->middleware('hasAccess:Customer');
    Route::post('report', 'App\Http\Controllers\ChatController@report')->middleware('hasAccess:Customer');
});