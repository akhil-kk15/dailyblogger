<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Posts;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample tags
        $tags = [
            ['name' => 'Technology', 'is_active' => true],
            ['name' => 'Programming', 'is_active' => true],
            ['name' => 'Web Development', 'is_active' => true],
            ['name' => 'Laravel', 'is_active' => true],
            ['name' => 'Tutorial', 'is_active' => true],
        ];

        foreach ($tags as $tagData) {
            $tag = Tag::firstOrCreate(
                ['name' => $tagData['name']],
                $tagData
            );
            
            echo "Created tag: " . $tag->name . "\n";
        }

        // Attach tags to existing posts to test the pivot table
        $posts = Posts::all();
        $allTags = Tag::all();

        foreach ($posts as $post) {
            // Randomly assign 1-3 tags to each post
            $randomTags = $allTags->random(rand(1, 3));
            $post->tags()->sync($randomTags->pluck('id')->toArray());
            
            echo "Attached " . $randomTags->count() . " tags to post: " . $post->title . "\n";
        }
    }
}
