<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\AdminLinksController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\DishCategoryController;
use App\Http\Controllers\BookingController;





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
Route::post('/booking/store', [LinksController::class, 'store'])->name('booking.store');

// admin routes ***********
Route::get('/admin', [AdminLinksController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard', [AdminLinksController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dishes', [DishController::class, 'index'])->name('admin.dishes');
Route::post('/admin/dishes/store', [DishController::class, 'store'])->name('admin.dishes.store');
Route::post('/admin/dishes/destroy/{dish}', [DishController::class, 'destroy'])->name('admin.dishes.destroy');
Route::put('/admin/dishes/{dish}/update', [DishController::class, 'update'])->name('admin.dishes.update');
Route::put('/admin/dishes/{dish}/destroy', [DishController::class, 'destroy'])->name('admin.dishes.destroy');
Route::get('/admin/categories', [DishCategoryController::class, 'index'])->name('admin.categories');
Route::post('/admin/categories/store', [DishCategoryController::class, 'store'])->name('admin.categories.store');
Route::put('/admin/categories/{category}/update', [DishCategoryController::class, 'update'])->name('admin.categories.update');
Route::put('/admin/categories/{category}/destroy', [DishCategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::get('/admin/booking', [BookingController::class, 'index'])->name('admin.booking');
Route::put('/admin/booking/{booking}/destroy', [BookingController::class, 'destroy'])->name('admin.booking.destroy');
Route::get('/admin/booking/{booking}/attend', [BookingController::class, 'attend'])->name('admin.booking.attend');


