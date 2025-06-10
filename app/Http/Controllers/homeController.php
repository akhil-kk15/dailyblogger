<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
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
        return view('home.homepage', compact('posts'));
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
}
