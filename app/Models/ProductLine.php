<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    use HasFactory;

    protected $table = 'product_line';

    protected $fillable = [
        'name',
        'company_id',
        'name',
        'avatar',
        'status',
        'slug',
        'seo_url',
        'url',
        'description',
        'posts',
        'parent'
    ];

    public function company()
    {
        return $this->hasOne(ProductCompany::class, 'id', 'company_id');
    }

    public function feature()
    {
        return $this->hasMany(ProductFeature::class, 'product_line', 'id');
    }

}
