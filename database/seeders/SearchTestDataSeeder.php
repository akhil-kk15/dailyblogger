<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Posts;
use App\Models\User;
use App\Models\Comment;

class SearchTestDataSeeder extends Seeder
{
    public function run()
    {
        // First, update existing categories with proper names
        $categoryData = [
            1 => 'Web Development',
            2 => 'Mobile Development', 
            3 => 'Data Science',
            4 => 'Artificial Intelligence'
        ];

        foreach ($categoryData as $id => $name) {
            Category::where('id', $id)->update([
                'name' => $name,
                'slug' => Str::slug($name),
                'is_active' => true
            ]);
        }

        // Add more categories if needed
        $additionalCategories = [
            ['name' => 'DevOps', 'slug' => 'devops', 'is_active' => true],
            ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'is_active' => true],
            ['name' => 'Blockchain', 'slug' => 'blockchain', 'is_active' => true],
            ['name' => 'Cybersecurity', 'slug' => 'cybersecurity', 'is_active' => true],
        ];

        foreach ($additionalCategories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }

        // Update existing tags with proper names and add new ones
        $tagData = [
            'Laravel', 'PHP', 'JavaScript', 'React', 'Vue.js', 
            'Node.js', 'Python', 'Django', 'Flask', 'MySQL',
            'MongoDB', 'PostgreSQL', 'Docker', 'AWS', 'Git',
            'HTML', 'CSS', 'Bootstrap', 'Tailwind', 'API',
            'REST', 'GraphQL', 'Machine Learning', 'TensorFlow',
            'Keras', 'Pandas', 'NumPy', 'Flutter', 'React Native',
            'Swift', 'Kotlin', 'Java', 'C++', 'Go', 'Rust'
        ];

        foreach ($tagData as $index => $tagName) {
            Tag::updateOrCreate(
                ['id' => $index + 1],
                ['tag_name' => $tagName, 'status' => 'active']
            );
        }

        // Get user for posts (admin or first user)
        $user = User::where('usertype', 'admin')->first() ?? User::first();
        
        if (!$user) {
            $this->command->error('No users found. Please create a user first.');
            return;
        }

        // Create diverse posts with different categories and content
        $postsData = [
            [
                'title' => 'Complete Laravel Tutorial for Beginners',
                'description' => 'Learn Laravel from scratch with this comprehensive tutorial. We cover routing, controllers, models, views, and database operations. Perfect for developers starting their Laravel journey.',
                'category_id' => 1, // Web Development
                'post_status' => 'active',
                'tags' => [1, 2, 10] // Laravel, PHP, MySQL
            ],
            [
                'title' => 'Building RESTful APIs with Node.js',
                'description' => 'Master the art of building robust REST APIs using Node.js and Express. Learn about middleware, authentication, error handling, and best practices for API development.',
                'category_id' => 1, // Web Development
                'post_status' => 'active',
                'tags' => [6, 3, 20] // Node.js, JavaScript, API
            ],
            [
                'title' => 'React vs Vue.js: A Complete Comparison',
                'description' => 'Detailed comparison between React and Vue.js frameworks. Explore their strengths, weaknesses, learning curves, and use cases to help you choose the right framework.',
                'category_id' => 1, // Web Development
                'post_status' => 'active',
                'tags' => [4, 5, 3] // React, Vue.js, JavaScript
            ],
            [
                'title' => 'Flutter Mobile App Development Guide',
                'description' => 'Create beautiful cross-platform mobile apps with Flutter. Learn widgets, state management, navigation, and deployment strategies for iOS and Android.',
                'category_id' => 2, // Mobile Development
                'post_status' => 'active',
                'tags' => [28, 30] // Flutter, Kotlin
            ],
            [
                'title' => 'Machine Learning with Python and TensorFlow',
                'description' => 'Dive into machine learning using Python, TensorFlow, and Keras. Build neural networks, train models, and deploy ML solutions in production environments.',
                'category_id' => 3, // Data Science
                'post_status' => 'active',
                'tags' => [7, 23, 24, 25] // Python, Machine Learning, TensorFlow, Keras
            ],
            [
                'title' => 'Data Analysis with Pandas and NumPy',
                'description' => 'Master data manipulation and analysis using Pandas and NumPy libraries. Learn data cleaning, visualization, statistical analysis, and reporting techniques.',
                'category_id' => 3, // Data Science
                'post_status' => 'active',
                'tags' => [7, 26, 27] // Python, Pandas, NumPy
            ],
            [
                'title' => 'Introduction to Artificial Intelligence',
                'description' => 'Explore the fundamentals of AI, machine learning algorithms, neural networks, and their real-world applications in various industries.',
                'category_id' => 4, // Artificial Intelligence
                'post_status' => 'active',
                'tags' => [23, 24] // Machine Learning, TensorFlow
            ],
            [
                'title' => 'Docker and Containerization Best Practices',
                'description' => 'Learn Docker containerization, orchestration with Kubernetes, and deployment strategies. Improve your DevOps skills and application scalability.',
                'category_id' => 5, // DevOps (if exists)
                'post_status' => 'active',
                'tags' => [13, 14] // Docker, AWS
            ],
            [
                'title' => 'Modern CSS Grid and Flexbox Layout',
                'description' => 'Master modern CSS layout techniques using Grid and Flexbox. Create responsive, flexible layouts with clean and maintainable code.',
                'category_id' => 1, // Web Development
                'post_status' => 'active',
                'tags' => [17, 16] // CSS, HTML
            ],
            [
                'title' => 'GraphQL vs REST API Design',
                'description' => 'Compare GraphQL and REST API architectures. Learn when to use each approach and how to implement them effectively in your applications.',
                'category_id' => 1, // Web Development
                'post_status' => 'pending', // Different status for testing
                'tags' => [20, 21, 22] // API, REST, GraphQL
            ],
            [
                'title' => 'Cybersecurity Best Practices for Developers',
                'description' => 'Essential security practices every developer should know. Learn about authentication, authorization, data encryption, and common vulnerabilities.',
                'category_id' => 8, // Cybersecurity (if exists)
                'post_status' => 'active',
                'tags' => [2, 6] // PHP, Node.js
            ],
            [
                'title' => 'UI/UX Design Principles for Developers',
                'description' => 'Bridge the gap between development and design. Learn fundamental UI/UX principles to create better user experiences in your applications.',
                'category_id' => 6, // UI/UX Design (if exists)
                'post_status' => 'active',
                'tags' => [16, 17, 18] // HTML, CSS, Bootstrap
            ]
        ];

        // Clear existing posts and create new ones
        Posts::where('id', '>', 0)->delete();

        foreach ($postsData as $index => $postData) {
            $tags = $postData['tags'];
            unset($postData['tags']);
            
            $post = Posts::create([
                'title' => $postData['title'],
                'description' => $postData['description'],
                'category_id' => $postData['category_id'],
                'post_status' => $postData['post_status'],
                'user_id' => $user->id,
                'image' => null, // You can add images later
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30))
            ]);

            // Attach tags to posts
            if (!empty($tags)) {
                $existingTags = Tag::whereIn('id', $tags)->pluck('id')->toArray();
                $post->tags()->attach($existingTags);
            }

            // Add some comments for testing "most commented" sort
            if ($index % 3 == 0) { // Add comments to every 3rd post
                for ($i = 0; $i < rand(2, 8); $i++) {
                    Comment::create([
                        'user_id' => $user->id,
                        'post_id' => $post->id,
                        'comment' => 'This is a test comment #' . ($i + 1) . ' for testing the most commented sort feature.',
                        'status' => 'approved',
                        'created_at' => now()->subDays(rand(1, 15))
                    ]);
                }
            }
        }

        $this->command->info('Search test data has been created successfully!');
        $this->command->info('Posts: ' . Posts::count());
        $this->command->info('Categories: ' . Category::count());
        $this->command->info('Tags: ' . Tag::count());
        $this->command->info('Comments: ' . Comment::count());
    }
}
