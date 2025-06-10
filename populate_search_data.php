<?php

// Update categories with proper names
$categoryData = [
    1 => 'Web Development',
    2 => 'Mobile Development', 
    3 => 'Data Science',
    4 => 'Artificial Intelligence'
];

foreach ($categoryData as $id => $name) {
    App\Models\Category::where('id', $id)->update([
        'name' => $name,
        'slug' => Str::slug($name),
        'is_active' => true
    ]);
}

// Add more categories
$additionalCategories = [
    ['name' => 'DevOps', 'slug' => 'devops', 'is_active' => true],
    ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'is_active' => true],
    ['name' => 'Blockchain', 'slug' => 'blockchain', 'is_active' => true],
    ['name' => 'Cybersecurity', 'slug' => 'cybersecurity', 'is_active' => true],
];

foreach ($additionalCategories as $category) {
    App\Models\Category::firstOrCreate(['name' => $category['name']], $category);
}

// Update tags with proper names
$tagData = [
    1 => 'Laravel', 2 => 'PHP', 3 => 'JavaScript', 4 => 'React', 5 => 'Vue.js', 
    6 => 'Node.js', 7 => 'Python', 8 => 'Django', 9 => 'Flask', 10 => 'MySQL',
    11 => 'MongoDB', 12 => 'PostgreSQL', 13 => 'Docker', 14 => 'AWS', 15 => 'Git',
    16 => 'HTML', 17 => 'CSS', 18 => 'Bootstrap', 19 => 'Tailwind', 20 => 'API'
];

foreach ($tagData as $id => $tagName) {
    App\Models\Tag::updateOrCreate(
        ['id' => $id],
        ['name' => $tagName, 'slug' => Str::slug($tagName), 'is_active' => true]
    );
}

// Get user for posts
$user = App\Models\User::where('usertype', 'admin')->first() ?? App\Models\User::first();

if (!$user) {
    echo "No users found. Please create a user first.\n";
    return;
}

// Clear existing posts and create new ones
App\Models\Posts::where('id', '>', 0)->delete();

$postsData = [
    [
        'title' => 'Complete Laravel Tutorial for Beginners',
        'description' => 'Learn Laravel from scratch with this comprehensive tutorial. We cover routing, controllers, models, views, and database operations. Perfect for developers starting their Laravel journey.',
        'category_id' => 1,
        'post_status' => 'active',
        'tags' => [1, 2, 10]
    ],
    [
        'title' => 'Building RESTful APIs with Node.js',
        'description' => 'Master the art of building robust REST APIs using Node.js and Express. Learn about middleware, authentication, error handling, and best practices for API development.',
        'category_id' => 1,
        'post_status' => 'active',
        'tags' => [6, 3, 20]
    ],
    [
        'title' => 'React vs Vue.js: A Complete Comparison',
        'description' => 'Detailed comparison between React and Vue.js frameworks. Explore their strengths, weaknesses, learning curves, and use cases to help you choose the right framework.',
        'category_id' => 1,
        'post_status' => 'active',
        'tags' => [4, 5, 3]
    ],
    [
        'title' => 'Flutter Mobile App Development Guide',
        'description' => 'Create beautiful cross-platform mobile apps with Flutter. Learn widgets, state management, navigation, and deployment strategies for iOS and Android.',
        'category_id' => 2,
        'post_status' => 'active',
        'tags' => [3, 17]
    ],
    [
        'title' => 'Machine Learning with Python and TensorFlow',
        'description' => 'Dive into machine learning using Python, TensorFlow, and Keras. Build neural networks, train models, and deploy ML solutions in production environments.',
        'category_id' => 3,
        'post_status' => 'active',
        'tags' => [7, 13]
    ],
    [
        'title' => 'Data Analysis with Pandas and NumPy',
        'description' => 'Master data manipulation and analysis using Pandas and NumPy libraries. Learn data cleaning, visualization, statistical analysis, and reporting techniques.',
        'category_id' => 3,
        'post_status' => 'active',
        'tags' => [7, 11]
    ],
    [
        'title' => 'Introduction to Artificial Intelligence',
        'description' => 'Explore the fundamentals of AI, machine learning algorithms, neural networks, and their real-world applications in various industries.',
        'category_id' => 4,
        'post_status' => 'active',
        'tags' => [7, 13]
    ],
    [
        'title' => 'Docker and Containerization Best Practices',
        'description' => 'Learn Docker containerization, orchestration with Kubernetes, and deployment strategies. Improve your DevOps skills and application scalability.',
        'category_id' => 5,
        'post_status' => 'active',
        'tags' => [13, 14]
    ],
    [
        'title' => 'Modern CSS Grid and Flexbox Layout',
        'description' => 'Master modern CSS layout techniques using Grid and Flexbox. Create responsive, flexible layouts with clean and maintainable code.',
        'category_id' => 1,
        'post_status' => 'active',
        'tags' => [17, 16, 18]
    ],
    [
        'title' => 'GraphQL vs REST API Design',
        'description' => 'Compare GraphQL and REST API architectures. Learn when to use each approach and how to implement them effectively in your applications.',
        'category_id' => 1,
        'post_status' => 'pending',
        'tags' => [20, 3]
    ],
    [
        'title' => 'Cybersecurity Best Practices for Developers',
        'description' => 'Essential security practices every developer should know. Learn about authentication, authorization, data encryption, and common vulnerabilities.',
        'category_id' => 8,
        'post_status' => 'active',
        'tags' => [2, 6]
    ],
    [
        'title' => 'Advanced Python Programming Techniques',
        'description' => 'Dive deep into Python with advanced concepts like decorators, generators, context managers, and metaclasses. Level up your Python skills.',
        'category_id' => 3,
        'post_status' => 'active',
        'tags' => [7, 8, 9]
    ]
];

foreach ($postsData as $index => $postData) {
    $tags = $postData['tags'];
    unset($postData['tags']);
    
    $post = App\Models\Posts::create([
        'title' => $postData['title'],
        'description' => $postData['description'],
        'category_id' => $postData['category_id'],
        'post_status' => $postData['post_status'],
        'user_id' => $user->id,
        'name' => $user->name,
        'usertype' => $user->usertype,
        'image' => null,
        'created_at' => now()->subDays(rand(1, 30)),
        'updated_at' => now()->subDays(rand(1, 30))
    ]);

    // Attach tags to posts
    if (!empty($tags)) {
        $existingTags = App\Models\Tag::whereIn('id', $tags)->pluck('id')->toArray();
        $post->tags()->attach($existingTags);
    }

    // Add some comments for testing "most commented" sort
    if ($index % 3 == 0) {
        for ($i = 0; $i < rand(2, 6); $i++) {
            App\Models\Comment::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'post_id' => $post->id,
                'comment' => 'This is a test comment #' . ($i + 1) . ' for testing the most commented sort feature.',
                'created_at' => now()->subDays(rand(1, 15))
            ]);
        }
    }
}

echo "Search test data has been created successfully!\n";
echo "Posts: " . App\Models\Posts::count() . "\n";
echo "Categories: " . App\Models\Category::count() . "\n"; 
echo "Tags: " . App\Models\Tag::count() . "\n";
echo "Comments: " . App\Models\Comment::count() . "\n";
