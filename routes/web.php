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
    Route::get('/formulas-and-papers', [\App\Http\Controllers\IndexController::class, 'papers'])->name('guest.formulas-and-papers');
    Route::get('/examples', [\App\Http\Controllers\IndexController::class, 'examples'])->name('guest.examples');
    Route::get('/cd-examples', [\App\Http\Controllers\IndexController::class, 'cd_examples'])->name('guest.cd-examples');
    Route::get('/cal-examples', [\App\Http\Controllers\IndexController::class, 'cal_examples'])->name('guest.cal-examples');
    Route::get('/cd-fitting', [\App\Http\Controllers\IndexController::class, 'cd_fitting'])->name('guest.cd-fitting');
    Route::get('/cal-fitting', [\App\Http\Controllers\IndexController::class, 'cal_fitting'])->name('guest.cal-fitting');
    Route::get('/cal-download/{dir}/{file}', [\App\Http\Controllers\IndexController::class, 'cal_download'])->name('cal-download');
    Route::get('/cd-download/{method}/{dir}/{file}', [\App\Http\Controllers\IndexController::class, 'cd_download'])->name('cd-download');
});