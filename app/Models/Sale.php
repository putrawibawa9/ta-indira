<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no','sale_date','customer_id','user_id','payment_method',
        'subtotal','discount_total','total','paid_amount','balance','due_date','status','notes',
    ];

    protected $casts = [
        'sale_date' => 'datetime',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_total' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(SaleItem::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
