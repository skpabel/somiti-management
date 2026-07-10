<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    // ✅ ডাটাবেস থেকে সেটিংস এনে ক্যাশে (Cache) করে রাখবে (পারফরম্যান্স ভালো থাকবে)
    public static function get($key, $default = null)
    {
        $settings = Cache::rememberForever('app_settings', function () {
            return static::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    // ✅ নতুন সেটিংস সেভ বা আপডেট করবে এবং ক্যাশে ক্লিয়ার করবে
    public static function set($key, $value)
    {
        Cache::forget('app_settings'); // পুরানো ক্যাশে মুছে ফেলবে

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}