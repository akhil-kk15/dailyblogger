<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function __construct()
    {
        // Check if user is admin in each method instead of middleware
    }

    /**
     * Display the settings page
     */
    public function index()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Get all settings grouped by category
        $generalSettings = Setting::where('group', 'general')->get()->keyBy('key');
        $mailSettings = Setting::where('group', 'mail')->get()->keyBy('key');
        $appearanceSettings = Setting::where('group', 'appearance')->get()->keyBy('key');
        $securitySettings = Setting::where('group', 'security')->get()->keyBy('key');
        $socialSettings = Setting::where('group', 'social')->get()->keyBy('key');

        return view('admin.settings.index', compact(
            'generalSettings',
            'mailSettings', 
            'appearanceSettings',
            'securitySettings',
            'socialSettings'
        ));
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_keywords' => 'nullable|string|max:255',
            'admin_email' => 'required|email|max:255',
            'posts_per_page' => 'required|integer|min:1|max:50',
            'allow_comments' => 'boolean',
            'require_approval' => 'boolean',
            'maintenance_mode' => 'boolean',
        ]);

        try {
            Setting::set('site_name', $request->site_name, 'string', 'general', 'Website name');
            Setting::set('site_description', $request->site_description, 'string', 'general', 'Website description');
            Setting::set('site_keywords', $request->site_keywords, 'string', 'general', 'SEO keywords');
            Setting::set('admin_email', $request->admin_email, 'string', 'general', 'Administrator email');
            Setting::set('posts_per_page', $request->posts_per_page, 'integer', 'general', 'Posts per page');
            Setting::set('allow_comments', $request->boolean('allow_comments'), 'boolean', 'general', 'Allow comments');
            Setting::set('require_approval', $request->boolean('require_approval'), 'boolean', 'general', 'Require comment approval');
            Setting::set('maintenance_mode', $request->boolean('maintenance_mode'), 'boolean', 'general', 'Maintenance mode');

            // Clear cache
            Cache::flush();

            return response()->json([
                'success' => true,
                'message' => 'General settings updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update mail settings
     */
    public function updateMail(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'mail_driver' => 'required|string|in:smtp,sendmail,mailgun,ses,postmark',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|integer',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|in:tls,ssl',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        try {
            Setting::set('mail_driver', $request->mail_driver, 'string', 'mail', 'Mail driver');
            Setting::set('mail_host', $request->mail_host, 'string', 'mail', 'SMTP host');
            Setting::set('mail_port', $request->mail_port, 'integer', 'mail', 'SMTP port');
            Setting::set('mail_username', $request->mail_username, 'string', 'mail', 'SMTP username');
            Setting::set('mail_password', $request->mail_password, 'string', 'mail', 'SMTP password');
            Setting::set('mail_encryption', $request->mail_encryption, 'string', 'mail', 'Mail encryption');
            Setting::set('mail_from_address', $request->mail_from_address, 'string', 'mail', 'From email address');
            Setting::set('mail_from_name', $request->mail_from_name, 'string', 'mail', 'From name');

            return response()->json([
                'success' => true,
                'message' => 'Mail settings updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating mail settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update appearance settings
     */
    public function updateAppearance(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'theme' => 'required|string|in:light,dark,blue,green',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
            'custom_css' => 'nullable|string',
        ]);

        try {
            Setting::set('theme', $request->theme, 'string', 'appearance', 'Website theme');
            Setting::set('primary_color', $request->primary_color, 'string', 'appearance', 'Primary color');
            Setting::set('secondary_color', $request->secondary_color, 'string', 'appearance', 'Secondary color');
            Setting::set('custom_css', $request->custom_css, 'string', 'appearance', 'Custom CSS');

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('uploads/settings', 'public');
                Setting::set('logo_path', $logoPath, 'string', 'appearance', 'Logo file path');
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                $faviconPath = $request->file('favicon')->store('uploads/settings', 'public');
                Setting::set('favicon_path', $faviconPath, 'string', 'appearance', 'Favicon file path');
            }

            return response()->json([
                'success' => true,
                'message' => 'Appearance settings updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating appearance settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update security settings
     */
    public function updateSecurity(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'enable_registration' => 'boolean',
            'require_email_verification' => 'boolean',
            'enable_captcha' => 'boolean',
            'captcha_site_key' => 'nullable|string|max:255',
            'captcha_secret_key' => 'nullable|string|max:255',
            'session_lifetime' => 'required|integer|min:5|max:1440',
            'max_login_attempts' => 'required|integer|min:1|max:10',
        ]);

        try {
            Setting::set('enable_registration', $request->boolean('enable_registration'), 'boolean', 'security', 'Enable user registration');
            Setting::set('require_email_verification', $request->boolean('require_email_verification'), 'boolean', 'security', 'Require email verification');
            Setting::set('enable_captcha', $request->boolean('enable_captcha'), 'boolean', 'security', 'Enable reCAPTCHA');
            Setting::set('captcha_site_key', $request->captcha_site_key, 'string', 'security', 'reCAPTCHA site key');
            Setting::set('captcha_secret_key', $request->captcha_secret_key, 'string', 'security', 'reCAPTCHA secret key');
            Setting::set('session_lifetime', $request->session_lifetime, 'integer', 'security', 'Session lifetime (minutes)');
            Setting::set('max_login_attempts', $request->max_login_attempts, 'integer', 'security', 'Max login attempts');

            return response()->json([
                'success' => true,
                'message' => 'Security settings updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating security settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update social media settings
     */
    public function updateSocial(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'enable_social_login' => 'boolean',
            'facebook_app_id' => 'nullable|string|max:255',
            'facebook_app_secret' => 'nullable|string|max:255',
            'twitter_api_key' => 'nullable|string|max:255',
            'twitter_api_secret' => 'nullable|string|max:255',
        ]);

        try {
            Setting::set('facebook_url', $request->facebook_url, 'string', 'social', 'Facebook page URL');
            Setting::set('twitter_url', $request->twitter_url, 'string', 'social', 'Twitter profile URL');
            Setting::set('instagram_url', $request->instagram_url, 'string', 'social', 'Instagram profile URL');
            Setting::set('linkedin_url', $request->linkedin_url, 'string', 'social', 'LinkedIn profile URL');
            Setting::set('youtube_url', $request->youtube_url, 'string', 'social', 'YouTube channel URL');
            Setting::set('enable_social_login', $request->boolean('enable_social_login'), 'boolean', 'social', 'Enable social login');
            Setting::set('facebook_app_id', $request->facebook_app_id, 'string', 'social', 'Facebook App ID');
            Setting::set('facebook_app_secret', $request->facebook_app_secret, 'string', 'social', 'Facebook App Secret');
            Setting::set('twitter_api_key', $request->twitter_api_key, 'string', 'social', 'Twitter API Key');
            Setting::set('twitter_api_secret', $request->twitter_api_secret, 'string', 'social', 'Twitter API Secret');

            return response()->json([
                'success' => true,
                'message' => 'Social media settings updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating social settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test email configuration
     */
    public function testEmail(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'test_email' => 'required|email'
        ]);

        try {
            // Send test email
            Mail::raw('This is a test email from Daily Blogger admin panel.', function ($message) use ($request) {
                $message->to($request->test_email)
                        ->subject('Test Email - Daily Blogger');
            });

            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error sending test email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear cache
     */
    public function clearCache()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            Cache::flush();
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            return response()->json([
                'success' => true,
                'message' => 'Cache cleared successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing cache: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Backup database
     */
    public function backupDatabase()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            $timestamp = now()->format('Y-m-d_H-i-s');
            $filename = "backup_dailyblogger_{$timestamp}.sql";
            
            // Create backup directory if it doesn't exist
            $backupPath = storage_path('app/backups');
            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0755, true);
            }

            // Simple backup for SQLite
            $dbPath = database_path('database.sqlite');
            $backupFilePath = $backupPath . '/' . $filename;
            
            if (file_exists($dbPath)) {
                copy($dbPath, $backupFilePath);
                
                return response()->download($backupFilePath, $filename)->deleteFileAfterSend(true);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Database file not found!'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating backup: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export settings as JSON
     */
    public function exportSettings()
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        try {
            $settings = Setting::all()->map(function ($setting) {
                return [
                    'key' => $setting->key,
                    'value' => $setting->value,
                    'type' => $setting->type,
                    'group' => $setting->group,
                    'description' => $setting->description,
                ];
            });

            $timestamp = now()->format('Y-m-d_H-i-s');
            $filename = "settings_export_{$timestamp}.json";

            return response()->json($settings)
                ->header('Content-Disposition', "attachment; filename={$filename}");
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error exporting settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Import settings from JSON
     */
    public function importSettings(Request $request)
    {
        // Check if user is admin
        if (!Auth::check() || Auth::user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'settings_file' => 'required|file|mimes:json'
        ]);

        try {
            $file = $request->file('settings_file');
            $content = file_get_contents($file->path());
            $settings = json_decode($content, true);

            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid JSON file format.'
                ], 400);
            }

            $imported = 0;
            foreach ($settings as $setting) {
                if (isset($setting['key']) && isset($setting['value'])) {
                    Setting::updateOrCreate(
                        ['key' => $setting['key']],
                        [
                            'value' => $setting['value'],
                            'type' => $setting['type'] ?? 'string',
                            'group' => $setting['group'] ?? null,
                            'description' => $setting['description'] ?? null,
                        ]
                    );
                    $imported++;
                }
            }

            // Clear cache after import
            Cache::flush();

            return response()->json([
                'success' => true,
                'message' => "Successfully imported {$imported} settings."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error importing settings: ' . $e->getMessage()
            ], 500);
        }
    }
}
