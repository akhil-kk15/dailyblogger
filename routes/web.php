<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

//calling homeController
Route::get('/', [homeController::class, 'homepage'])->name('home.homepage');

// Posts routes
Route::get('/posts', [homeController::class, 'all_posts'])->name('home.posts');
Route::get('/posts/{id}', [homeController::class, 'post_details'])->name('home.post_details');

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
});

// Custom Profile route (override Jetstream default before it loads)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'showCustomProfile'])->name('profile.show');
});