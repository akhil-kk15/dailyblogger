<?php

/**
 * Test script to verify notification navbar functionality
 * Run this script to test if notification system is working
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use App\Models\User;
use App\Models\Notification;
use App\Services\NotificationService;

echo "Testing Notification Navbar Functionality\n";
echo "=========================================\n\n";

try {
    // Test 1: Check if NotificationService exists and methods are callable
    echo "1. Testing NotificationService...\n";
    
    if (class_exists('App\Services\NotificationService')) {
        echo "   ✓ NotificationService class exists\n";
        
        if (method_exists(NotificationService::class, 'getUnreadCount')) {
            echo "   ✓ getUnreadCount method exists\n";
        } else {
            echo "   ✗ getUnreadCount method missing\n";
        }
        
        if (method_exists(NotificationService::class, 'markAllAsRead')) {
            echo "   ✓ markAllAsRead method exists\n";
        } else {
            echo "   ✗ markAllAsRead method missing\n";
        }
    } else {
        echo "   ✗ NotificationService class not found\n";
    }
    
    // Test 2: Check if Notification model has required scopes
    echo "\n2. Testing Notification model scopes...\n";
    
    $notification = new Notification();
    
    if (method_exists($notification, 'scopeUnread')) {
        echo "   ✓ scopeUnread exists\n";
    } else {
        echo "   ✗ scopeUnread missing\n";
    }
    
    if (method_exists($notification, 'scopeForUser')) {
        echo "   ✓ scopeForUser exists\n";
    } else {
        echo "   ✗ scopeForUser missing\n";
    }
    
    // Test 3: Check database connection and table existence
    echo "\n3. Testing database structure...\n";
    
    try {
        $hasNotificationsTable = \Illuminate\Support\Facades\Schema::hasTable('notifications');
        if ($hasNotificationsTable) {
            echo "   ✓ notifications table exists\n";
            
            $columns = \Illuminate\Support\Facades\Schema::getColumnListing('notifications');
            $requiredColumns = ['user_id', 'type', 'title', 'message', 'is_read'];
            
            foreach ($requiredColumns as $column) {
                if (in_array($column, $columns)) {
                    echo "   ✓ Column '$column' exists\n";
                } else {
                    echo "   ✗ Column '$column' missing\n";
                }
            }
        } else {
            echo "   ✗ notifications table does not exist\n";
        }
    } catch (Exception $e) {
        echo "   ✗ Database connection error: " . $e->getMessage() . "\n";
    }
    
    echo "\n4. Testing routes...\n";
    
    // Check if routes are registered
    $routes = \Illuminate\Support\Facades\Route::getRoutes();
    $notificationRoutes = ['home.notifications', 'notifications.mark_read', 'notifications.mark_all_read'];
    
    foreach ($notificationRoutes as $routeName) {
        if ($routes->hasNamedRoute($routeName)) {
            echo "   ✓ Route '$routeName' is registered\n";
        } else {
            echo "   ✗ Route '$routeName' is missing\n";
        }
    }
    
    echo "\n✅ Notification navbar setup test completed!\n";
    echo "\nNext steps:\n";
    echo "1. Start your Laravel server: php artisan serve\n";
    echo "2. Login to your application\n";
    echo "3. Check the navbar for the notification bell icon\n";
    echo "4. Create some test notifications to see the badge count\n";
    
} catch (Exception $e) {
    echo "❌ Error during testing: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
