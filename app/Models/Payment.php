<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id','payment_date','amount','method','received_by','notes',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'received_by');
    }
}
