<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'product_type';

    protected $fillable = [
        'name',
        'company_id',
        'product_line_id'
    ];

    public function company(){
        return $this->hasOne(ProductCompany::class, 'id', 'company_id');
    }

    public function productLine(){
        return $this->hasOne(ProductLine::class, 'id', 'product_line_id');
    }
}
