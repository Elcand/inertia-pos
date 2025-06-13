<?php

use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\PermissionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('apps.dashboard');
    }
    return Inertia::render('Auth/Login');
});

Route::prefix('apps')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard', DashboardController::class)->name('apps.dashboard');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('apps.permissions.index');
    });
});
