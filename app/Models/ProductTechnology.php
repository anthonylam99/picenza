<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTechnology extends Model
{
    use HasFactory;

    protected $table = 'product_technology';

    protected $fillable = ['name'];
}
