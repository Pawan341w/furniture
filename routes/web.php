<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function()
{
    return  view('admin.dashboard');
});
Route::get('/scan/{code}', [ScanController::class, 'scan'])->name('product.qr.scan');

// Route::get('category',function()
// {
//     return view('admin.category');
// });

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('products', ProductController::class);

use App\Http\Controllers\ProductQRCodeController;

// Route::get('/qr-list/{product}/',function()
//  {
// return view('admin.products.qr_list');
// });
// Route::get('/qr-list/{product}', [ProductQRCodeController::class, 'index'])->name('product.qr.index');

Route::get('/qr/{product}', [ProductQRCodeController::class, 'show'])->name('product.qr.show');

Route::post('/qr/generate', [ProductQRCodeController::class, 'generate'])->name('product.qr.generate');
