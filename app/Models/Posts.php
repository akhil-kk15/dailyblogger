<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'name',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

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

    // Scope for posts from non-blocked users
    public function scopeFromNonBlockedUsers($query)
    {
        return $query->whereHas('user', function($q) {
            $q->where('usertype', '!=', 'blocked');
        });
    }

    // Scope for public posts (active status and from non-blocked users)
    public function scopePublic($query)
    {
        return $query->where('post_status', 'active')->fromNonBlockedUsers();
    }
}
