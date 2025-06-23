<?php

use App\Http\Controllers\Apps\CategoryController;
use App\Http\Controllers\Apps\CustomerController;
use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\ProductController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\SaleController;
use App\Http\Controllers\Apps\TransactionController;
use App\Http\Controllers\Apps\UserController;
use App\Models\Category;
use App\Models\Customer;
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
        Route::resource('/categories', CategoryController::class, ['as' => 'apps']);
        Route::resource('/products', ProductController::class, ['as' => 'apps']);
        Route::resource('/customers', CustomerController::class, ['as' => 'apps']);
        Route::get('/transactions', [TransactionController::class, 'index'])->name('apps.transactions.index');
        Route::post('/transactions/searchProduct', [TransactionController::class, 'searchProduct'])->name('apps.transactions.searchProduct');
        Route::post('/transactions/addToCart', [TransactionController::class, 'addToCart'])->name('apps.transactions.addToCart');
        Route::post('/transactions/destroyCart', [TransactionController::class, 'destroyCart'])->name('apps.transactions.destroyCart');
        Route::post('/transactions/store', [TransactionController::class, 'store'])->name('apps.transactions.store');
        Route::get('/transactions/print', [TransactionController::class, 'print'])->name('apps.transactions.print');
        Route::get('/sales', [SaleController::class, 'index'])->name('apps.sales.index');
        Route::get('/sales/filter', [SaleController::class, 'filter'])->name('apps.sales.filter');
        Route::get('/sales/export', [SaleController::class, 'export'])->name('apps.sales.export');
    });
});
