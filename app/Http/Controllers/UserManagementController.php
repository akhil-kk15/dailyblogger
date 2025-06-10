<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect('/dashboard')->with('error', 'Access denied.');
        }
        
        $users = User::orderBy('name')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect('/dashboard')->with('error', 'Access denied.');
        }
        
        // Validate request
        $request->validate([
            'usertype' => 'required|in:admin,user,blocked',
            'blocked_reason' => 'nullable|string|max:255'
        ]);

        // Prevent admins from changing their own role
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        // Update the user's role
        $oldRole = $user->usertype;
        $user->usertype = $request->usertype;
        
        // Handle blocking metadata (keep the fields for admin reference)
        if ($request->usertype === 'blocked') {
            $user->blocked_at = now();
            $user->blocked_reason = $request->blocked_reason ?? 'Blocked by admin';
        } else if ($oldRole === 'blocked') {
            // Clear blocking info when unblocking
            $user->blocked_at = null;
            $user->blocked_reason = null;
        }
        
        $user->save();

        $message = "User role updated successfully";
        if ($request->usertype === 'blocked') {
            $message = "User has been blocked successfully";
        } elseif ($oldRole === 'blocked') {
            $message = "User has been unblocked successfully";
        }

        return redirect()->back()->with('message', $message);
    }
}
