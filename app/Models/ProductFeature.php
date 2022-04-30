<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;
    protected $table = 'product_feature';
    protected $fillable = [
        'name', 'product_type'
    ];

    public function productType(){
        return $this->hasOne(ProductType::class, 'id', 'product_type');
    }
}
