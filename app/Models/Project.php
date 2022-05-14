<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';
    protected $casts = [
        'category' => 'array',
    ];
    protected $fillable = [
        'title', 'slug', 'content', 'tag', 'url', 'seo_url', 'category', 'avatar', 'status', 'seo_title',
        'seo_description', 'seo_keyword', 'seo_robots', 'description', 'tagged'
    ];
    protected $appends = ['category_name'];

    /**
     * Get custom category attributes
     *
     * @return void
     */
    public function getCategoryNameAttribute()
    {
        $aryCategories = ProjectCategory::whereIn('id', $this->category)->select('name')->pluck('name')->toArray();

        return implode(',', $aryCategories);
    }
}
