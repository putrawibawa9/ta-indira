



<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\SupplierController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/guide', function () {
        return view('guide');
    })->name('guide');
});
Route::resource('transactions', TransactionController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('customers', CustomerController::class);
Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});


use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');
});

Route::get('/dashboard', function () {
    $totalProducts = Product::count();
    $totalSales = Sale::count();
    $totalUsers = User::count();
    $totalCategories = Category::count();
    $totalCustomers = Customer::count();
    $totalSuppliers = Supplier::count();
    return view('dashboard', [
        'totalProducts' => $totalProducts,
        'totalSales' => $totalSales,
        'totalUsers' => $totalUsers,
        'totalCategories' => $totalCategories,
        'totalCustomers' => $totalCustomers,
        'totalSuppliers' => $totalSuppliers,
        // For sidebar badges
        'sidebarTotalProducts' => $totalProducts,
        'sidebarTotalSales' => $totalSales,
        'sidebarTotalUsers' => $totalUsers,
        'sidebarTotalCategories' => $totalCategories,
        'sidebarTotalCustomers' => $totalCustomers,
        'sidebarTotalSuppliers' => $totalSuppliers,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
