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
    public function post_page()
    {
        return view('admin.post_page');
    }

    public function index()
    {
        if(Auth::id()){
            $usertype = Auth::user()->usertype;
            
            if($usertype == 'user'){
                return view('home.homepage');
            }
            else if($usertype == 'admin'){
                return view('admin.adminhome');
            }
            else{
                return redirect()->back();
            }
         }
    }

    public function add_post(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB limit, JPEG/PNG only
        ], [
            'image.mimes' => 'The image must be a JPEG or PNG file.',
            'image.max' => 'The image file size must not exceed 5MB.',
        ]);

        $post = new Posts;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_status = 'active';
        
        $image = $request->image;
        if($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }

        $post->name = Auth::user()->name;
        $post->user_id = Auth::id();
        $post->usertype = Auth::user()->usertype;
        $post->save();
        
        return redirect()->back()->with('message', 'Post added successfully');
    }

    public function show_posts()
    {
        $posts = Posts::with(['category', 'tags'])
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
        return view('admin.show_posts', compact('posts'));
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
     * Add a new category (Admin only)
     */
    public function add_category(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);
        
        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
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
}