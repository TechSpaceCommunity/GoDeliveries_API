<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    protected $fillable = [
        'username',
        'name',
        'number',
        'zone',
        'password',
        'rider_image',
        'bike_image'
    ];
    use HasFactory;
}
