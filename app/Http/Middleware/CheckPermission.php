<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        
    
        // ইউজার লগইন করা না থাকলে বা পারমিশন না থাকলে
        if (!auth()->check() || !auth()->user()->hasPermission($permission)) {
            abort(403, '⛔ আপনার এই পৃষ্ঠায় অ্যাক্সেস করার অনুমতি নেই!');
        }

        return $next($request);
    }
}