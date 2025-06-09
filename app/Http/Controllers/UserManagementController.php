<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function __construct()
    {
        // Middleware application removed from constructor
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {

        // Validate request
        $request->validate([
            'usertype' => 'required|in:admin,user'
        ]);

        // Prevent admins from changing their own role
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        // Update the user's role
        $user->usertype = $request->usertype;
        $user->save();

        return redirect()->back()->with('message', "User role updated successfully.");
    }
}
