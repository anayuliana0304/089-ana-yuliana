<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaction', 
        'user_id', 
        'customer_id', 
        'date', 
        'grand_total', 
        'cash',
        'change',
        'status'
    ];

    public function details(){
        return $this->hasMany(TransactionDetail::class);

    }

    public function delivery(){
        return $this->hasOne(Delivery::class);

    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
