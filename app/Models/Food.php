<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable=['title','slug','summary','parent_cat_id','child_cat_id','price','discount','status','photo','stock', 'restaurant_id'];

    use HasFactory;
    public function child_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    public function parent_cat_info(){
        return $this->hasOne('App\Models\MajorCategory','id','parent_cat_id');
    }
}
