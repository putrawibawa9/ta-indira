<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Invoice</th>
                <th>Pelanggan</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sale->sale_date->format('d-m-Y') }}</td>
                <td>{{ $sale->invoice_no }}</td>
                <td>{{ $sale->customer->name ?? '-' }}</td>
                <td>{{ $sale->user->name ?? '-' }}</td>
                <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                <td>{{ $sale->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
