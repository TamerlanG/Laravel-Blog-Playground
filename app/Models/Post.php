<?php

namespace App\Models;

use App\Utilities\FilterBuilder;
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
     * Method used in filtration
     */
    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\PostFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }

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
            'posts_tags',
            'post_id',
            'tag_id'
        );
    }
}
