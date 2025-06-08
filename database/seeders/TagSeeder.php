<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel', 'color' => '#ff2d20'],
            ['name' => 'PHP', 'slug' => 'php', 'color' => '#777bb4'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'color' => '#f7df1e'],
            ['name' => 'Vue.js', 'slug' => 'vue-js', 'color' => '#4fc08d'],
            ['name' => 'React', 'slug' => 'react', 'color' => '#61dafb'],
            ['name' => 'HTML', 'slug' => 'html', 'color' => '#e34f26'],
            ['name' => 'CSS', 'slug' => 'css', 'color' => '#1572b6'],
            ['name' => 'Bootstrap', 'slug' => 'bootstrap', 'color' => '#7952b3'],
            ['name' => 'MySQL', 'slug' => 'mysql', 'color' => '#4479a1'],
            ['name' => 'API', 'slug' => 'api', 'color' => '#009688'],
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'color' => '#795548'],
            ['name' => 'Tips', 'slug' => 'tips', 'color' => '#ff9800'],
            ['name' => 'Review', 'slug' => 'review', 'color' => '#3f51b5'],
            ['name' => 'Guide', 'slug' => 'guide', 'color' => '#607d8b'],
            ['name' => 'News', 'slug' => 'news', 'color' => '#f44336'],
            ['name' => 'Opinion', 'slug' => 'opinion', 'color' => '#9c27b0'],
            ['name' => 'DIY', 'slug' => 'diy', 'color' => '#4caf50'],
            ['name' => 'Recipe', 'slug' => 'recipe', 'color' => '#ff5722'],
            ['name' => 'Adventure', 'slug' => 'adventure', 'color' => '#2196f3'],
            ['name' => 'Photography', 'slug' => 'photography', 'color' => '#673ab7'],
            ['name' => 'Art', 'slug' => 'art', 'color' => '#e91e63'],
            ['name' => 'Music', 'slug' => 'music', 'color' => '#9e9e9e'],
            ['name' => 'Fitness', 'slug' => 'fitness', 'color' => '#ff9800'],
            ['name' => 'Productivity', 'slug' => 'productivity', 'color' => '#607d8b'],
            ['name' => 'Marketing', 'slug' => 'marketing', 'color' => '#ff5722']
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::create($tag);
        }
    }
}
