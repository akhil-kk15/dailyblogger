<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'post_id',
        'comment_id',
        'is_read'
    ];
    
    protected $casts = [
        'is_read' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    
    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
    
    // Scope for user notifications
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
