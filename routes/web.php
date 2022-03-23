<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\Admin\AdminBookTourController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('clear', function () {
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return 'clear';
});


// Admin Pages Route
Route::get('admin/tour-listing', [AdminBookTourController::class, 'index'])->name('admin/tour-listing');
Route::post('admin/confirm-tour-book', [AdminBookTourController::class, 'confirm_tour_book'])->name('admin/confirm-tour-book');
Route::post('admin/cancel-tour-book', [AdminBookTourController::class, 'cancel_tour_book'])->name('admin/cancel-tour-book');

Route::get('/', [TourController::class, 'index'])->name('/');
Route::get('tour-listing', [TourController::class, 'index'])->name('tour-listing');
Route::get('book/{slug}', [TourController::class, 'tour_book'])->name('tour-book');
Route::post('store', [TourController::class, 'store'])->name('tour-store');
Route::post('country-select', [CountryController::class, 'country_select'])->name('country-select');
Route::post('city-select', [CityController::class, 'city_select'])->name('city-select');
