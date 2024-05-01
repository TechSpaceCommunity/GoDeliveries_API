<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable=['title','slug', 'product_id','summary','photo','status','restaurant_id'];
    use HasFactory;
}
