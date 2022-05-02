<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    protected $table= 'page_tag';
    protected $fillable = [
        'page_tag', 'posts'
    ];

    public function image(){
        return $this->hasMany(PageImage::class, 'tag', 'page_tag');
    }
}
