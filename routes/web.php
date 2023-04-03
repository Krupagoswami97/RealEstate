<?php

use Illuminate\Http\Request;
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
    return view('dashboards.main');
});

Route::get('/browser/js/disabled', function(){
    return view('errors.js_disabled');
})->name('js_disabled');

Route::get('/', function(){
    return view('dashboards.main');
})->name('main_dashboard');


Route::prefix('real-estate')->group(function () {

    # Real Estate
    Route::get('real/estate', function(){return view('pages.real_estate.index');})->name('real_estate.index');
    Route::get('real/estate/add', function(){ return view('pages.real_estate.create_edit'); })->name('real_estate.create');
    Route::get('real/estate/edit/{id}', function(Request  $request){ $id =  $request->id; return view('pages.real_estate.create_edit',compact('id')); })->name('real_estate.edit');

});
