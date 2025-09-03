<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','name','phone','address','notes','status','created_by',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function files() {
        return $this->hasMany(CustomerFile::class);
    }
}
