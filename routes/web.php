<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingsController;
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

Route::group([], function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/404', [MainController::class, 'notFound'])->name('404');

    Route::prefix('subscribers')->as('subscribers.')->group(function () {
        Route::get('/', [MainController::class, 'showList'])->name('list');
    });

    Route::prefix('settings')->as('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/validate/api-key', [SettingsController::class, 'validateApiKey'])->name('validate.api-key');
    });

});
