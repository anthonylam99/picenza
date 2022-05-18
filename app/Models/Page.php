<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'page';

    protected $fillable = ['name', 'slug', 'url', 'content', 'seo_url', 'seo_robots','seo_description', 'seo_keyword','seo_title', 'sub_section'];
}
