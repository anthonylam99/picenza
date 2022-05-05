<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostCategory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $casts = [
        'category' => 'array',
    ];
    protected $fillable = [
        'title', 'slug', 'content', 'tag', 'url', 'seo_url', 'category', 'avatar', 'status', 'seo_title',
        'seo_description', 'seo_keyword', 'seo_robots', 'description'
    ];

    protected $appends = ['category_name'];

    public function imageHome(){
        return $this->hasMany(PageImage::class, 'post_id' ,'id');
    }

    /**
     * Get custom category attributes
     *
     * @return void
     */
    public function getCategoryNameAttribute()
    {
        $aryCategories = PostCategory::whereIn('id', $this->category)->select('name')->pluck('name')->toArray();

        return implode(',', $aryCategories);
    }
}
