<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use App\Services\NotificationService;

class adminController extends Controller
{

    public function post_page()
    {
        $categories = \App\Models\Category::active()->orderBy('name')->get();
        $tags = \App\Models\Tag::active()->orderBy('name')->get();
        
        return view('admin.post_page', compact('categories', 'tags'));
    }
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth::user()->usertype;
            
            if($usertype == 'user'){
                return view('home.homepage');
            }
            else if($usertype == 'admin'){
                // Get post statistics for admin dashboard
                $totalPosts = Posts::count();
                $activePosts = Posts::where('post_status', 'active')->count();
                $pendingPosts = Posts::where('post_status', 'pending')->count();
                $rejectedPosts = Posts::where('post_status', 'rejected')->count();
                $totalUsers = User::count();
                
                return view('admin.adminhome', compact('totalPosts', 'activePosts', 'pendingPosts', 'rejectedPosts', 'totalUsers'));
            }
            else{
                return redirect()->back();
            }
         }
        // else {
        //     return redirect()->route('login');
        // }
    }
    public function add_post(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Posts;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        
        // Set post status based on user type
        if(Auth::user()->usertype == 'admin') {
            $post->post_status = 'active'; // Admin posts are automatically approved
        } else {
            $post->post_status = 'pending'; // User posts need approval
        }
        
        $image = $request->image;
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }

        $post->name = Auth::user()->name;
        $post->user_id = Auth::id();
        $post->usertype = Auth::user()->usertype;
        $post->save();
        
        // Attach tags to the post
        if ($request->has('tags') && is_array($request->tags)) {
            $post->tags()->attach($request->tags);
        }
        
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
        
        // Create notification for post approval
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
        
        // Create notification for post rejection
        NotificationService::createPostRejectedNotification($post);
        
        return redirect()->back()->with('message', 'Post rejected with reason successfully');
    }

    public function delete_post($id)
    {
        $post = Posts::findOrFail($id);
        
        // Delete the image file if it exists
        if($post->image && file_exists(public_path('postimage/' . $post->image))) {
            unlink(public_path('postimage/' . $post->image));
        }
        
        $post->delete();
        
        return redirect()->back()->with('message', 'Post deleted successfully');
    }
}
