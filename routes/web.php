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
});

// Custom Profile route (override Jetstream default before it loads)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'showCustomProfile'])->name('profile.show');
});