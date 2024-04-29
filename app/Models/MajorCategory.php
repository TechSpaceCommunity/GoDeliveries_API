<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorCategory extends Model
{
    protected $fillable=['title','slug','summary','photo','status'];
    use HasFactory;
}
