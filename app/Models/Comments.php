<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Product};

class Comments extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $casts = [
        'publish_at' => 'datetime',
        'file' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'title',
        'body',
        'rating',
        'count_quality',
        'count_worth',
        'count_like',
        'count_dislike',
        'publish_at',
        'file',
        'address',
        'gender',
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function product()
    {
        return $this->BelongsTo(Product::class);
    }
}
