<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web'])->group(function () {
    Route::get('/', [\App\Http\Controllers\IndexController::class, 'homePage'])->name('guest');
    Route::get('/papers', [\App\Http\Controllers\IndexController::class, 'papers'])->name('guest.papers');
    Route::get('/examples', [\App\Http\Controllers\IndexController::class, 'examples'])->name('guest.examples');
    Route::get('/cal-fitting', [\App\Http\Controllers\IndexController::class, 'cal_fitting'])->name('guest.cal-fitting');
});