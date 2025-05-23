<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

//calling homeController
Route::get('/', [homeController::class, 'homepage'])->name('home.homepage');

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

Route::get('/post_page', [adminController::class, 'post_page'])->name('admin.post_page');
Route::post('/add_post', [adminController::class, 'add_post'])->name('admin.add_post');