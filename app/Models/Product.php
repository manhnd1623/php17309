<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const ACTIVE = 1;

    const INACTIVE = 0;

    protected $fillable = [
        'name',
        'price',
        'price_sale',
        'img',
        'is_active',
        'describe',
    ];
}
