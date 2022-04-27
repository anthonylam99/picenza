<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'page_image';

    protected $fillable = [
        'page_id', 'image_path', 'tag','title', 'content', 'url'
    ];
}
