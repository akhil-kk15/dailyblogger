<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to comment.');
        }

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        $post = Posts::where('id', $request->post_id)
                    ->where('post_status', 'active')
                    ->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found or not available for comments.');
        }

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('message', 'Comment added successfully!');
    }

    /**
     * Update a comment.
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'comment' => 'required|string|min:3|max:1000',
        ]);

        $comment = Comment::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        $comment->update([
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('message', 'Comment updated successfully!');
    }

    /**
     * Delete a comment.
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        $comment = Comment::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->first();

        if (!$comment) {
            // Check if user is admin and can delete any comment
            if (Auth::user()->usertype === 'admin') {
                $comment = Comment::findOrFail($id);
            } else {
                return response()->json(['success' => false, 'message' => 'Comment not found or unauthorized.'], 404);
            }
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully!'
        ]);
    }

    /**
     * Admin: Get all comments for moderation.
     */
    public function adminIndex()
    {
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect()->route('login');
        }

        $comments = Comment::with(['user', 'post'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);

        return view('admin.comments', compact('comments'));
    }

    /**
     * Admin: Delete any comment.
     */
    public function adminDestroy($id)
    {
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully!'
        ]);
    }
}
