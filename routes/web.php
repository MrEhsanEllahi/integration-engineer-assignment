<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\RuntimeLogsController;
use App\Http\Controllers\IntegrationsController;
use App\Http\Controllers\SubscribersController;
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
    Route::get('/logs', [RuntimeLogsController::class, 'index'])->name('logs');

    Route::prefix('subscribers')->as('subscribers.')->group(function () {
        Route::get('/', [SubscribersController::class, 'index'])->name('index');
        Route::get('/list', [SubscribersController::class, 'list'])->name('list');
        Route::post('/', [SubscribersController::class, 'store'])->name('store');
        Route::get('/edit/{subscriberId}', [SubscribersController::class, 'edit'])->name('edit');
        Route::patch('/', [SubscribersController::class, 'update'])->name('update');
        Route::post('/remove', [SubscribersController::class, 'destroy'])->name('remove');
    });

    Route::prefix('integrations')->as('integrations.')->group(function () {
        Route::get('/', [IntegrationsController::class, 'index'])->name('index');
        Route::post('/validate', [IntegrationsController::class, 'validateIntegration'])->name('validate');
    });

    Route::prefix('runtime-logs')->as('runtime-logs.')->group(function () {
        Route::get('/', [RuntimeLogsController::class, 'index'])->name('index');
        Route::get('/{runtimeLogId}', [RuntimeLogsController::class, 'show'])->name('show');
    });

});
