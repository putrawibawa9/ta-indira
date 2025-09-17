<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'supplier_id',
        'image',
    ];

    // Relasi: Produk dimiliki oleh supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi: Produk bisa ada di banyak transaksi
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
