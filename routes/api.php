<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\DishApiController;
use App\Http\Controllers\Api\DishCategoryApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\SaleApiController;




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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

});

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'dishes',
], function ($router) {
    Route::get('/dishes', [DishApiController::class, 'index']);
    Route::get('/dish-categories', [DishCategoryApiController::class, 'index']);

});

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'booking',
], function ($router) {
    Route::post('/book-a-table', [BookingApiController::class, 'store']);

});


Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'sale',
], function ($router) {
    Route::post('/make-sale', [SaleApiController::class, 'store']);

});

