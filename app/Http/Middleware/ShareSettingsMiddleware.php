<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class ShareSettingsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Share common settings with all views
        $settings = [
            'site_name' => Setting::get('site_name', 'Daily Blogger'),
            'site_description' => Setting::get('site_description', ''),
            'admin_email' => Setting::get('admin_email', ''),
            'allow_comments' => Setting::get('allow_comments', true),
            'maintenance_mode' => Setting::get('maintenance_mode', false),
            'theme' => Setting::get('theme', 'light'),
            'primary_color' => Setting::get('primary_color', '#3498db'),
        ];

        View::share('siteSettings', $settings);

        return $next($request);
    }
}
