<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use App\Models\Category;
use App\Models\Tag;
use App\Services\NotificationService;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth::user()->usertype;
            
            if($usertype == 'user'){
                return view('home.homepage');
            }
            else if($usertype == 'admin'){
                // Get dynamic statistics for the admin dashboard
                $totalUsers = User::count();
                $totalPosts = Posts::count();
                $approvedPosts = Posts::where('post_status', 'active')->count();
                $pendingPosts = Posts::where('post_status', 'pending')->count();
                $rejectedPosts = Posts::where('post_status', 'rejected')->count();
                
                // Recent activity (last 30 days)
                $recentUsersCount = User::where('created_at', '>=', now()->subDays(30))->count();
                $recentPostsCount = Posts::where('created_at', '>=', now()->subDays(30))->count();
                $recentApproved = Posts::where('post_status', 'active')
                                     ->where('updated_at', '>=', now()->subDays(30))
                                     ->count();
                
                // Comments statistics
                $totalComments = \App\Models\Comment::count();
                $recentComments = \App\Models\Comment::where('created_at', '>=', now()->subDays(30))->count();
                
                // Categories and Tags
                $totalCategories = Category::count();
                $totalTags = Tag::count();
                
                // Additional statistics
                $featuredPosts = Posts::where('is_featured', true)->count();
                $todayViews = 0; // This would need a views tracking system
                $weeklyPosts = Posts::where('created_at', '>=', now()->subWeek())->count();
                $weeklyApproved = Posts::where('post_status', 'active')
                                    ->where('updated_at', '>=', now()->subWeek())
                                    ->count();
                $weeklyUsers = User::where('created_at', '>=', now()->subWeek())->count();
                
                $stats = [
                    'totalUsers' => $totalUsers,
                    'totalPosts' => $totalPosts,
                    'approvedPosts' => $approvedPosts,
                    'pendingPosts' => $pendingPosts,
                    'rejectedPosts' => $rejectedPosts,
                    'recentUsers' => $recentUsersCount,
                    'recentPosts' => $recentPostsCount,
                    'recentApproved' => $recentApproved,
                    'totalComments' => $totalComments,
                    'recentComments' => $recentComments,
                    'totalCategories' => $totalCategories,
                    'totalTags' => $totalTags,
                    'featuredPosts' => $featuredPosts,
                    'todayViews' => $todayViews,
                    'weeklyPosts' => $weeklyPosts,
                    'weeklyApproved' => $weeklyApproved,
                    'weeklyUsers' => $weeklyUsers,
                ];
                
                // Get recent posts (last 30 days, limit 5)
                $recentPosts = Posts::with('category')
                    ->where('created_at', '>=', now()->subDays(30))
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
                
                // Get recent users (last 30 days, limit 5)
                $recentUsers = User::where('created_at', '>=', now()->subDays(30))
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
                
                return view('admin.adminhome', compact('stats', 'recentPosts', 'recentUsers'));
            }
            else{
                return redirect()->back();
            }
         }
    }

    public function show_posts(Request $request)
    {
        $query = Posts::with(['category', 'tags']);
        
        // Filter by status if provided
        if ($request->has('status')) {
            $status = $request->get('status');
            if (in_array($status, ['active', 'pending', 'rejected'])) {
                $query->where('post_status', $status);
            }
        }
        
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Pass the current status filter to the view
        $currentStatus = $request->get('status', 'all');
        
        // Get stats for the filter tabs
        $stats = [
            'totalPosts' => Posts::count(),
            'approvedPosts' => Posts::where('post_status', 'active')->count(),
            'pendingPosts' => Posts::where('post_status', 'pending')->count(),
            'rejectedPosts' => Posts::where('post_status', 'rejected')->count(),
        ];
        
        return view('admin.show_posts', compact('posts', 'currentStatus', 'stats'));
    }

    public function approve_post($id)
    {
        $post = Posts::findOrFail($id);
        $post->post_status = 'active';
        $post->save();
        
        NotificationService::createPostApprovedNotification($post);
        
        return redirect()->back()->with('message', 'Post approved successfully');
    }

    public function reject_post($id)
    {
        $post = Posts::findOrFail($id);
        $post->post_status = 'rejected';
        $post->save();
        
        return redirect()->back()->with('message', 'Post rejected successfully');
    }

    public function reject_post_with_reason(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $post = Posts::findOrFail($id);
        $post->post_status = 'rejected';
        $post->rejection_reason = $request->rejection_reason;
        $post->save();
        
        NotificationService::createPostRejectedNotification($post);
        
        return redirect()->back()->with('message', 'Post rejected with reason successfully');
    }

    public function delete_post($id)
    {
        $post = Posts::findOrFail($id);
        
        if($post->image && file_exists(public_path('postimage/' . $post->image))) {
            unlink(public_path('postimage/' . $post->image));
        }
        
        $post->delete();
        
        return redirect()->back()->with('message', 'Post deleted successfully');
    }
    
    /**
     * Show categories and tags management page
     */
    public function categories_tags()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        
        return view('admin.categories_tags', compact('categories', 'tags'));
    }
    
    /**
     * Add a new category (Admin only)
     */
    public function add_category(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500'
        ]);
        
        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'is_active' => true
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Category added successfully',
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding category: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Edit a category (Admin only)
     */
    public function edit_category(Request $request, $id)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:500'
        ]);
        
        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating category: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Delete a category (Admin only)
     */
    public function delete_category(Request $request, $id)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $category = Category::findOrFail($id);
            
            // Check if category has posts
            $postsCount = Posts::where('category_id', $id)->count();
            $forceDelete = $request->input('force', false);
            
            if ($postsCount > 0 && !$forceDelete) {
                return response()->json([
                    'success' => false,
                    'message' => 'This category has ' . $postsCount . ' posts associated with it.',
                    'posts_count' => $postsCount,
                    'require_confirmation' => true
                ], 400);
            }
            
            // If force delete, set all posts in this category to null (uncategorized)
            if ($postsCount > 0 && $forceDelete) {
                Posts::where('category_id', $id)->update(['category_id' => null]);
            }
            
            $category->delete();
            
            $message = $postsCount > 0 ? 
                "Category deleted successfully. {$postsCount} posts have been moved to 'Uncategorized'." :
                'Category deleted successfully';
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting category: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Add a new tag (Admin only)
     */
    public function add_tag(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name'
        ]);
        
        try {
            $tag = Tag::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => true
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Tag added successfully',
                'tag' => $tag
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding tag: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Edit a tag (Admin only)
     */
    public function edit_tag(Request $request, $id)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id
        ]);
        
        try {
            $tag = Tag::findOrFail($id);
            $tag->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Tag updated successfully',
                'tag' => $tag
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating tag: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Delete a tag (Admin only)
     */
    public function delete_tag(Request $request, $id)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        try {
            $tag = Tag::findOrFail($id);
            
            // Check if tag has posts
            $postsCount = $tag->posts()->count();
            $forceDelete = $request->input('force', false);
            
            if ($postsCount > 0 && !$forceDelete) {
                return response()->json([
                    'success' => false,
                    'message' => 'This tag is associated with ' . $postsCount . ' posts.',
                    'posts_count' => $postsCount,
                    'require_confirmation' => true
                ], 400);
            }
            
            // If force delete, detach tag from all posts
            if ($postsCount > 0 && $forceDelete) {
                $tag->posts()->detach();
            }
            
            $tag->delete();
            
            $message = $postsCount > 0 ? 
                "Tag deleted successfully. It has been removed from {$postsCount} posts." :
                'Tag deleted successfully';
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting tag: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Toggle featured status of a post (Admin only)
     */
    public function toggle_featured($id)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            $post = Posts::findOrFail($id);
            
            // Toggle featured status
            $post->is_featured = !$post->is_featured;
            $post->featured_at = $post->is_featured ? now() : null;
            $post->save();

            $message = $post->is_featured ? 'Post has been featured successfully!' : 'Post has been unfeatured successfully!';

            return response()->json([
                'success' => true,
                'message' => $message,
                'is_featured' => $post->is_featured
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating featured status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getDashboardStats()
    {
        $totalUsers = User::count();
        $totalPosts = Posts::count();
        $approvedPosts = Posts::where('post_status', 'active')->count();
        $pendingPosts = Posts::where('post_status', 'pending')->count();
        $rejectedPosts = Posts::where('post_status', 'rejected')->count();
        
        // Recent activity (last 30 days)
        $recentUsersCount = User::where('created_at', '>=', now()->subDays(30))->count();
        $recentPostsCount = Posts::where('created_at', '>=', now()->subDays(30))->count();
        $recentApproved = Posts::where('post_status', 'active')
                             ->where('updated_at', '>=', now()->subDays(30))
                             ->count();
        
        // Comments statistics
        $totalComments = \App\Models\Comment::count();
        $recentComments = \App\Models\Comment::where('created_at', '>=', now()->subDays(30))->count();
        
        // Categories and Tags
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        
        return response()->json([
            'totalUsers' => $totalUsers,
            'totalPosts' => $totalPosts,
            'approvedPosts' => $approvedPosts,
            'pendingPosts' => $pendingPosts,
            'rejectedPosts' => $rejectedPosts,
            'recentUsers' => $recentUsersCount,
            'recentPosts' => $recentPostsCount,
            'recentApproved' => $recentApproved,
            'totalComments' => $totalComments,
            'recentComments' => $recentComments,
            'totalCategories' => $totalCategories,
            'totalTags' => $totalTags,
        ]);
    }
}