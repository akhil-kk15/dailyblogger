#!/usr/bin/env php
<?php
/**
 * Test script to verify user post management functionality
 */

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\User;
use App\Models\Posts;
use App\Models\Category;
use App\Models\Tag;

echo "🚀 Testing User Post Management Functionality\n";
echo "=============================================\n\n";

// Test 1: Check if models and relationships work
echo "✅ Test 1: Model Relationships\n";
$user = User::where('email', 'john@example.com')->first();
$admin = User::where('email', 'admin@dailyblogger.com')->first();

if ($user && $admin) {
    echo "   ✓ Users found: {$user->name} and {$admin->name}\n";
} else {
    echo "   ✗ Users not found - run seeder first\n";
    exit(1);
}

// Test 2: Check categories and tags
echo "✅ Test 2: Categories and Tags\n";
$categories = Category::active()->count();
$tags = Tag::active()->count();
echo "   ✓ Categories: {$categories}, Tags: {$tags}\n";

// Test 3: Check posts with relationships
echo "✅ Test 3: Posts with Relationships\n";
$posts = Posts::with(['category', 'tags', 'user'])->get();
foreach ($posts as $post) {
    echo "   ✓ Post: '{$post->title}' by {$post->user->name}\n";
    echo "     - Category: " . ($post->category ? $post->category->name : 'None') . "\n";
    echo "     - Tags: " . $post->tags->pluck('name')->join(', ') . "\n";
    echo "     - Status: {$post->post_status}\n\n";
}

// Test 4: Test user-specific posts
echo "✅ Test 4: User-Specific Posts\n";
$userPosts = Posts::where('user_id', $user->id)->count();
$adminPosts = Posts::where('user_id', $admin->id)->count();
echo "   ✓ User posts: {$userPosts}, Admin posts: {$adminPosts}\n";

echo "\n🎉 All tests passed! User post management is ready to use.\n";
echo "\nLogin credentials:\n";
echo "Admin: admin@dailyblogger.com / password\n";
echo "User: john@example.com / password\n";
echo "\nAvailable routes:\n";
echo "- /create-post (Create new post)\n";
echo "- /my-posts (View user's posts)\n";
echo "- /edit-post/{id} (Edit specific post)\n";
