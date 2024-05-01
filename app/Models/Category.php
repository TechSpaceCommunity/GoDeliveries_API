<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['title','slug', 'parent_cat_id','summary','photo','status','restaurant_id'];
    use HasFactory;
}
