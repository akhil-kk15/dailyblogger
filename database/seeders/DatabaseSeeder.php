<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@dailyblogger.com',
            'password' => Hash::make('admin123'),
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Test Users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Latest tech news and updates'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Lifestyle and wellness content'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business and entrepreneurship'],
            ['name' => 'Travel', 'slug' => 'travel', 'description' => 'Travel guides and experiences'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Tags
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Tutorial', 'slug' => 'tutorial'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
