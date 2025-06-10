<?php

// Simple test to verify block/unblock functionality
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Posts;

echo "=== Block/Unblock Functionality Test ===\n";

// Test 1: User Model isBlocked() method
echo "\nTest 1: User Model isBlocked() method\n";
echo "------------------------------------\n";

$testUser = User::where('email', 'afreed@mail.com')->first();
if ($testUser) {
    echo "User: {$testUser->name} ({$testUser->email})\n";
    echo "Usertype: {$testUser->usertype}\n";
    echo "isBlocked(): " . ($testUser->isBlocked() ? 'Yes' : 'No') . "\n";
    
    if ($testUser->blocked_at) {
        echo "Blocked at: {$testUser->blocked_at}\n";
        echo "Blocked reason: {$testUser->blocked_reason}\n";
    }
}

// Test 2: Posts filtering scopes
echo "\nTest 2: Posts filtering scopes\n";
echo "------------------------------\n";

$totalPosts = Posts::count();
$publicPosts = Posts::public()->count();
$nonBlockedUserPosts = Posts::fromNonBlockedUsers()->count();

echo "Total posts in database: {$totalPosts}\n";
echo "Public posts (active + non-blocked users): {$publicPosts}\n";
echo "Posts from non-blocked users: {$nonBlockedUserPosts}\n";

// Test 3: Check if blocked users have posts that are filtered
echo "\nTest 3: Blocked user posts filtering\n";
echo "------------------------------------\n";

$blockedUsers = User::where('usertype', 'blocked')->get();
echo "Blocked users found: " . $blockedUsers->count() . "\n";

foreach ($blockedUsers as $blockedUser) {
    $userPosts = Posts::where('user_id', $blockedUser->id)->count();
    $userPublicPosts = Posts::where('user_id', $blockedUser->id)->public()->count();
    
    echo "User: {$blockedUser->name}\n";
    echo "  - Total posts: {$userPosts}\n";
    echo "  - Public visible posts: {$userPublicPosts}\n";
}

// Test 4: Check middleware alias registration
echo "\nTest 4: Middleware Registration\n";
echo "-------------------------------\n";

try {
    $middleware = app('router')->getMiddleware();
    if (isset($middleware['check.blocked'])) {
        echo "✓ check.blocked middleware is registered\n";
        echo "  Class: " . $middleware['check.blocked'] . "\n";
    } else {
        echo "✗ check.blocked middleware NOT registered\n";
    }
} catch (Exception $e) {
    echo "Error checking middleware: " . $e->getMessage() . "\n";
}

echo "\n=== Test Complete ===\n";
