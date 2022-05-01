<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_category';
    protected $fillable = ['name', 'id_category_parent','avatar', 'url', 'description', 'favourite', 'status', 'slug'];

    public function feature(){
        return $this->hasOne(ProductFeature::class, 'id' ,'id_category_parent');
    }
}
