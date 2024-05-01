<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=['customer_id','product_id','order_id','quantity','amount','price','status'];

    public function product()
    {
        return $this->belongsTo(Food::class, 'product_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
