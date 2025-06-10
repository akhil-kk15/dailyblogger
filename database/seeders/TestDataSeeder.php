<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Posts;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users (only if they don't exist)
        $admin = User::firstOrCreate(
            ['email' => 'admin@dailyblogger.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'usertype' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'usertype' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Create categories (only if they don't exist)
        $techCategory = Category::firstOrCreate(
            ['slug' => 'technology'],
            [
                'name' => 'Technology',
                'description' => 'Latest technology news and updates',
                'color' => '#007bff',
                'is_active' => true
            ]
        );

        $lifestyleCategory = Category::firstOrCreate(
            ['slug' => 'lifestyle'],
            [
                'name' => 'Lifestyle',
                'description' => 'Lifestyle and wellness content',
                'color' => '#28a745',
                'is_active' => true
            ]
        );

        // Create tags (only if they don't exist)
        $webDevTag = Tag::firstOrCreate(
            ['slug' => 'web-development'],
            [
                'name' => 'Web Development',
                'color' => '#17a2b8',
                'is_active' => true
            ]
        );

        $laravelTag = Tag::firstOrCreate(
            ['slug' => 'laravel'],
            [
                'name' => 'Laravel',
                'color' => '#dc3545',
                'is_active' => true
            ]
        );

        $phpTag = Tag::firstOrCreate(
            ['slug' => 'php'],
            [
                'name' => 'PHP',
                'color' => '#6f42c1',
                'is_active' => true
            ]
        );

        // Create sample posts
        $post1 = Posts::create([
            'title' => 'Getting Started with Laravel',
            'description' => 'Laravel is a powerful PHP framework that makes web development a breeze. In this comprehensive guide, we will explore the fundamentals of Laravel and learn how to build modern web applications. From routing to eloquent ORM, we will cover all the essential concepts that every Laravel developer should know.',
            'name' => $admin->name,
            'user_id' => $admin->id,
            'usertype' => $admin->usertype,
            'category_id' => $techCategory->id,
            'post_status' => 'active',
        ]);

        $post2 = Posts::create([
            'title' => 'Building Modern Web Applications',
            'description' => 'Modern web development requires a solid understanding of various technologies and best practices. In this article, we will discuss the latest trends in web development and explore how to create scalable, maintainable applications that provide an excellent user experience.',
            'name' => $user->name,
            'user_id' => $user->id,
            'usertype' => $user->usertype,
            'category_id' => $techCategory->id,
            'post_status' => 'pending',
        ]);

        // Attach tags to posts
        $post1->tags()->attach([$webDevTag->id, $laravelTag->id, $phpTag->id]);
        $post2->tags()->attach([$webDevTag->id]);

        // Create sample comments
        Comment::create([
            'post_id' => $post1->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'comment' => 'Great article! Laravel really is an amazing framework. I especially loved the section about Eloquent ORM. Thanks for sharing this comprehensive guide.',
        ]);

        Comment::create([
            'post_id' => $post1->id,
            'user_id' => $admin->id,
            'user_name' => $admin->name,
            'comment' => 'Thank you for the feedback! Laravel has definitely revolutionized PHP development. Stay tuned for more advanced tutorials.',
        ]);

        Comment::create([
            'post_id' => $post1->id,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'comment' => 'Looking forward to more content like this. Could you cover testing in Laravel next?',
        ]);

        echo "Test data seeded successfully!\n";
        echo "Admin login: admin@dailyblogger.com / password\n";
        echo "User login: john@example.com / password\n";
    }
}
