<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // dompdf facade
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function export(Request $request)
    {
        // Example: Export all sales as PDF
        $sales = Sale::with(['customer', 'user'])->orderBy('sale_date', 'desc')->get();
        $pdf = PDF::loadView('reports.sales_pdf', compact('sales'));
        return $pdf->download('laporan-transaksi.pdf');
    }
}
