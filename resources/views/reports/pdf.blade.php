<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Sistem</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 5px; border-bottom: 1px solid #000; padding-bottom: 3px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f3f3f3; }
        .footer { position: fixed; bottom: 0; text-align: center; font-size: 10px; }
    </style>
</head>
<body>
    <h1>Laporan Sistem Manajemen</h1>
    @if($from && $to)
        <p>Periode: {{ $from }} s/d {{ $to }}</p>
    @endif

    @foreach($reports as $type => $data)
        <h2>Laporan {{ ucfirst($type) }}</h2>
        <table>
            <thead>
                @if($type == 'customers')
                    <tr><th>No</th><th>Nama</th><th>Kontak</th><th>Email</th><th>Alamat</th></tr>
                @elseif($type == 'products')
                    <tr><th>No</th><th>Nama Produk</th><th>Supplier</th><th>Stok</th><th>Harga</th></tr>
                @elseif($type == 'suppliers')
                    <tr><th>No</th><th>Nama Supplier</th><th>Kontak</th><th>Email</th><th>Total Pembelian</th></tr>
                @elseif($type == 'transactions')
                    <tr><th>No</th><th>Pelanggan</th><th>Tanggal</th><th>Total</th><th>Status</th></tr>
                @endif
            </thead>
            <tbody>
                @forelse($data as $i => $item)
                    <tr>
                        @if($type == 'customers')
                            <td>{{ $i+1 }}</td><td>{{ $item->name }}</td><td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td><td>{{ $item->address }}</td>
                        @elseif($type == 'products')
                            <td>{{ $i+1 }}</td><td>{{ $item->name }}</td><td>{{ $item->supplier->name ?? '-' }}</td>
                            <td>{{ $item->stock }}</td><td>Rp {{ number_format($item->price,0,',','.') }}</td>
                        @elseif($type == 'suppliers')
                            <td>{{ $i+1 }}</td><td>{{ $item->name }}</td><td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td><td>Rp {{ number_format($item->total_purchase,0,',','.') }}</td>
                        @elseif($type == 'transactions')
                            <td>{{ $i+1 }}</td><td>{{ $item->customer->name ?? '-' }}</td>
                            <td>{{ $item->date }}</td><td>Rp {{ number_format($item->total,0,',','.') }}</td>
                            <td>{{ ucfirst($item->status) }}</td>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    @endforeach

    <div class="footer">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </div>
</body>
</html>
