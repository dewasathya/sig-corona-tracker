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
    return view('map');
})->name('map');

Route::get('/test', function () {
    return view('mapcopy');
});

Route::get('/mess', function () {
    return view('mapmess');
});

Route::resource('district', 'DistrictController')->middleware('auth');

Route::resource('report', 'DistrictReportController')->middleware('auth');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
