<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     */
    public function show()
    {
        return view('home.profile', [
            'user' => Auth::user()
        ]);
    }
    
    /**
     * Show the custom profile page instead of Jetstream default.
     */
    public function showCustomProfile()
    {
        return view('home.profile', [
            'user' => Auth::user()
        ]);
    }
}
