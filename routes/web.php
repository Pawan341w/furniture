<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\ProductQRCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\BankAccountController;
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/',[DashboardController::class,'index'])->name('dashboard')->middleware('auth');

// Admin Routes
// =============================================================================================

Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/users-management', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/used-qrcodes', [UserController::class, 'getUsedQRCodes']);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('products', ProductController::class);


Route::get('/qr/{product}', [ProductQRCodeController::class, 'show'])->name('product.qr.show');
Route::get('qr-management',[ProductController::class,'qr_mang'])->name('qr.mang');
Route::post('/qr/generate', [ProductQRCodeController::class, 'generate'])->name('product.qr.generate');
// Route::prefix('general-settings')->controller(GeneralSettingController::class)->group(function () {
//     Route::get('/', 'index');
//     Route::post('/', 'store');
//     Route::get('/{id}', 'show');
//     Route::post('/{id}', 'update');
//     Route::delete('/{id}', 'destroy');
// });


Route::name('admin.')->group(function () {
    Route::prefix('general-settings')->name('general-settings.')->controller(GeneralSettingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});

});
// Users Routes
// ======================================================================================
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/scan/{code}', [ScanController::class, 'scan'])->name('product.qr.scan');




Route::get('/bank-account', [BankAccountController::class, 'index'])->name('bank.details.index');
    Route::post('/bank-account/update', [BankAccountController::class, 'ajaxUpdate'])->name('bank.details.update.ajax');
    Route::delete('/bank-account/delete', [BankAccountController::class, 'destroy'])->name('bank.details.delete');
 Route::get('/withdrawals', [TransactionsController::class, 'showWithdrawals'])->name('withdraw.index');
    Route::post('/withdraw', [TransactionsController::class, 'request'])->name('withdraw.request');
        Route::get('/wallet-history', [TransactionsController::class, 'wallethistory'])->name('wallet.history');


});
