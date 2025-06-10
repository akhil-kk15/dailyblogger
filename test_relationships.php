<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing pivot table relationships...\n";

try {
    $posts = \App\Models\Posts::with('tags')->first();
    
    if ($posts) {
        echo "✓ Post found: " . $posts->title . "\n";
        echo "✓ Tags loaded successfully: " . $posts->tags->count() . " tags\n";
        echo "✓ Pivot table relationship working!\n";
    } else {
        echo "No posts found in database\n";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\nTesting complete.\n";
