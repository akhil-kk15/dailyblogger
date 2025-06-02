<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;

class adminController extends Controller
{

    public function post_page()
    {
        return view('admin.post_page');
    }
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth::user()->usertype;
            
            if($usertype == 'user'){
                return view('home.homepage');
            }
            else if($usertype == 'admin'){
                return view('admin.adminhome');
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

    
        $post = new Posts;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_status = 'active';
        $image = $request->image;
        if($image)
        {
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage', $imagename);
        $post->image = $imagename;
    }

        $post ->id =$user_id = Auth::id(); // This line is not necessary, as you can directly use Auth::id() later
        //user_id and userid from different tables 



        //logged in user_id
        $post->name = Auth::user()->name;
        $post->user_id = Auth::id();
        $post->usertype = Auth::user()->usertype;
        $post->save();
        return redirect()->back()->with('message', 'Post added successfully');
    }
}
