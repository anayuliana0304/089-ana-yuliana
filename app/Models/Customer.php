<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'gender', 'phone'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
