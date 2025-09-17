<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ReportController,
    TransactionController,
    CustomerController,
    ProductController,
    SupplierController,
    ProfileController
};

use App\Models\{
    Product,
    User,
    Customer,
    Transaction,
    Supplier
};

// login
Route::get('/', function () {return view('auth.login');})->name('login');

// Dashboard (akses semua yang login)
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $totalProducts     = Product::count();
    $totalTransactions = Transaction::count();
    $totalUsers        = User::count();
    $totalCustomers    = Customer::count();
    $totalSuppliers    = Supplier::count();

    return view('dashboard', compact(
        'totalProducts',
        'totalTransactions',
        'totalUsers',
        'totalCustomers',
        'totalSuppliers'
    ));
})->name('dashboard');


// ======================
// 🔹 Admin Only
// ======================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);       // hanya admin CRUD user
    Route::resource('suppliers', SupplierController::class);
    Route::resource('transactions', TransactionController::class);

    // Laporan hanya admin
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');

});

// ======================
// 🔹 Admin & Pegawai
// ======================
Route::middleware(['auth', 'verified', 'role:admin,pegawai'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
});

// ======================
// 🔹 Profil User (semua yang login)
// ======================
Route::middleware('auth')->group(function () {
    Route::get('/guide', function () {return view('guide');})->name('guide');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
