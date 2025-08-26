<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing notifications table functionality...\n";

try {
    // Test creating a simple notification
    $testNotification = \App\Models\Notification::create([
        'user_id' => 1, // Admin user
        'type' => 'test',
        'title' => 'Test Notification',
        'message' => 'This is a test notification to verify the table works.',
        'post_id' => null,
        'comment_id' => null,
        'is_read' => false
    ]);
    
    echo "✓ Successfully created test notification with ID: " . $testNotification->id . "\n";
    
    // Test reading the notification
    $retrieved = \App\Models\Notification::find($testNotification->id);
    echo "✓ Successfully retrieved notification: " . $retrieved->title . "\n";
    
    // Clean up the test notification
    $testNotification->delete();
    echo "✓ Test notification cleaned up\n";
    
    echo "\nNotifications table is working correctly!\n";
    echo " Both announcement and post approval features should now work.\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\nTest complete.\n";
