<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShape extends Model
{
    use HasFactory;

    protected $table = 'product_shape';

    protected $fillable = ['name'];
}
