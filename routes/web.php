<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\ProductQRCodeController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function()
{
    return  view('admin.dashboard');
});

Route::get('/qr-mang',function()
{
    return  view('admin.products.qr_mang');
});
Route::get('/scan/{code}', [ScanController::class, 'scan'])->name('product.qr.scan');
Route::get('/scan', function () {
    return view('qr.scan');
});

// Route::get('category',function()
// {
//     return view('admin.category');
// });
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


// Route::get('/qr-list/{product}/',function()
//  {
// return view('admin.products.qr_list');
// });
// Route::get('/qr-list/{product}', [ProductQRCodeController::class, 'index'])->name('product.qr.index');

Route::get('/qr/{product}', [ProductQRCodeController::class, 'show'])->name('product.qr.show');
Route::get('qr-management',[ProductController::class,'qr_mang'])->name('qr.mang');
Route::post('/qr/generate', [ProductQRCodeController::class, 'generate'])->name('product.qr.generate');
Route::prefix('general-settings')->controller(GeneralSettingController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::post('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('general-settings')->name('general-settings.')->controller(GeneralSettingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});
