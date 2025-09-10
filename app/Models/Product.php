<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'sell_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function stocks() {
        return $this->hasMany(ProductStock::class);
    }

    public function saleItems() {
        return $this->hasMany(SaleItem::class);
    }
}
