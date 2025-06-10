<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait AdminCheck
{
    protected function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            return redirect()->route('home.homepage')->with('error', 'You do not have permission to access this area.');
        }
        return null;
    }
}
