<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\AdminLinksController;
use App\Http\Controllers\DishController;




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

Auth::routes();

Route::get('/', [LinksController::class, 'index']);
Route::get('/home', [LinksController::class, 'index'])->name('home');

// admin routes ***********
Route::get('/admin', [AdminLinksController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard', [AdminLinksController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dishes', [DishController::class, 'index'])->name('admin.dishes');
Route::post('/admin/dishes/store', [DishController::class, 'store'])->name('admin.dishes.store');
Route::post('/admin/dishes/destroy/{dish}', [DishController::class, 'destroy'])->name('admin.dishes.destroy');


