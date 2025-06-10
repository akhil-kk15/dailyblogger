<!DOCTYPE html>
<html>
<head>
    @include('admin.admincss')
    <style>
        .settings-container {
            padding: 30px;
            background: #f8f9fa;
            min-height: 100vh;
        }
        .settings-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
        }
        .settings-title i {
            margin-right: 10px;
            color: #3498db;
        }
        
        .settings-nav {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        .settings-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }
        .settings-nav li {
            flex: 1;
        }
        .settings-nav a {
            display: block;
            padding: 20px;
            text-decoration: none;
            color: #666;
            font-weight: 600;
            text-align: center;
            border-right: 1px solid #eee;
            transition: all 0.3s ease;
            position: relative;
        }
        .settings-nav a:hover,
        .settings-nav a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .settings-nav a i {
            display: block;
            font-size: 24px;
            margin-bottom: 8px;
        }
        .settings-nav li:last-child a {
            border-right: none;
        }
        
        .settings-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 40px;
        }
        .settings-section {
            display: none;
        }
        .settings-section.active {
            display: block;
        }
        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
        }
        .section-title i {
            margin-right: 10px;
            color: #3498db;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            outline: none;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        .form-col {
            flex: 1;
        }
        
        .switch-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #3498db;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }
        .btn-success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        .btn-warning {
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            color: #2c3e50;
        }
        .btn-danger {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            color: white;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: none;
        }
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }
        .alert-error {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }
        
        .file-upload {
            position: relative;
            display: inline-block;
        }
        .file-upload input[type=file] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        .file-upload-label {
            display: inline-block;
            padding: 10px 20px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .file-upload-label:hover {
            background: #e9ecef;
            border-color: #3498db;
        }
        
        .color-picker {
            width: 60px;
            height: 40px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .settings-nav ul {
                flex-direction: column;
            }
            .settings-nav a {
                border-right: none;
                border-bottom: 1px solid #eee;
            }
            .form-row {
                flex-direction: column;
            }
            .settings-container {
                padding: 15px;
            }
            .settings-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')
        
        <div class="settings-container">
            <h1 class="settings-title">
                <i class="fa fa-cogs"></i>{{ __('admin.system_settings') }}
            </h1>
            
            <!-- Settings Navigation -->
            <div class="settings-nav">
                <ul>
                    <li><a href="#general" class="nav-link active" data-section="general">
                        <i class="fa fa-globe"></i>
                        {{ __('admin.general') }}
                    </a></li>
                    <li><a href="#mail" class="nav-link" data-section="mail">
                        <i class="fa fa-envelope"></i>
                        {{ __('admin.mail_settings') }}
                    </a></li>
                    <li><a href="#appearance" class="nav-link" data-section="appearance">
                        <i class="fa fa-paint-brush"></i>
                        {{ __('admin.appearance') }}
                    </a></li>
                    <li><a href="#security" class="nav-link" data-section="security">
                        <i class="fa fa-shield"></i>
                        {{ __('admin.security') }}
                    </a></li>
                    <li><a href="#social" class="nav-link" data-section="social">
                        <i class="fa fa-share-alt"></i>
                        {{ __('admin.social_media') }}
                    </a></li>
                    <li><a href="#system" class="nav-link" data-section="system">
                        <i class="fa fa-server"></i>
                        {{ __('admin.system') }}
                    </a></li>
                </ul>
            </div>
            
            <!-- Settings Content -->
            <div class="settings-content">
                <!-- General Settings -->
                <div class="settings-section active" id="general">
                    <h2 class="section-title">
                        <i class="fa fa-globe"></i>{{ __('admin.general_settings') }}
                    </h2>
                    <form id="general-form">
                        @csrf
                        <div class="form-group">
                            <label for="site_name">{{ __('admin.site_name') }}</label>
                            <input type="text" id="site_name" name="site_name" class="form-control" 
                                   value="{{ $generalSettings['site_name']->value ?? 'Daily Blogger' }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="site_description">{{ __('admin.site_description') }}</label>
                            <textarea id="site_description" name="site_description" class="form-control" rows="3">{{ $generalSettings['site_description']->value ?? '' }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="site_keywords">{{ __('admin.site_keywords') }}</label>
                            <input type="text" id="site_keywords" name="site_keywords" class="form-control" 
                                   value="{{ $generalSettings['site_keywords']->value ?? '' }}" 
                                   placeholder="blog, news, articles">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <label for="admin_email">{{ __('admin.admin_email') }}</label>
                                <input type="email" id="admin_email" name="admin_email" class="form-control" 
                                       value="{{ $generalSettings['admin_email']->value ?? '' }}" required>
                            </div>
                            <div class="form-col">
                                <label for="posts_per_page">{{ __('admin.posts_per_page') }}</label>
                                <input type="number" id="posts_per_page" name="posts_per_page" class="form-control" 
                                       value="{{ $generalSettings['posts_per_page']->value ?? 10 }}" min="1" max="50">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <div class="switch-container">
                                    <label class="switch">
                                        <input type="checkbox" name="allow_comments" 
                                               {{ ($generalSettings['allow_comments']->value ?? true) ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                    <label>{{ __('admin.allow_comments') }}</label>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="switch-container">
                                    <label class="switch">
                                        <input type="checkbox" name="require_approval" 
                                               {{ ($generalSettings['require_approval']->value ?? true) ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                    <label>{{ __('admin.require_approval') }}</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="switch-container">
                                <label class="switch">
                                    <input type="checkbox" name="maintenance_mode" 
                                           {{ ($generalSettings['maintenance_mode']->value ?? false) ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <label>{{ __('admin.maintenance_mode') }}</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('admin.save_changes') }}
                        </button>
                    </form>
                </div>

                <!-- Mail Settings -->
                <div class="settings-section" id="mail">
                    <h2 class="section-title">
                        <i class="fa fa-envelope"></i>{{ __('admin.mail_settings') }}
                    </h2>
                    <form id="mail-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-col">
                                <label for="mail_driver">{{ __('admin.mail_driver') }}</label>
                                <select id="mail_driver" name="mail_driver" class="form-control">
                                    <option value="smtp" {{ ($mailSettings['mail_driver']->value ?? 'smtp') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                    <option value="sendmail" {{ ($mailSettings['mail_driver']->value ?? '') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                    <option value="mailgun" {{ ($mailSettings['mail_driver']->value ?? '') == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                    <option value="ses" {{ ($mailSettings['mail_driver']->value ?? '') == 'ses' ? 'selected' : '' }}>Amazon SES</option>
                                </select>
                            </div>
                            <div class="form-col">
                                <label for="mail_host">{{ __('admin.mail_host') }}</label>
                                <input type="text" id="mail_host" name="mail_host" class="form-control" 
                                       value="{{ $mailSettings['mail_host']->value ?? '' }}" placeholder="smtp.gmail.com">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <label for="mail_port">{{ __('admin.mail_port') }}</label>
                                <input type="number" id="mail_port" name="mail_port" class="form-control" 
                                       value="{{ $mailSettings['mail_port']->value ?? 587 }}">
                            </div>
                            <div class="form-col">
                                <label for="mail_encryption">{{ __('admin.mail_encryption') }}</label>
                                <select id="mail_encryption" name="mail_encryption" class="form-control">
                                    <option value="">None</option>
                                    <option value="tls" {{ ($mailSettings['mail_encryption']->value ?? 'tls') == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ ($mailSettings['mail_encryption']->value ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <label for="mail_username">{{ __('admin.mail_username') }}</label>
                                <input type="text" id="mail_username" name="mail_username" class="form-control" 
                                       value="{{ $mailSettings['mail_username']->value ?? '' }}">
                            </div>
                            <div class="form-col">
                                <label for="mail_password">{{ __('admin.mail_password') }}</label>
                                <input type="password" id="mail_password" name="mail_password" class="form-control" 
                                       value="{{ $mailSettings['mail_password']->value ?? '' }}">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <label for="mail_from_address">{{ __('admin.mail_from_address') }}</label>
                                <input type="email" id="mail_from_address" name="mail_from_address" class="form-control" 
                                       value="{{ $mailSettings['mail_from_address']->value ?? '' }}" required>
                            </div>
                            <div class="form-col">
                                <label for="mail_from_name">{{ __('admin.mail_from_name') }}</label>
                                <input type="text" id="mail_from_name" name="mail_from_name" class="form-control" 
                                       value="{{ $mailSettings['mail_from_name']->value ?? 'Daily Blogger' }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> {{ __('admin.save_changes') }}
                            </button>
                            <button type="button" class="btn btn-success" id="test-email-btn">
                                <i class="fa fa-paper-plane"></i> {{ __('admin.test_email') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Appearance Settings -->
                <div class="settings-section" id="appearance">
                    <h2 class="section-title">
                        <i class="fa fa-paint-brush"></i>{{ __('admin.appearance_settings') }}
                    </h2>
                    <form id="appearance-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-col">
                                <label for="theme">{{ __('admin.theme') }}</label>
                                <select id="theme" name="theme" class="form-control">
                                    <option value="light" {{ ($appearanceSettings['theme']->value ?? 'light') == 'light' ? 'selected' : '' }}>Light</option>
                                    <option value="dark" {{ ($appearanceSettings['theme']->value ?? '') == 'dark' ? 'selected' : '' }}>Dark</option>
                                    <option value="blue" {{ ($appearanceSettings['theme']->value ?? '') == 'blue' ? 'selected' : '' }}>Blue</option>
                                    <option value="green" {{ ($appearanceSettings['theme']->value ?? '') == 'green' ? 'selected' : '' }}>Green</option>
                                </select>
                            </div>
                            <div class="form-col">
                                <label for="primary_color">{{ __('admin.primary_color') }}</label>
                                <input type="color" id="primary_color" name="primary_color" class="color-picker" 
                                       value="{{ $appearanceSettings['primary_color']->value ?? '#3498db' }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="logo">{{ __('admin.logo') }}</label>
                            <div class="file-upload">
                                <input type="file" id="logo" name="logo" accept="image/*">
                                <label for="logo" class="file-upload-label">
                                    <i class="fa fa-upload"></i> {{ __('admin.choose_logo') }}
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="custom_css">{{ __('admin.custom_css') }}</label>
                            <textarea id="custom_css" name="custom_css" class="form-control" rows="10">{{ $appearanceSettings['custom_css']->value ?? '' }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('admin.save_changes') }}
                        </button>
                    </form>
                </div>

                <!-- Security Settings -->
                <div class="settings-section" id="security">
                    <h2 class="section-title">
                        <i class="fa fa-shield"></i>{{ __('admin.security_settings') }}
                    </h2>
                    <form id="security-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-col">
                                <div class="switch-container">
                                    <label class="switch">
                                        <input type="checkbox" name="enable_registration" 
                                               {{ ($securitySettings['enable_registration']->value ?? true) ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                    <label>{{ __('admin.enable_registration') }}</label>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="switch-container">
                                    <label class="switch">
                                        <input type="checkbox" name="require_email_verification" 
                                               {{ ($securitySettings['require_email_verification']->value ?? false) ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                    <label>{{ __('admin.require_email_verification') }}</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <label for="session_lifetime">{{ __('admin.session_lifetime') }} (minutes)</label>
                                <input type="number" id="session_lifetime" name="session_lifetime" class="form-control" 
                                       value="{{ $securitySettings['session_lifetime']->value ?? 120 }}" min="5" max="1440">
                            </div>
                            <div class="form-col">
                                <label for="max_login_attempts">{{ __('admin.max_login_attempts') }}</label>
                                <input type="number" id="max_login_attempts" name="max_login_attempts" class="form-control" 
                                       value="{{ $securitySettings['max_login_attempts']->value ?? 5 }}" min="1" max="10">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('admin.save_changes') }}
                        </button>
                    </form>
                </div>

                <!-- Social Media Settings -->
                <div class="settings-section" id="social">
                    <h2 class="section-title">
                        <i class="fa fa-share-alt"></i>{{ __('admin.social_media_settings') }}
                    </h2>
                    <form id="social-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-col">
                                <label for="facebook_url">{{ __('admin.facebook_url') }}</label>
                                <input type="url" id="facebook_url" name="facebook_url" class="form-control" 
                                       value="{{ $socialSettings['facebook_url']->value ?? '' }}">
                            </div>
                            <div class="form-col">
                                <label for="twitter_url">{{ __('admin.twitter_url') }}</label>
                                <input type="url" id="twitter_url" name="twitter_url" class="form-control" 
                                       value="{{ $socialSettings['twitter_url']->value ?? '' }}">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-col">
                                <label for="instagram_url">{{ __('admin.instagram_url') }}</label>
                                <input type="url" id="instagram_url" name="instagram_url" class="form-control" 
                                       value="{{ $socialSettings['instagram_url']->value ?? '' }}">
                            </div>
                            <div class="form-col">
                                <label for="linkedin_url">{{ __('admin.linkedin_url') }}</label>
                                <input type="url" id="linkedin_url" name="linkedin_url" class="form-control" 
                                       value="{{ $socialSettings['linkedin_url']->value ?? '' }}">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('admin.save_changes') }}
                        </button>
                    </form>
                </div>

                <!-- System Settings -->
                <div class="settings-section" id="system">
                    <h2 class="section-title">
                        <i class="fa fa-server"></i>{{ __('admin.system_settings') }}
                    </h2>
                    
                    <!-- System Information -->
                    <div class="form-group">
                        <h3 style="color: #2c3e50; margin-bottom: 15px;">System Information</h3>
                        <div class="form-row">
                            <div class="form-col">
                                <label>Laravel Version</label>
                                <input type="text" class="form-control" value="{{ app()->version() }}" readonly>
                            </div>
                            <div class="form-col">
                                <label>PHP Version</label>
                                <input type="text" class="form-control" value="{{ PHP_VERSION }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label>Database</label>
                                <input type="text" class="form-control" value="SQLite" readonly>
                            </div>
                            <div class="form-col">
                                <label>Environment</label>
                                <input type="text" class="form-control" value="{{ app()->environment() }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <!-- System Actions -->
                    <div class="form-group">
                        <h3 style="color: #2c3e50; margin-bottom: 15px;">System Actions</h3>
                        <div class="form-row">
                            <div class="form-col">
                                <button type="button" class="btn btn-warning" id="clear-cache-btn">
                                    <i class="fa fa-refresh"></i> {{ __('admin.clear_cache') }}
                                </button>
                            </div>
                            <div class="form-col">
                                <a href="{{ route('admin.settings.backup') }}" class="btn btn-success">
                                    <i class="fa fa-download"></i> {{ __('admin.backup_database') }}
                                </a>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 15px;">
                            <div class="form-col">
                                <a href="{{ route('admin.settings.export') }}" class="btn btn-primary">
                                    <i class="fa fa-download"></i> Export Settings
                                </a>
                            </div>
                            <div class="form-col">
                                <div class="file-upload">
                                    <input type="file" id="import-settings" accept=".json" style="display: none;">
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('import-settings').click()">
                                        <i class="fa fa-upload"></i> Import Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 15px;">
                            <div class="form-col">
                                <button type="button" class="btn btn-primary" onclick="window.open('{{ route('home.homepage') }}', '_blank')">
                                    <i class="fa fa-external-link"></i> {{ __('admin.view_website') }}
                                </button>
                            </div>
                            <div class="form-col">
                                <button type="button" class="btn btn-danger" onclick="confirmLogout()">
                                    <i class="fa fa-sign-out"></i> {{ __('admin.logout') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Storage Information -->
                    <div class="form-group">
                        <h3 style="color: #2c3e50; margin-bottom: 15px;">Storage Information</h3>
                        <div class="form-row">
                            <div class="form-col">
                                <label>Total Posts</label>
                                <input type="text" class="form-control" value="{{ \App\Models\Posts::count() }}" readonly>
                            </div>
                            <div class="form-col">
                                <label>Total Users</label>
                                <input type="text" class="form-control" value="{{ \App\Models\User::count() }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label>Total Comments</label>
                                <input type="text" class="form-control" value="{{ \App\Models\Comment::count() }}" readonly>
                            </div>
                            <div class="form-col">
                                <label>Total Categories</label>
                                <input type="text" class="form-control" value="{{ \App\Models\Category::count() }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Settings navigation
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links and sections
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Show corresponding section
                const sectionId = this.getAttribute('data-section');
                document.getElementById(sectionId).classList.add('active');
            });
        });

        // Form submissions
        document.getElementById('general-form').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(this, '{{ route("admin.settings.general") }}');
        });

        document.getElementById('mail-form').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(this, '{{ route("admin.settings.mail") }}');
        });

        document.getElementById('appearance-form').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(this, '{{ route("admin.settings.appearance") }}', true);
        });

        document.getElementById('security-form').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(this, '{{ route("admin.settings.security") }}');
        });

        document.getElementById('social-form').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm(this, '{{ route("admin.settings.social") }}');
        });

        // Test email button
        document.getElementById('test-email-btn').addEventListener('click', function() {
            const email = prompt('Enter email address to send test email:');
            if (email) {
                fetch('{{ route("admin.settings.test_email") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ test_email: email })
                })
                .then(response => response.json())
                .then(data => {
                    showAlert(data.success ? 'success' : 'error', data.message);
                });
            }
        });

        // Clear cache button
        document.getElementById('clear-cache-btn').addEventListener('click', function() {
            if (confirm('Are you sure you want to clear the cache?')) {
                fetch('{{ route("admin.settings.clear_cache") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    showAlert(data.success ? 'success' : 'error', data.message);
                });
            }
        });

        // Settings import
        document.getElementById('import-settings').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (confirm('Are you sure you want to import settings? This will overwrite existing settings.')) {
                    const formData = new FormData();
                    formData.append('settings_file', file);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    fetch('{{ route("admin.settings.import") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        showAlert(data.success ? 'success' : 'error', data.message);
                        if (data.success) {
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        showAlert('error', 'Error importing settings.');
                    });
                }
                // Reset the file input
                e.target.value = '';
            }
        });

        function submitForm(form, url, hasFiles = false) {
            const formData = hasFiles ? new FormData(form) : new FormData(form);
            
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: hasFiles ? {} : {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                showAlert(data.success ? 'success' : 'error', data.message);
            })
            .catch(error => {
                showAlert('error', 'An error occurred while saving settings.');
            });
        }

        function showAlert(type, message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.textContent = message;
            
            const container = document.querySelector('.settings-content');
            container.insertBefore(alertDiv, container.firstChild);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // Create and submit logout form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("logout") }}';
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
