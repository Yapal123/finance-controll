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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'MainController@showSpendings')->name('showSpendings');

Route::post('ajaxDate','MainController@ajaxTime')->name('ajaxTime');

Route::post('ajaxAdd','MainController@ajaxAdd')->name('ajaxAdding');

Route::post('ajaxCat','MainController@ajaxCategory')->name('ajaxCateg');