<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StageItemController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::post('/set-locale/{locale}', SetLocaleController::class)->name('set-locale');

    Route::controller(ProfileController::class)->prefix('/profile')->name('profile.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/update', 'update')->name('update');
            Route::put('/password-update', 'updatePassword')->name('password-update');
            Route::put('/password-dp', 'updateDp')->name('update-dp');
        });

    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/stages-line-chart/{period?}', 'stagesLineChart')->name('stages-line-chart');
            Route::post('/stages-pie-chart/{period?}', 'stagesPieChart')->name('stages-pie-chart');
            Route::post('/best-buildings', 'bestBuildings')->name('best-buildings');
            Route::post('/best-kitchens', 'bestKitchens')->name('best-kitchens');
            Route::post('/best-items', 'bestItems')->name('best-items');
        });

    Route::resource('/kitchens', KitchenController::class);
    Route::resource('/buildings', BuildingController::class);
    Route::resource('/contacts', ContactController::class);
    Route::resource('/items', ItemController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);

    Route::resource('/stages', StageController::class);
    Route::controller(StageController::class)->prefix('/stages')->name('stages.')
        ->group(function () {
            Route::put('/{stage}/assign-cooked-at', 'assignCookedAt')->name('assign-cooked-at');
            Route::put('/{stage}/assign-packaging-at', 'assignPackagingAt')->name('assign-packaging-at');
            Route::put('/{stage}/assign-delivered-by', 'assignDeliveredBy')->name('assign-delivered-by');
            Route::put('/{stage}/assign-delivered-at', 'assignDeliveredAt')->name('assign-delivered-at');
            Route::put('/{stage}/handed-to', 'assignHandedTo')->name('assign-handed-to');
            Route::put('/{stage}/update-rating', 'updateRating')->name('update-rating');
        });

    Route::put('/stages/{stage}/items/{item}/update-rating', [StageItemController::class, 'updateRating'])->name('stage-items.update-rating');
});

require __DIR__ . '/auth.php';
