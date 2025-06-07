<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $posts = Posts::where('post_status', 'active')->withCount('comments')->latest()->limit(6)->get();
        return view('home.homepage', compact('posts'));
    }
    
    public function all_posts()
    {
        $posts = Posts::where('post_status', 'active')->withCount('comments')->latest()->paginate(12);
        return view('home.all_posts', compact('posts'));
    }
    
    public function post_details($id)
    {
        $post = Posts::where('id', $id)
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
        
        $posts = Posts::where('name', Auth::user()->name)
                     ->latest()
                     ->paginate(12);
        
        return view('home.my_posts', compact('posts'));
    }
    
    public function create_post()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        return view('home.create_post');
    }
    
    public function store_post(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $post = new Posts;
        $post->title = $request->title;
        $post->description = $request->description;
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
        
        return redirect()->back()->with('message', 'Comment added successfully!');
    }
}
