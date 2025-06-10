<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Posts;
use App\Models\Comment;

class NotificationService
{
    public static function createPostApprovedNotification($post)
    {
        return Notification::create([
            'user_id' => $post->user_id,
            'type' => 'post_approved',
            'title' => 'Post Approved!',
            'message' => "Your post '{$post->title}' has been approved and is now live.",
            'post_id' => $post->id,
        ]);
    }
    
    public static function createPostRejectedNotification($post)
    {
        $message = "Your post '{$post->title}' has been rejected.";
        if ($post->rejection_reason) {
            $message .= " Reason: {$post->rejection_reason}";
        }
        
        return Notification::create([
            'user_id' => $post->user_id,
            'type' => 'post_rejected',
            'title' => 'Post Rejected',
            'message' => $message,
            'post_id' => $post->id,
        ]);
    }
    
    public static function createNewCommentNotification($comment, $post)
    {
        // Don't notify if the post author commented on their own post
        if ($post->user_id == $comment->user_id) {
            return null;
        }
        
        return Notification::create([
            'user_id' => $post->user_id,
            'type' => 'new_comment',
            'title' => 'New Comment!',
            'message' => "{$comment->user_name} commented on your post '{$post->title}': " . substr($comment->comment, 0, 50) . (strlen($comment->comment) > 50 ? '...' : ''),
            'post_id' => $post->id,
            'comment_id' => $comment->id,
        ]);
    }
    
    public static function getUnreadCount($userId)
    {
        return Notification::forUser($userId)->unread()->count();
    }
    
    public static function getRecentNotifications($userId, $limit = 10)
    {
        return Notification::forUser($userId)
                          ->orderBy('created_at', 'desc')
                          ->limit($limit)
                          ->get();
    }
    
    public static function markAsRead($notificationIds)
    {
        return Notification::whereIn('id', $notificationIds)->update(['is_read' => true]);
    }
    
    public static function markAllAsRead($userId)
    {
        return Notification::forUser($userId)->unread()->update(['is_read' => true]);
    }
    
    public static function createAnnouncementNotification($userId, $announcement)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => 'announcement',
            'title' => 'New Announcement: ' . $announcement->title,
            'message' => substr($announcement->content, 0, 150) . (strlen($announcement->content) > 150 ? '...' : ''),
            'post_id' => null, // announcements don't have post_id
            'comment_id' => null,
        ]);
    }
}
