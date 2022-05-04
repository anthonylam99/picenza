<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;
    protected $table = 'product_feature';
    protected $fillable = [
        'name', 'product_type', 'avatar', 'favourite', 'description', 'product_line'
    ];

    public function productType(){
        return $this->hasOne(ProductType::class, 'id', 'product_type');
    }

    public function sub(){
        return $this->hasMany(SubCategory::class, 'id_category_parent', 'id');
    }

    public function line(){
        return $this->hasOne(ProductLine::class, 'id', 'product_line');
    }
}
