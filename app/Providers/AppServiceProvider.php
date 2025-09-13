<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with([
                'sidebarTotalProducts'   => Product::count(),
                'sidebarTotalSales'      => Sale::count(),
                'sidebarTotalUsers'      => User::count(),
                'sidebarTotalCategories' => Category::count(),
                'sidebarTotalCustomers'  => Customer::count(),
                'sidebarTotalSuppliers'  => Supplier::count(),
            ]);
        });
    }

}
