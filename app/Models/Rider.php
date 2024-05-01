<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    protected $fillable = [
        'email',
        'name',
        'number',
        'id_number',
        'zone',
        'status',
        'password',
        'rider_image',
        'bike_image',
        'id_image'
    ];
    use HasFactory;
}
