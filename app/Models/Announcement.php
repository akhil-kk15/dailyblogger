<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
        'priority',
        'type',
        'is_active',
        'created_by',
        'expires_at'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    // Scope for active announcements
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }
    
    // Scope for priority filtering
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
    
    // Scope for type filtering
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }
    
    // Get priority badge color
    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'low' => '#28a745',
            'normal' => '#007bff',
            'high' => '#ffc107',
            'urgent' => '#dc3545',
            default => '#6c757d'
        };
    }
    
    // Get type badge color
    public function getTypeColorAttribute()
    {
        return match($this->type) {
            'general' => '#6c757d',
            'maintenance' => '#ffc107',
            'feature' => '#28a745',
            'important' => '#dc3545',
            default => '#007bff'
        };
    }
}
