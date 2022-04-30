<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $fillable = [
        'name',
        'slug',
        'rating',
        'price',
        'sale_price',
        'sale_percent',
        'company',
        'product_type',
        'product_line',
        'price_type',
        'shape_type',
        'technology_type',
        'reliability_type',
        'description',
        'feature',
        'avatar_path',
        'show_home',
        'status'
    ];


    public function company(){
        return $this->hasOne(ProductCompany::class, 'id', 'company');
    }

    public function companyName(){
        return $this->hasOne(ProductCompany::class, 'id', 'company');
    }


    public function productType(){
        return $this->hasOne(ProductType::class, 'id', 'product_type');
    }

    public function productLine(){
        return $this->hasOne(ProductLine::class, 'id', 'product_line');
    }

    public function priceType() {
        return $this->hasOne(ProductPrice::class, 'id', 'price_type');
    }

    public function shapeType() {
        return $this->hasOne(ProductShape::class, 'id', 'price_type');
    }

    public function technologyType() {
        return $this->hasOne(ProductShape::class, 'id', 'technology_type');
    }

    public function reliabilityType() {
        return $this->hasOne(ProductReliability::class, 'id', 'reliability_type');
    }

    public function productImage(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
