<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
// use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Di sini Anda bisa mendaftarkan semua rute web untuk aplikasi Anda.
| Rute ini dimuat oleh RouteServiceProvider dan akan dikelompokkan
| dalam grup yang memiliki middleware "web".
|--------------------------------------------------------------------------
*/

// Authentication Routes

Route::get('/', [LoginController::class, 'indexLogin'])->name('auth.login');
Route::post('/login_proses', [LoginController::class, 'proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'Register'])->name('auth.register');
Route::post('/register', [LoginController::class, 'storeRegister'])->name('auth.register');

// Routes Protected by Login

// Route::middleware(['isLogin'])->group(function () {

// });

// Role-Based Access (Admin, Customer)

Route::middleware(['isLogin', 'isLevel:admin,customer'])->group(function () {
    Route::resource('dashboard', PageController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('transactions.update-status');

        // Export PDF
    Route::get('/pdf/customers', [CustomerController::class, 'downloadPdf'])->name('customers.pdf');
    Route::get('/pdf/transactions', [TransactionController::class, 'downloadPdf'])->name('transactions.pdf');
});
