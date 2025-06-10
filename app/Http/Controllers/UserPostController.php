<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class UserPostController extends Controller
{
    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::active()->get();
        $tags = Tag::active()->get();
        
        return view('home.create_post', compact('categories', 'tags'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB limit, JPEG/PNG only
        ], [
            'image.mimes' => 'The image must be a JPEG or PNG file.',
            'image.max' => 'The image file size must not exceed 5MB.',
        ]);

        $post = new Posts();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->name = Auth::user()->name;
        $post->user_id = Auth::id();
        $post->usertype = Auth::user()->usertype;
        $post->post_status = 'pending'; // User posts need approval
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('postimage'), $imagename);
            $post->image = $imagename;
        }
        
        $post->save();
        
        // Attach tags if provided
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        
        return redirect()->back()->with('message', 'Post submitted for review successfully! You will be notified once it\'s approved.');
    }

    /**
     * Display the user's posts.
     */
    public function myPosts()
    {
        $posts = Posts::where('user_id', Auth::id())
                     ->with(['category', 'tags'])
                     ->orderBy('created_at', 'desc')
                     ->paginate(12);
        
        return view('home.my_posts', compact('posts'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $post = Posts::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->with(['category', 'tags'])
                    ->firstOrFail();
                    
        $categories = Category::active()->get();
        $tags = Tag::active()->get();
        
        return view('home.edit_post', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Posts::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB limit, JPEG/PNG only
        ], [
            'image.mimes' => 'The image must be a JPEG or PNG file.',
            'image.max' => 'The image file size must not exceed 5MB.',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        
        // If post was rejected and is being edited, reset to pending
        if ($post->post_status === 'rejected') {
            $post->post_status = 'pending';
            $post->rejection_reason = null;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image && file_exists(public_path('postimage/' . $post->image))) {
                unlink(public_path('postimage/' . $post->image));
            }
            
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('postimage'), $imagename);
            $post->image = $imagename;
        }
        
        $post->save();
        
        // Update tags
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }
        
        return redirect()->route('home.my_posts')->with('message', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $post = Posts::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();
        
        // Delete image if exists
        if ($post->image && file_exists(public_path('postimage/' . $post->image))) {
            unlink(public_path('postimage/' . $post->image));
        }
        
        // Delete the post (this will also delete related tags due to cascade)
        $post->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully!'
        ]);
    }
}
