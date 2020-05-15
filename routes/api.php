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

Route::get('product/{id?}', 'ProductController@list');
Route::post('product', 'ProductController@create');
Route::delete('product/{id}', 'ProductController@delete');
Route::put('product/{id}', 'ProductController@edit');
Route::get('category', 'ProductCategoryController@all');