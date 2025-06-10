<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\adminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SettingsController;

// Language switching routes
Route::post('/switch-language', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/current-language', [LanguageController::class, 'getCurrentLanguage'])->name('language.current');

// Test route for language
Route::get('/test-language', function() {
    return response()->json([
        'current_locale' => App::getLocale(),
        'test_translation' => __('admin.dashboard'),
        'welcome_message' => __('admin.welcome'),
        'session_locale' => Session::get('locale', 'not set')
    ]);
});

// Public routes
Route::get('/', [homeController::class, 'homepage'])->name('home.homepage');
Route::get('/posts', [homeController::class, 'all_posts'])->name('home.posts');
Route::get('/posts/{id}', [homeController::class, 'post_details'])->name('home.post_details');

// Search routes
Route::get('/search', [SearchController::class, 'index'])->name('home.search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::post('/search', [SearchController::class, 'quickSearch'])->name('search.quick');

// User authenticated routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/my-posts', [homeController::class, 'my_posts'])->name('home.my_posts');
    Route::get('/create-post', [homeController::class, 'create_post'])->name('home.create_post');
    Route::post('/store-post', [homeController::class, 'store_post'])->name('home.store_post');
    
    // Edit and delete routes for user posts
    Route::get('/edit-post/{id}', [homeController::class, 'edit_post'])->name('home.edit_post');
    Route::put('/update-post/{id}', [homeController::class, 'update_post'])->name('home.update_post');
    Route::delete('/delete-post/{id}', [homeController::class, 'delete_post'])->name('home.delete_post');
    
    Route::post('/posts/{id}/comment', [homeController::class, 'store_comment'])->name('home.store_comment');
    
    // Notification routes
    Route::get('/notifications', [homeController::class, 'notifications'])->name('home.notifications');
    Route::get('/api/notifications/count', [homeController::class, 'getNotificationCount'])->name('api.notifications.count');
    Route::post('/api/notifications/mark-read', [homeController::class, 'markNotificationsAsRead'])->name('api.notifications.mark_read');
});

// Route for admin
Route::get('/home',[adminController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin routes (protected with auth middleware)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/post_page', [adminController::class, 'post_page'])->name('admin.post_page');
    Route::post('/add_post', [adminController::class, 'add_post'])->name('admin.add_post');
    
    // Admin posts management routes
    Route::get('/show_posts', [adminController::class, 'show_posts'])->name('admin.show_posts');
    Route::post('/approve_post/{id}', [adminController::class, 'approve_post'])->name('admin.approve_post');
    Route::delete('/delete_post/{id}', [adminController::class, 'delete_post'])->name('admin.delete_post');
    Route::post('/reject_post/{id}', [adminController::class, 'reject_post'])->name('admin.reject_post');
    Route::post('/reject_post_with_reason/{id}', [adminController::class, 'reject_post_with_reason'])->name('admin.reject_post_with_reason');
    
    // Admin announcement routes
    Route::get('/announcement_page', [AnnouncementController::class, 'announcement_page'])->name('admin.announcement_page');
    Route::post('/store_announcement', [AnnouncementController::class, 'store_announcement'])->name('admin.store_announcement');
    Route::get('/show_announcements', [AnnouncementController::class, 'show_announcements'])->name('admin.show_announcements');
    Route::post('/toggle_announcement/{id}', [AnnouncementController::class, 'toggle_announcement'])->name('admin.toggle_announcement');
    Route::delete('/delete_announcement/{id}', [AnnouncementController::class, 'delete_announcement'])->name('admin.delete_announcement');
    
    // Admin user management routes
    Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::put('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.updateRole');
    
    // User post management routes (alternative routes for UserPostController)
    Route::get('/user/create-post', [UserPostController::class, 'create'])->name('user.create_post');
    Route::post('/user/create-post', [UserPostController::class, 'store'])->name('user.store_post');
    Route::get('/user/my-posts', [UserPostController::class, 'myPosts'])->name('user.my_posts');
    Route::get('/user/edit-post/{id}', [UserPostController::class, 'edit'])->name('user.edit_post');
    Route::put('/user/update-post/{id}', [UserPostController::class, 'update'])->name('user.update_post');
    Route::delete('/user/delete-post/{id}', [UserPostController::class, 'destroy'])->name('user.delete_post');
    
    // Comment management routes
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Admin comment moderation routes
    Route::get('/admin/comments', [CommentController::class, 'adminIndex'])->name('admin.comments.index');
    Route::delete('/admin/comments/{id}', [CommentController::class, 'adminDestroy'])->name('admin.comments.destroy');
    
    // Admin categories and tags management routes
    Route::get('/admin/categories-tags', [adminController::class, 'categories_tags'])->name('admin.categories_tags');
    Route::post('/admin/categories', [adminController::class, 'add_category'])->name('admin.add_category');
    Route::put('/admin/categories/{id}', [adminController::class, 'edit_category'])->name('admin.edit_category');
    Route::delete('/admin/categories/{id}', [adminController::class, 'delete_category'])->name('admin.delete_category');
    Route::post('/admin/tags', [adminController::class, 'add_tag'])->name('admin.add_tag');
    Route::put('/admin/tags/{id}', [adminController::class, 'edit_tag'])->name('admin.edit_tag');
    Route::delete('/admin/tags/{id}', [adminController::class, 'delete_tag'])->name('admin.delete_tag');
    
    // Featured posts management
    Route::post('/admin/posts/{id}/toggle-featured', [adminController::class, 'toggle_featured'])->name('admin.toggle_featured');
    
    // Analytics dashboard
    Route::get('/admin/analytics', [AnalyticsController::class, 'dashboard'])->name('admin.analytics');
    
    // Settings management
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings/general', [SettingsController::class, 'updateGeneral'])->name('admin.settings.general');
    Route::post('/admin/settings/mail', [SettingsController::class, 'updateMail'])->name('admin.settings.mail');
    Route::post('/admin/settings/appearance', [SettingsController::class, 'updateAppearance'])->name('admin.settings.appearance');
    Route::post('/admin/settings/security', [SettingsController::class, 'updateSecurity'])->name('admin.settings.security');
    Route::post('/admin/settings/social', [SettingsController::class, 'updateSocial'])->name('admin.settings.social');
    Route::post('/admin/settings/test-email', [SettingsController::class, 'testEmail'])->name('admin.settings.test_email');
    Route::post('/admin/settings/clear-cache', [SettingsController::class, 'clearCache'])->name('admin.settings.clear_cache');
    Route::get('/admin/settings/backup', [SettingsController::class, 'backupDatabase'])->name('admin.settings.backup');
    Route::get('/admin/settings/export', [SettingsController::class, 'exportSettings'])->name('admin.settings.export');
    Route::post('/admin/settings/import', [SettingsController::class, 'importSettings'])->name('admin.settings.import');
});

// Custom Profile route (override Jetstream default before it loads)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'showCustomProfile'])->name('profile.show');
});
