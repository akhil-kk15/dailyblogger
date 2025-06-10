<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function announcement_page()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect('/dashboard')->with('error', 'Access denied.');
        }
        
        return view('admin.announcement_page');
    }
    
    public function store_announcement(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect('/dashboard')->with('error', 'Access denied.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,normal,high,urgent',
            'type' => 'required|in:general,maintenance,feature,important',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->priority = $request->priority;
        $announcement->type = $request->type;
        $announcement->expires_at = $request->expires_at;
        $announcement->created_by = Auth::id();
        $announcement->save();

        // Create notifications for all users
        $this->notifyAllUsers($announcement);

        return redirect()->back()->with('message', 'Announcement created successfully and notifications sent to all users!');
    }
    
    public function show_announcements()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect('/dashboard')->with('error', 'Access denied.');
        }
        
        $announcements = Announcement::with('creator')
                                   ->orderBy('created_at', 'desc')
                                   ->paginate(10);
        return view('admin.show_announcements', compact('announcements'));
    }
    
    public function toggle_announcement($id)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect('/dashboard')->with('error', 'Access denied.');
        }
        
        $announcement = Announcement::findOrFail($id);
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();
        
        $status = $announcement->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('message', "Announcement {$status} successfully");
    }
    
    public function delete_announcement($id)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect('/dashboard')->with('error', 'Access denied.');
        }
        
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        
        return redirect()->back()->with('message', 'Announcement deleted successfully');
    }
    
    private function notifyAllUsers($announcement)
    {
        // Get all users except the current admin
        $users = User::where('id', '!=', Auth::id())->get();
        
        foreach ($users as $user) {
            NotificationService::createAnnouncementNotification($user->id, $announcement);
        }
    }
}
