<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', 'MapController@index')->name('map');
// Route::get('/{')

Route::get('/test', function () {
    return view('mapcopy');
});

Route::get('/mess', function () {
    $kmz = "";

    return view('mapmess', ['kmz' => $kmz]);
});

Route::get('/kmz', function () {
    return response()->download(storage_path("app/public/bali-kabupaten.kmz"));
})->name('kmz');

Route::get('/geojson', function () {
    return response()->download(storage_path("app/public/bali-kab.geojson"));
})->name('kmz');

Route::resource('district', 'DistrictController')->middleware('auth');

Route::resource('report', 'DistrictReportController')->middleware('auth');

Auth::routes();

Route::get('/home', function() {
    return redirect()->route('map');
})->name('home');
