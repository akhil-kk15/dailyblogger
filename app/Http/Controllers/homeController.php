<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
class homeController extends Controller
{
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth::user()->usertype;
            
            if($usertype == 'user'){
                return view('dashboard');
            }
            else if($usertype == 'admin'){
                return view('admin.index');
            }
            else{
                return redirect()->back();
            }
         }
        // else {
        //     return redirect()->route('login');
        // }200
    }
    public function homepage()
    {
        $posts = Posts::with(['category', 'tags'])
                     ->where('post_status', 'active')
                     ->withCount('comments')
                     ->latest()
                     ->limit(6)
                     ->get();
        
        $announcements = Announcement::active()
                                   ->orderBy('priority', 'desc')
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        
        return view('home.homepage', compact('posts', 'announcements'));
    }
    
    public function all_posts()
    {
        $posts = Posts::with(['category', 'tags'])
                     ->where('post_status', 'active')
                     ->withCount('comments')
                     ->latest()
                     ->paginate(12);
        
        $announcements = Announcement::active()
                                   ->where('type', '!=', 'maintenance') // Don't show maintenance announcements on all posts page
                                   ->orderBy('priority', 'desc')
                                   ->orderBy('created_at', 'desc')
                                   ->limit(3)
                                   ->get();
        
        return view('home.all_posts', compact('posts', 'announcements'));
    }
    
    public function post_details($id)
    {
        $post = Posts::with(['category', 'tags'])
                    ->where('id', $id)
                    ->where('post_status', 'active')
                    ->firstOrFail();
        $comments = Comment::where('post_id', $id)
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('home.post_details', compact('post', 'comments'));
    }
    
    public function my_posts()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $posts = Posts::with(['category', 'tags'])
                     ->where('name', Auth::user()->name)
                     ->latest()
                     ->paginate(12);
        
        return view('home.my_posts', compact('posts'));
    }
    
    public function create_post()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $categories = \App\Models\Category::active()->orderBy('name')->get();
        $tags = \App\Models\Tag::active()->orderBy('name')->get();
        
        return view('home.create_post', compact('categories', 'tags'));
    }
    
    public function store_post(Request $request)
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
        $post->post_status = 'pending'; // User posts need admin approval
        
        // Handle image upload
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('postimage'), $imagename);
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
        
        return redirect()->back()->with('message', 'Post submitted successfully! It will be reviewed by admin before publishing.');
    }
    
    public function store_comment(Request $request, $post_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);
        
        // Check if post exists and is active
        $post = Posts::where('id', $post_id)
                    ->where('post_status', 'active')
                    ->firstOrFail();
        
        $comment = new Comment;
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();
        $comment->user_name = Auth::user()->name;
        $comment->comment = $request->comment;
        $comment->save();
        
        // Create notification for new comment
        NotificationService::createNewCommentNotification($comment, $post);
        
        return redirect()->back()->with('message', 'Comment added successfully!');
    }
    
    public function notifications()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $notifications = NotificationService::getRecentNotifications(Auth::id(), 50);
        
        return view('home.notifications', compact('notifications'));
    }
    
    public function getNotificationCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }
        
        $count = NotificationService::getUnreadCount(Auth::id());
        return response()->json(['count' => $count]);
    }
    
    public function markNotificationsAsRead(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false]);
        }
        
        if ($request->has('notification_ids')) {
            NotificationService::markAsRead($request->notification_ids);
        } else {
            NotificationService::markAllAsRead(Auth::id());
        }
        
        return response()->json(['success' => true]);
    }
    
    public function edit_post($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $post = Posts::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->with('tags')
                    ->firstOrFail();
        
        $categories = \App\Models\Category::active()->orderBy('name')->get();
        $tags = \App\Models\Tag::active()->orderBy('name')->get();
        
        return view('home.edit_post', compact('post', 'categories', 'tags'));
    }
    
    public function update_post(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $post = Posts::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        
        // If the post was previously rejected, reset it to pending for re-review
        if ($post->post_status == 'rejected') {
            $post->post_status = 'pending';
            $post->rejection_reason = null;
        }
        
        // Handle image upload
        if($request->hasFile('image')) {
            // Delete old image if it exists
            if($post->image && file_exists(public_path('postimage/' . $post->image))) {
                unlink(public_path('postimage/' . $post->image));
            }
            
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('postimage'), $imagename);
            $post->image = $imagename;
        }
        
        $post->save();
        
        // Update tags
        if ($request->has('tags') && is_array($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }
        
        $message = $post->post_status == 'pending' ? 
            'Post updated successfully! It will be reviewed by admin before publishing.' : 
            'Post updated successfully!';
        
        return redirect()->route('home.my_posts')->with('message', $message);
    }
    
    public function delete_post($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        
        $post = Posts::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->first();
        
        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found or unauthorized'], 404);
        }
        
        // Delete associated image if it exists
        if($post->image && file_exists(public_path('postimage/' . $post->image))) {
            unlink(public_path('postimage/' . $post->image));
        }
        
        // Delete associated comments
        Comment::where('post_id', $id)->delete();
        
        $post->delete();
        
        return response()->json(['success' => true, 'message' => 'Post deleted successfully!']);
    }
}
