<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ReportController,
    TransactionController,
    CustomerController,
    CategoryController,
    ProductController,
    SupplierController,
    ProfileController
};

use App\Models\{
    Product,
    Sale,
    User,
    Category,
    Customer,
    Supplier
};

// Default redirect
Route::get('/', fn() => redirect()->route('login'));

// Halaman bantuan (akses semua user yang login)
Route::middleware(['auth', 'verified'])->get('/guide', fn() => view('guide'))->name('guide');

// Dashboard (akses semua admin yang login)
Route::middleware(['auth', 'verified',])->get('/dashboard', function () {
    $totalProducts   = Product::count();
    $totalSales      = Sale::count();
    $totalUsers      = User::count();
    $totalCategories = Category::count();
    $totalCustomers  = Customer::count();
    $totalSuppliers  = Supplier::count();

    return view('dashboard', [
        'totalProducts'   => $totalProducts,
        'totalSales'      => $totalSales,
        'totalUsers'      => $totalUsers,
        'totalCategories' => $totalCategories,
        'totalCustomers'  => $totalCustomers,
        'totalSuppliers'  => $totalSuppliers,

        // Sidebar badges
        'sidebarTotalProducts'   => $totalProducts,
        'sidebarTotalSales'      => $totalSales,
        'sidebarTotalUsers'      => $totalUsers,
        'sidebarTotalCategories' => $totalCategories,
        'sidebarTotalCustomers'  => $totalCustomers,
        'sidebarTotalSuppliers'  => $totalSuppliers,
    ]);
})->name('dashboard');

// ======================
// 🔹 Admin Only
// ======================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);       // hanya admin CRUD user
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);

    // Laporan hanya admin
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');
});

// ======================
// 🔹 Admin & Pegawai
// ======================
Route::middleware(['auth', 'verified', 'role:admin,pegawai'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('transactions', TransactionController::class);
});

// ======================
// 🔹 Profil User (semua yang login)
// ======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
