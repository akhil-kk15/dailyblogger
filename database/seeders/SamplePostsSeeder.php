<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\User;

class SamplePostsSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@dailyblogger.com')->first();
        
        if ($admin) {
            Posts::create([
                'title' => 'Welcome to Daily Blogger',
                'description' => 'This is our first post on the Daily Blogger platform. We are excited to share amazing content with our community. This platform allows users to create, share, and manage blog posts with an amazing admin panel.',
                'name' => $admin->name,
                'user_id' => $admin->id,
                'usertype' => $admin->usertype,
                'post_status' => 'active',
            ]);

            Posts::create([
                'title' => 'Getting Started with Blogging',
                'description' => 'Blogging is a great way to share your thoughts and ideas with the world. In this post, we will cover the basics of blogging and how to get started with creating engaging content.',
                'name' => $admin->name,
                'user_id' => $admin->id,
                'usertype' => $admin->usertype,
                'post_status' => 'pending',
            ]);

            Posts::create([
                'title' => 'Sample Rejected Post',
                'description' => 'This is a sample post that has been rejected for testing purposes. It helps demonstrate the post moderation system.',
                'name' => $admin->name,
                'user_id' => $admin->id,
                'usertype' => $admin->usertype,
                'post_status' => 'rejected',
                'rejection_reason' => 'This is a test rejection for demonstration purposes.',
            ]);
        }
    }
}
