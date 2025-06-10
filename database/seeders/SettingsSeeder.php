<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSettings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Daily Blogger', 'type' => 'string', 'group' => 'general', 'description' => 'Website name'],
            ['key' => 'site_description', 'value' => 'A modern blogging platform for sharing ideas and stories', 'type' => 'string', 'group' => 'general', 'description' => 'Website description'],
            ['key' => 'site_keywords', 'value' => 'blog, news, articles, stories, daily blogger', 'type' => 'string', 'group' => 'general', 'description' => 'SEO keywords'],
            ['key' => 'admin_email', 'value' => 'admin@dailyblogger.com', 'type' => 'string', 'group' => 'general', 'description' => 'Administrator email'],
            ['key' => 'posts_per_page', 'value' => '10', 'type' => 'integer', 'group' => 'general', 'description' => 'Posts per page'],
            ['key' => 'allow_comments', 'value' => '1', 'type' => 'boolean', 'group' => 'general', 'description' => 'Allow comments'],
            ['key' => 'require_approval', 'value' => '1', 'type' => 'boolean', 'group' => 'general', 'description' => 'Require comment approval'],
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'group' => 'general', 'description' => 'Maintenance mode'],

            // Mail Settings
            ['key' => 'mail_driver', 'value' => 'smtp', 'type' => 'string', 'group' => 'mail', 'description' => 'Mail driver'],
            ['key' => 'mail_host', 'value' => 'smtp.gmail.com', 'type' => 'string', 'group' => 'mail', 'description' => 'SMTP host'],
            ['key' => 'mail_port', 'value' => '587', 'type' => 'integer', 'group' => 'mail', 'description' => 'SMTP port'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'type' => 'string', 'group' => 'mail', 'description' => 'Mail encryption'],
            ['key' => 'mail_from_address', 'value' => 'noreply@dailyblogger.com', 'type' => 'string', 'group' => 'mail', 'description' => 'From email address'],
            ['key' => 'mail_from_name', 'value' => 'Daily Blogger', 'type' => 'string', 'group' => 'mail', 'description' => 'From name'],

            // Appearance Settings
            ['key' => 'theme', 'value' => 'light', 'type' => 'string', 'group' => 'appearance', 'description' => 'Website theme'],
            ['key' => 'primary_color', 'value' => '#3498db', 'type' => 'string', 'group' => 'appearance', 'description' => 'Primary color'],
            ['key' => 'secondary_color', 'value' => '#2ecc71', 'type' => 'string', 'group' => 'appearance', 'description' => 'Secondary color'],

            // Security Settings
            ['key' => 'enable_registration', 'value' => '1', 'type' => 'boolean', 'group' => 'security', 'description' => 'Enable user registration'],
            ['key' => 'require_email_verification', 'value' => '0', 'type' => 'boolean', 'group' => 'security', 'description' => 'Require email verification'],
            ['key' => 'enable_captcha', 'value' => '0', 'type' => 'boolean', 'group' => 'security', 'description' => 'Enable reCAPTCHA'],
            ['key' => 'session_lifetime', 'value' => '120', 'type' => 'integer', 'group' => 'security', 'description' => 'Session lifetime (minutes)'],
            ['key' => 'max_login_attempts', 'value' => '5', 'type' => 'integer', 'group' => 'security', 'description' => 'Max login attempts'],

            // Social Media Settings
            ['key' => 'facebook_url', 'value' => '', 'type' => 'string', 'group' => 'social', 'description' => 'Facebook page URL'],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'string', 'group' => 'social', 'description' => 'Twitter profile URL'],
            ['key' => 'instagram_url', 'value' => '', 'type' => 'string', 'group' => 'social', 'description' => 'Instagram profile URL'],
            ['key' => 'linkedin_url', 'value' => '', 'type' => 'string', 'group' => 'social', 'description' => 'LinkedIn profile URL'],
            ['key' => 'youtube_url', 'value' => '', 'type' => 'string', 'group' => 'social', 'description' => 'YouTube channel URL'],
            ['key' => 'enable_social_login', 'value' => '0', 'type' => 'boolean', 'group' => 'social', 'description' => 'Enable social login'],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
