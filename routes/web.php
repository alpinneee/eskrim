<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('auth.login');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes dengan middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/cashiers', [AdminController::class, 'cashiers'])->name('admin.cashiers');
    Route::get('/admin/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/admin/transactions/{id}', [AdminController::class, 'transactionDetail'])->name('admin.transactions.detail');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/reports/export', [AdminController::class, 'exportReport'])->name('admin.reports.export');
});

// Cashier routes dengan middleware
Route::middleware(['auth', 'cashier'])->group(function () {
    Route::get('/cashier/dashboard', [\App\Http\Controllers\CashierController::class, 'dashboard'])->name('cashier.dashboard');
    Route::get('/cashier/transactions', [\App\Http\Controllers\CashierController::class, 'transactions'])->name('cashier.transactions');
    Route::get('/cashier/transactions/create', [\App\Http\Controllers\CashierController::class, 'createTransaction'])->name('cashier.transactions.create');
    Route::post('/cashier/transactions', [\App\Http\Controllers\CashierController::class, 'storeTransaction'])->name('cashier.transactions.store');
    Route::patch('/cashier/transactions/{id}/status', [\App\Http\Controllers\CashierController::class, 'updateTransactionStatus'])->name('cashier.transactions.update.status');
    Route::delete('/cashier/transactions/{id}', [\App\Http\Controllers\CashierController::class, 'deleteTransaction'])->name('cashier.transactions.delete');
    Route::get('/cashier/products', [\App\Http\Controllers\CashierController::class, 'products'])->name('cashier.products');
    Route::get('/cashier/reports', [\App\Http\Controllers\CashierController::class, 'reports'])->name('cashier.reports');
    Route::get('/cashier/reports/export', [\App\Http\Controllers\CashierController::class, 'exportReport'])->name('cashier.reports.export');
});

Route::middleware('auth')->group(function () {

    // Dashboard pelanggan
    Route::get('/pelanggan/dashboard', [\App\Http\Controllers\CustomerController::class, 'dashboard'])->name('pelanggan.dashboard');

    // Riwayat transaksi pelanggan
    Route::get('/pelanggan/riwayat', [\App\Http\Controllers\CustomerController::class, 'riwayat'])->name('pelanggan.riwayat');
    Route::get('/pelanggan/riwayat/{id}', [\App\Http\Controllers\CustomerController::class, 'transactionDetail'])->name('pelanggan.transaction.detail');
    
    // QR Transaction untuk pembayaran
    Route::get('/pelanggan/transaksi-qr/{id}', [\App\Http\Controllers\CustomerController::class, 'showTransactionQR'])->name('pelanggan.transaction.qr');
    Route::post('/pelanggan/konfirmasi-pembayaran/{id}', [\App\Http\Controllers\CustomerController::class, 'confirmPayment'])->name('pelanggan.payment.confirm');

    // Profil pelanggan
    Route::get('/pelanggan/profil', [\App\Http\Controllers\CustomerController::class, 'profile'])->name('pelanggan.profil');
    Route::put('/pelanggan/profil', [\App\Http\Controllers\CustomerController::class, 'updateProfile'])->name('pelanggan.profil.update');

    // Notifikasi pelanggan
    Route::get('/pelanggan/notifikasi', function () {
        return view('pelanggan.notifikasi');
    })->name('pelanggan.notifikasi');

    // Menu dan keranjang pelanggan
    Route::get('/pelanggan/menu', [\App\Http\Controllers\CustomerController::class, 'menu'])->name('pelanggan.menu');
    Route::get('/pelanggan/cart', [\App\Http\Controllers\CustomerController::class, 'cart'])->name('pelanggan.cart');
    Route::post('/pelanggan/cart/add', [\App\Http\Controllers\CustomerController::class, 'addToCart'])->name('pelanggan.cart.add');
    Route::put('/pelanggan/cart/update', [\App\Http\Controllers\CustomerController::class, 'updateCart'])->name('pelanggan.cart.update');
    Route::delete('/pelanggan/cart/remove/{productId}', [\App\Http\Controllers\CustomerController::class, 'removeFromCart'])->name('pelanggan.cart.remove');
    Route::post('/pelanggan/checkout', [\App\Http\Controllers\CustomerController::class, 'checkout'])->name('pelanggan.checkout');
});
