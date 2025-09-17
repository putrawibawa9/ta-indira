<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Tampilkan semua transaksi
     */
    public function index(Request $request)
    {
        $query = Transaction::with('customer');

        // Jika ada pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->whereHas('customer', function($customerQuery) use ($search) {
                    $customerQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhere('payment_method', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhere('date', 'like', "%{$search}%")
                ->orWhere('total', 'like', "%{$search}%");
            });
        }

        $transactions = $query->orderBy('date', 'desc')->paginate(10);

        // Agar query search tetap ada di pagination
        $transactions->appends($request->only('search'));

        return view('transactions.index', compact('transactions'));
    }


    /**
     * Form tambah transaksi
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('transactions.create', compact('customers', 'products'));
    }

    /**
     * Simpan transaksi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'payment_method' => 'required|in:tunai,kredit',
            'status' => 'required|in:lunas,belum_lunas,batal',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            // Hitung total
            $total = 0;
            foreach ($request->products as $p) {
                $product = Product::findOrFail($p['id']);
                $total += $product->price * $p['quantity'];
            }

            // Simpan transaksi
            $transaction = Transaction::create([
                'customer_id' => $request->customer_id,
                'date' => $request->date,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'dp' => $request->dp ?? 0,
                'status' => $request->status,
            ]);

            // Simpan detail item
            foreach ($request->products as $p) {
                $product = Product::findOrFail($p['id']);

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $p['quantity'],
                    'price' => $product->price,
                ]);

                // Kurangi stok barang
                $product->decrement('stock', $p['quantity']);
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Detail transaksi
     */
    public function show($id)
    {
        $transaction = Transaction::with(['customer', 'items.product'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Form edit transaksi
     */
    public function edit($id)
    {
        $transaction = Transaction::with('items.product')->findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();

        return view('transactions.edit', compact('transaction', 'customers', 'products'));
    }

    /**
     * Update transaksi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'payment_method' => 'required|in:tunai,kredit',
            'status' => 'required|in:lunas,belum_lunas,batal',
        ]);

        DB::transaction(function () use ($request, $id) {
            $transaction = Transaction::findOrFail($id);

            // Reset stok lama
            foreach ($transaction->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            // Hapus items lama
            $transaction->items()->delete();

            // Hitung total baru
            $total = 0;
            foreach ($request->products as $p) {
                $product = Product::findOrFail($p['id']);
                $total += $product->price * $p['quantity'];
            }

            // Update transaksi
            $transaction->update([
                'customer_id' => $request->customer_id,
                'date' => $request->date,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'dp' => $request->dp ?? 0,
                'status' => $request->status,
            ]);

            // Simpan ulang items baru
            foreach ($request->products as $p) {
                $product = Product::findOrFail($p['id']);

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $p['quantity'],
                    'price' => $product->price,
                ]);

                // Update stok barang
                $product->decrement('stock', $p['quantity']);
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Hapus transaksi
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $transaction = Transaction::with('items.product')->findOrFail($id);

            // Kembalikan stok
            foreach ($transaction->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            $transaction->items()->delete();
            $transaction->delete();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
