<?php

namespace App\Helpers;

class Helper
{
    public static function getCurrentLanguage()
    {
        try {
            return auth()->check() ? (auth()->user()->language ?? 'bn') : 'bn';
        } catch (\Exception $e) {
            return 'bn'; // Default fallback
        }
    }

    public static function __lang($bn_text, $en_text = null)
    {
        try {
            $lang = self::getCurrentLanguage();
            
            if ($lang === 'en' && $en_text) {
                return $en_text;
            }
            
            return $bn_text;
        } catch (\Exception $e) {
            return $bn_text; // Default to Bengali text
        }
    }
}