<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_image';

    protected $fillable = [
        'product_id',
        'image_path',
        'color',
        'price'
    ];

    public function color(){
        return $this->hasOne(ProductColor::class, 'id', 'color');
    }

    /**
     * Get the product that owns the ProductImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
