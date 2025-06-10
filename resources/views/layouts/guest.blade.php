<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        
        <!-- Enhanced Form Styling for Better Text Visibility -->
        <style>
            /* Better text contrast for form elements */
            .dark input, .dark textarea, .dark select {
                color: #f3f4f6 !important;
                background-color: #374151 !important;
            }
            
            .dark input::placeholder, .dark textarea::placeholder {
                color: #9ca3af !important;
            }
            
            /* Better link visibility */
            .dark a {
                color: #60a5fa !important;
            }
            
            .dark a:hover {
                color: #93c5fd !important;
            }
            
            /* Enhanced text visibility in all contexts */
            .dark .text-gray-600 {
                color: #d1d5db !important;
            }
            
            .dark .text-gray-900 {
                color: #f9fafb !important;
            }
            
            /* Better visibility for validation errors */
            .dark .text-red-600 {
                color: #fca5a5 !important;
            }
            
            /* Ensure form labels are visible */
            .dark label {
                color: #e5e7eb !important;
            }
            
            /* Better checkbox visibility */
            .dark input[type="checkbox"] {
                background-color: #374151 !important;
                border-color: #6b7280 !important;
            }
            
            .dark input[type="checkbox"]:checked {
                background-color: #6366f1 !important;
                border-color: #6366f1 !important;
            }
        </style>
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <!-- Dark Mode Toggle Button -->
        <button id="darkModeToggle" style="position: fixed !important; top: 20px; right: 20px; width: 60px; height: 60px; background: #4f46e5 !important; color: white !important; border: none; border-radius: 50%; z-index: 999999 !important; cursor: pointer; font-size: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.3); transition: all 0.3s ease;">
            <span id="darkModeIcon">🌙</span>
        </button>
        
        <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
