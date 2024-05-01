<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'restaurants'
    ];
}
