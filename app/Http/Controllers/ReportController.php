<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function export(Request $request)
    {
        $request->validate([
            'types' => 'required|array',
            'types.*' => 'in:customers,products,suppliers,transactions',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        $types = $request->input('types');
        $from = $request->input('from_date');
        $to = $request->input('to_date');

        $reports = [];

        foreach ($types as $type) {
            switch ($type) {
                case 'customers':
                    $query = Customer::query();
                    if ($from && $to) {
                        $query->whereBetween('created_at', [$from, $to]);
                    }
                    $reports[$type] = $query->get();
                    break;

                case 'products':
                    $query = Product::with('supplier');
                    if ($from && $to) {
                        $query->whereBetween('created_at', [$from, $to]);
                    }
                    $reports[$type] = $query->get();
                    break;

                case 'suppliers':
                    $query = Supplier::query();
                    if ($from && $to) {
                        $query->whereBetween('created_at', [$from, $to]);
                    }
                    $reports[$type] = $query->get();
                    break;

                case 'transactions':
                    $query = Transaction::with(['customer', 'items.product']);
                    if ($from && $to) {
                        $query->whereBetween('date', [$from, $to]);
                    }
                    $reports[$type] = $query->get();
                    break;
            }
        }

        $pdf = Pdf::loadView('reports.pdf', compact('reports', 'from', 'to'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream("laporan.pdf");
    }
}
