<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckForInstallation
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('install*')) {
            if ($this->isAlreadyInstalled()) {
                return redirect()->route('login');
            }

            return $next($request);
        }

        if (!$this->isAlreadyInstalled()) {
            return redirect()->route('install.welcome');
        }

        return $next($request);
    }

    private function isAlreadyInstalled(): bool
    {
        try {
            DB::connection()->getPdo();

            return Schema::hasTable('users')
                && Schema::hasColumn('users', 'role')
                && DB::table('users')->where('role', 'super_admin')->exists();
        } catch (\Throwable $e) {
            return false;
        }
    }
}
