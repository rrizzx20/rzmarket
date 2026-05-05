<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Penjualan
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/pos', [SaleController::class, 'index'])->name('pos');
        Route::post('/pos', [SaleController::class, 'store'])->name('store');
        Route::get('/history', [SaleController::class, 'history'])->name('history');
        Route::patch('/{sale}', [SaleController::class, 'update'])->name('update');
    });

    // Stok Rokok
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/incoming', [ProductController::class, 'incoming'])->name('incoming');
        Route::post('/incoming', [ProductController::class, 'storeIncoming'])->name('store.incoming');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::patch('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Ngebon
    Route::prefix('debts')->name('debts.')->group(function () {
        Route::get('/', [DebtController::class, 'index'])->name('index');
        Route::get('/create', [DebtController::class, 'create'])->name('create');
        Route::post('/', [DebtController::class, 'store'])->name('store');
        Route::get('/payments', [DebtController::class, 'payments'])->name('payments');
        Route::post('/payments/{debt}', [DebtController::class, 'pay'])->name('pay');
    });

    // Pengeluaran
    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('index');
        Route::get('/create', [ExpenseController::class, 'create'])->name('create');
        Route::post('/', [ExpenseController::class, 'store'])->name('store');
    });

    // Tabungan
    Route::prefix('savings')->name('savings.')->group(function () {
        Route::get('/', [SavingController::class, 'index'])->name('index');
        Route::get('/create-target', [SavingController::class, 'createTarget'])->name('create.target');
        Route::post('/store-target', [SavingController::class, 'storeTarget'])->name('store.target');
        Route::get('/create', [SavingController::class, 'create'])->name('create');
        Route::post('/', [SavingController::class, 'store'])->name('store');
        Route::delete('/{saving}', [SavingController::class, 'destroy'])->name('destroy');
        Route::delete('/target/{target}', [SavingController::class, 'destroyTarget'])->name('destroy.target');
    });

    // Keuangan
    Route::prefix('finance')->name('finance.')->group(function () {
        Route::get('/income', [FinanceController::class, 'income'])->name('income');
        Route::get('/expense', [FinanceController::class, 'expense'])->name('expense');
        Route::get('/profit', [FinanceController::class, 'profit'])->name('profit');
        Route::get('/charts', [FinanceController::class, 'charts'])->name('charts');
    });

    // Pengaturan
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

require __DIR__.'/auth.php';
