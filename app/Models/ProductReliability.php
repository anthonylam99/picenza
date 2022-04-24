<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReliability extends Model
{
    use HasFactory;

    protected $table = 'product_reliability';

    protected $fillable = ['name'];
}
