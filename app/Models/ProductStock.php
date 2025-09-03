<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','location','qty'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
