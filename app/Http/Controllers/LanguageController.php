<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Handle language switching
     */
    public function switchLanguage(Request $request)
    {
        $language = $request->input('language');
        
        // Validate language
        if (in_array($language, ['en', 'fr', 'de'])) {
            // Set application locale
            App::setLocale($language);
            
            // Store in session
            Session::put('locale', $language);
            
            return response()->json([
                'success' => true,
                'message' => 'Language switched successfully',
                'language' => $language
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid language'
        ], 400);
    }
    
    /**
     * Get current language
     */
    public function getCurrentLanguage()
    {
        return response()->json([
            'current_language' => App::getLocale(),
            'available_languages' => [
                'en' => 'English',
                'fr' => 'Français', 
                'de' => 'Deutsch'
            ]
        ]);
    }
}
