<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category', 'description', 'price', 'compare_price', 'cost', 'image', 'active', 'featured'];
    protected $casts = ['active' => 'boolean', 'featured' => 'boolean', 'price' => 'integer', 'cost' => 'integer', 'compare_price' => 'integer'];
}
