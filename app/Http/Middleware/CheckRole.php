<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * এই মিডলওয়্যার চেক করবে ইউজারের কাছে নির্দিষ্ট রোল আছে কিনা।
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // ইউজার লগইন করা না থাকলে লগইন পেজে পাঠিয়ে দেওয়া
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // চেক করা ইউজারের কাছে রিকোয়ার্ড রোলগুলোর মধ্যে কোনোটি আছে কিনা
        foreach ($roles as $role) {
            if ($role === 'super_admin' && $user->isSuperAdmin()) {
                return $next($request);
            }
            if ($role === 'admin' && $user->isAdmin()) {
                return $next($request);
            }
            if ($role === 'user' && $user->isUser()) {
                return $next($request);
            }
        }

        // রোল না থাকলে 403 এরর দেখানো
        abort(403, '⛔ আপনার এই পৃষ্ঠায় অ্যাক্সেস করার অনুমতি নেই!');
    }
}