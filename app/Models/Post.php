<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = [
        'title', 'slug', 'content', 'tag', 'url', 'seo_url', 'category', 'avatar', 'status', 'seo_title',
        'seo_description', 'seo_keyword', 'seo_robots'
    ];
}
