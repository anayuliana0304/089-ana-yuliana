<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category_id', 'stock'];

    public function reduceStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }

    public function details(){
        return $this->hasMany(TransactionDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
