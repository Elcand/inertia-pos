<?php

use App\Http\Controllers\Apps\CategoryController;
use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\UserController;
use App\Models\Category;
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
        Route::get('permissions', [PermissionController::class, 'index'])->name('apps.permissions.index');
        Route::resource('/roles', RoleController::class, ['as' => 'apps']);
        Route::resource('/users', UserController::class, ['as' => 'apps']);
        Route::resource('/cetegories', CategoryController::class, ['as' => 'apps']);
    });
});
