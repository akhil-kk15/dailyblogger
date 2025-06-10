<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use Illuminate\Support\Facades\DB;

// Bootstrap Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Starting migration of blocked users from is_blocked to usertype system...\n";

// Find users who have is_blocked = true but usertype != 'blocked'
$usersToMigrate = User::where('is_blocked', true)
                     ->where('usertype', '!=', 'blocked')
                     ->get();

if ($usersToMigrate->count() > 0) {
    echo "Found {$usersToMigrate->count()} users to migrate:\n";
    
    foreach ($usersToMigrate as $user) {
        echo "- Migrating user: {$user->name} ({$user->email})\n";
        
        // Update usertype to 'blocked'
        $user->usertype = 'blocked';
        
        // Ensure blocked_at is set if not already
        if (!$user->blocked_at) {
            $user->blocked_at = now();
        }
        
        // Set default blocked reason if not set
        if (!$user->blocked_reason) {
            $user->blocked_reason = 'Migrated from legacy blocking system';
        }
        
        $user->save();
        echo "  ✓ Updated user {$user->name} to blocked usertype\n";
    }
    
    echo "\nMigration completed successfully!\n";
} else {
    echo "No users found that need migration.\n";
}

// Also check for any users with usertype = 'blocked' but is_blocked = false
$inconsistentUsers = User::where('usertype', 'blocked')
                        ->where('is_blocked', false)
                        ->get();

if ($inconsistentUsers->count() > 0) {
    echo "\nFound {$inconsistentUsers->count()} users with inconsistent blocking status:\n";
    
    foreach ($inconsistentUsers as $user) {
        echo "- Fixing user: {$user->name} ({$user->email})\n";
        
        // Since usertype is 'blocked', ensure other fields are consistent
        $user->is_blocked = true;
        
        if (!$user->blocked_at) {
            $user->blocked_at = now();
        }
        
        if (!$user->blocked_reason) {
            $user->blocked_reason = 'Blocked user - reason updated during migration';
        }
        
        $user->save();
        echo "  ✓ Fixed inconsistent data for user {$user->name}\n";
    }
    
    echo "\nInconsistency fixes completed!\n";
} else {
    echo "No inconsistent users found.\n";
}

echo "\nAll done! The system now uses usertype = 'blocked' as the primary blocking mechanism.\n";
