<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;
<<<<<<< HEAD
    
=======

>>>>>>> pre-release
    protected $fillable = [
        'title',
        'description',
        'image',
        'name',
        'user_id',
<<<<<<< HEAD
        'usertype',
        'post_status',
        'rejection_reason',
        'category_id'
    ];
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    
=======
        'category_id',
        'post_status',
        'usertype',
        'rejection_reason',
        'is_featured',
        'featured_at'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'featured_at' => 'datetime',
    ];

>>>>>>> pre-release
    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD
    
=======

>>>>>>> pre-release
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
<<<<<<< HEAD
    
=======

>>>>>>> pre-release
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
<<<<<<< HEAD
=======

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    // Scope for featured posts
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for active featured posts
    public function scopeActiveFeatured($query)
    {
        return $query->where('is_featured', true)->where('post_status', 'active');
    }
>>>>>>> pre-release
}
