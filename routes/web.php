<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/transaction/invoice', [InvoiceController::class, 'pdf']);


