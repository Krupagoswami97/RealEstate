<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealEstateApiController;
use App\Http\Controllers\RealEstateController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// For RESTFul Api

Route::resource('real_estate', RealEstateApiController::class);

// For Web Api

# Real Estate Operation
Route::post('real/estate/store', [RealEstateController::class,'store']);
Route::post('real/estate/list', [RealEstateController::class, 'list']);
Route::post('real/estate/get_single', [RealEstateController::class, 'get_single']);
Route::post('real/estate/update', [RealEstateController::class, 'update']);
Route::post('real/estate/delete', [RealEstateController::class, 'delete']);
Route::post('real/estate/restore', [RealEstateController::class, 'restore']);
Route::post('real/estate/recycle', [RealEstateController::class, 'recycle']);
