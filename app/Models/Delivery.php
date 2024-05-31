<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 
        'method',
        'date', 
        'time',
        'address'  
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
