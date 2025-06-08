<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest technology news, reviews, and tutorials',
                'color' => '#007bff',
                'is_active' => true
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Tips and insights about modern lifestyle',
                'color' => '#28a745',
                'is_active' => true
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel guides, tips, and adventures',
                'color' => '#17a2b8',
                'is_active' => true
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => 'Recipes, restaurant reviews, and culinary adventures',
                'color' => '#ffc107',
                'is_active' => true
            ],
            [
                'name' => 'Health & Fitness',
                'slug' => 'health-fitness',
                'description' => 'Health tips, workout routines, and wellness advice',
                'color' => '#dc3545',
                'is_active' => true
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Educational content, tutorials, and learning resources',
                'color' => '#6f42c1',
                'is_active' => true
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business insights, entrepreneurship, and career advice',
                'color' => '#fd7e14',
                'is_active' => true
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Movies, music, games, and pop culture',
                'color' => '#e83e8c',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
