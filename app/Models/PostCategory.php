<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_category';
    protected $fillable = ['name', 'status', 'seo_title', 'seo_description', 'seo_keyword', 'seo_robots', 'slug', 'seo_url'];
}
