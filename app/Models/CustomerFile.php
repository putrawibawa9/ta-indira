<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id','file_name','file_path','description','uploaded_by',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function uploader() {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
