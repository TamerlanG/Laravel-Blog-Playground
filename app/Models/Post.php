<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id'
    ];

    /**
     * Get the associated user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the associated category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get tags of post
     */
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'posts_tag',
            'post_id',
            'tag_id'
        );
    }
}
