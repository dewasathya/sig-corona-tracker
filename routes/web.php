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
    $reports = DB::table('district_reports')
    ->join('districts', 'district_reports.district_id', '=', 'districts.id')
    ->select('district_reports.*', 'districts.district_name')
    ->get();

    return view('map', ['reports' => $reports]);
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

Route::get('/home', function() {
    return redirect()->route('map');
})->name('home');
