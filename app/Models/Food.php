<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable=['title','slug','summary','cat_id','price','discount','status','photo','stock', 'restaurant_id'];

    use HasFactory;
    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    
}
