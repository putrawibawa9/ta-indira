@extends('layouts.app')
@section('title', 'Panduan Penggunaan')
@section('page-title', 'Panduan Penggunaan')
@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center">Panduan Penggunaan Sistem</h2>
    <div class="mb-8">
        <h3 class="font-semibold text-lg mb-2">Admin</h3>
        <ol class="list-decimal list-inside space-y-1 text-gray-700">
            <li>Masuk ke sistem menggunakan akun yang telah diverifikasi.</li>
            <li>Gunakan menu navigasi di samping untuk mengakses data.</li>
            <li>Klik tombol <span class="font-semibold">"Tambah"</span> untuk menambahkan data baru.</li>
            <li>Gunakan fitur pencarian untuk menemukan data lebih cepat.</li>
            <li>Klik <span class="font-semibold">"Update"</span> untuk mengedit data, dan <span class="font-semibold">"Delete"</span> untuk menghapusnya.</li>
            <li>Pastikan logout setelah selesai menggunakan sistem.</li>
        </ol>
    </div>
    <div>
        <h3 class="font-semibold text-lg mb-2">Karyawan</h3>
        <ol class="list-decimal list-inside space-y-1 text-gray-700">
            <li>Akses Menu Data Barang: Klik pada menu <span class="font-semibold">"Data Barang"</span> di sidebar. Anda dapat menambah, mengedit, dan menghapus data barang (tanpa akses ke harga).</li>
            <li>Akses Menu Data Pelanggan: Klik menu <span class="font-semibold">"Data Pelanggan"</span> untuk melihat pesanan pelanggan dan status pengiriman.</li>
            <li>Panduan Umum: Gunakan tombol <span class="font-semibold">"Tambah"</span>, <span class="font-semibold">"Edit"</span>, atau <span class="font-semibold">"Delete"</span> sesuai kebutuhan. Pastikan data yang dimasukkan sudah lengkap.</li>
        </ol>
    </div>
</div>
@endsection
