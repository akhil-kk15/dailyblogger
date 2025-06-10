<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\AnnouncementController;

// Public routes
Route::get('/', [homeController::class, 'homepage'])->name('home.homepage');
Route::get('/posts', [homeController::class, 'all_posts'])->name('home.posts');
Route::get('/posts/{id}', [homeController::class, 'post_details'])->name('home.post_details');

// Search routes
Route::get('/search', [SearchController::class, 'index'])->name('home.search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::post('/search', [SearchController::class, 'quickSearch'])->name('search.quick');

// Route::get('/', function () {
//     return view('welcome');
// });

// route for admin
Route::get('/home',[adminController::class,'index']);

// Route::get('/', function () {
//     return view('home.homepage');
// })->name('homepage');

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
    Route::put('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.updateRole');
    
    // User post management routes
    Route::get('/create-post', [UserPostController::class, 'create'])->name('home.create_post');
    Route::post('/create-post', [UserPostController::class, 'store'])->name('home.store_post');
    Route::get('/my-posts', [UserPostController::class, 'myPosts'])->name('home.my_posts');
    Route::get('/edit-post/{id}', [UserPostController::class, 'edit'])->name('home.edit_post');
    Route::put('/update-post/{id}', [UserPostController::class, 'update'])->name('home.update_post');
    Route::delete('/delete-post/{id}', [UserPostController::class, 'destroy'])->name('home.delete_post');
    
    // Comment management routes
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Admin comment moderation routes
    Route::get('/admin/comments', [CommentController::class, 'adminIndex'])->name('admin.comments.index');
    Route::delete('/admin/comments/{id}', [CommentController::class, 'adminDestroy'])->name('admin.comments.destroy');
    
    // Admin categories and tags management routes
    Route::post('/admin/categories', [adminController::class, 'add_category'])->name('admin.add_category');
    Route::delete('/admin/categories/{id}', [adminController::class, 'delete_category'])->name('admin.delete_category');
    Route::post('/admin/tags', [adminController::class, 'add_tag'])->name('admin.add_tag');
    Route::delete('/admin/tags/{id}', [adminController::class, 'delete_tag'])->name('admin.delete_tag');
});

// Custom Profile route (override Jetstream default before it loads)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'showCustomProfile'])->name('profile.show');
});