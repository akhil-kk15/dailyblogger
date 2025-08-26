<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Get basic statistics  
        $stats = [
            'total_posts' => Posts::count(),
            'active_posts' => Posts::where('post_status', 'active')->count(),
            'pending_posts' => Posts::where('post_status', 'pending')->count(),
            'featured_posts' => Posts::where('is_featured', true)->count(),
            'total_users' => User::where('usertype', 'user')->count(),
            'total_comments' => Comment::count(),
            'total_categories' => Category::where('is_active', true)->count(),
            'total_tags' => Tag::where('is_active', true)->count(),
        ];

        // Get posts by status for pie chart
        $postsByStatus = Posts::select('post_status', DB::raw('count(*) as count'))
            ->groupBy('post_status')
            ->get()
            ->pluck('count', 'post_status')
            ->toArray();

        // Get posts created in last 7 days for line chart
        $postsLast7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $postsLast7Days[] = [
                'date' => $date->format('M d'),
                'count' => Posts::whereDate('created_at', $date)->count()
            ];
        }

        // Get top categories by post count (limit to 5)
        $topCategories = Category::where('is_active', true)
            ->get()
            ->sortByDesc('posts_count')
            ->take(5);

        // Get most active users (limit to 5)
        $topUsers = User::withCount('posts')
            ->where('usertype', 'user')
            ->orderBy('posts_count', 'desc')
            ->limit(5)
            ->get();

        // Get recent activity (limit to 5 recent posts)
        $recentPosts = Posts::with(['user:id,name', 'category:id,name'])
            ->select('id', 'title', 'user_id', 'category_id', 'post_status', 'is_featured', 'created_at')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.analytics', compact(
            'stats', 
            'postsByStatus', 
            'postsLast7Days', 
            'topCategories', 
            'topUsers', 
            'recentPosts'
        ));
    }
}
