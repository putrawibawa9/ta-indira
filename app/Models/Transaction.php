<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'total',
        'payment_method',
        'dp',
        'status',
    ];

    // Relasi: transaksi punya customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi: transaksi punya banyak item (barang)
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
