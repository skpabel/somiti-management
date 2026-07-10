<?php

// Global helper functions
if (!function_exists('getCurrentLanguage')) {
    function getCurrentLanguage()
    {
        try {
            return auth()->check() ? (auth()->user()->language ?? 'bn') : 'bn';
        } catch (\Exception $e) {
            return 'bn'; // Default fallback
        }
    }
}

if (!function_exists('__lang')) {
    function __lang($bn_text, $en_text = null)
    {
        try {
            $lang = getCurrentLanguage();
            
            if ($lang === 'en' && $en_text) {
                return $en_text;
            }
            
            return $bn_text;
        } catch (\Exception $e) {
            return $bn_text; // Default to Bengali text
        }
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        if (!$date) return 'N/A';
        
        $date_format = \App\Models\Setting::get('date_format', 'd M, Y');
        $timezone = \App\Models\Setting::get('timezone', 'Asia/Dhaka');
        
        try {
            return \Carbon\Carbon::parse($date)->timezone($timezone)->format($date_format);
        } catch (\Exception $e) {
            return $date;
        }
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($date)
    {
        if (!$date) return 'N/A';
        
        $date_format = \App\Models\Setting::get('date_format', 'd M, Y');
        $time_format = \App\Models\Setting::get('time_format', 'h:i A');
        $timezone = \App\Models\Setting::get('timezone', 'Asia/Dhaka');
        
        try {
            $carbon = \Carbon\Carbon::parse($date)->timezone($timezone);
            
            // যদি টাইম 00:00:00 হয় (পুরোনো date টাইপ ডাটা), শুধু date দেখাবো
            if ($carbon->format('H:i:s') === '00:00:00') {
                return $carbon->format($date_format);
            }
            
            // আসল টাইম থাকলে date + time দেখাবো
            return $carbon->format($date_format . ' ' . $time_format);
        } catch (\Exception $e) {
            return $date;
        }
    }
}