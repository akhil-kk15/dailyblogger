<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use App\Models\Notification;
use App\Services\NotificationService;
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
        $posts = Posts::where('post_status', 'active')->latest()->limit(6)->get();
        $featuredPosts = Posts::activeFeatured()->latest('featured_at')->limit(3)->get();
        return view('home.homepage', compact('posts', 'featuredPosts'));
    }
    
    public function all_posts()
    {
        $posts = Posts::where('post_status', 'active')->latest()->paginate(12);
        return view('home.all_posts', compact('posts'));
    }
    
    public function post_details($id)
    {
        $post = Posts::with(['category', 'tags', 'comments.user'])
                    ->where('id', $id)
                    ->where('post_status', 'active')
                    ->firstOrFail();
                    
        return view('home.post_details', compact('post'));
    }
    
    public function notifications()
    {
        $notifications = Notification::forUser(Auth::id())
                                   ->orderBy('created_at', 'desc')
                                   ->paginate(10);
                                   
        return view('home.notifications', compact('notifications'));
    }
    
    public function getNotificationCount()
    {
        $count = NotificationService::getUnreadCount(Auth::id());
        return response()->json(['count' => $count]);
    }
    
    public function markNotificationRead($id)
    {
        $notification = Notification::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->first();
                                  
        if ($notification) {
            $notification->update(['is_read' => true]);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }
    
    public function markAllNotificationsRead()
    {
        NotificationService::markAllAsRead(Auth::id());
        return response()->json(['success' => true]);
    }
}
