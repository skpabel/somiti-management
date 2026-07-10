<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class InstallController extends Controller
{
    public function welcome()
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        return view('install.welcome');
    }

    public function database()
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        return view('install.database');
    }

    public function saveDatabase(Request $request)
    {
        $validated = $request->validate([
            'db_host' => 'required',
            'db_port' => 'required',
            'db_name' => 'required',
            'db_username' => 'required',
            'db_password' => 'nullable',
        ]);

        try {
            $this->createDatabaseIfMissing($validated);
            $this->updateEnv([
                'DB_HOST' => $validated['db_host'],
                'DB_PORT' => $validated['db_port'],
                'DB_DATABASE' => $validated['db_name'],
                'DB_USERNAME' => $validated['db_username'],
                'DB_PASSWORD' => $validated['db_password'] ?? '',
                'SESSION_DRIVER' => 'file',
                'CACHE_STORE' => 'file',
            ]);

            $this->useDatabaseConfig($validated);
            Artisan::call('config:clear');
            $this->runMigrations();

            return redirect()->route('install.admin');
        } catch (\Throwable $e) {
            return back()
                ->withInput($request->except('db_password'))
                ->withErrors(['db_error' => 'Database connection or migration failed: ' . $e->getMessage()]);
        }
    }

    public function migrate()
    {
        try {
            if (!$this->canConnectToDatabase()) {
                return redirect()->route('install.database');
            }

            $this->runMigrations();

            return redirect()->route('install.admin');
        } catch (\Throwable $e) {
            return redirect()
                ->route('install.database')
                ->withErrors(['migrate_error' => 'Migration failed: ' . $e->getMessage()]);
        }
    }

    public function admin()
    {
        if ($this->isInstalled()) {
            return redirect()->route('login');
        }

        if (!$this->canConnectToDatabase()) {
            return redirect()->route('install.database');
        }

        try {
            $this->runMigrations();
        } catch (\Throwable $e) {
            return redirect()
                ->route('install.database')
                ->withErrors(['migrate_error' => 'Migration failed: ' . $e->getMessage()]);
        }

        return view('install.admin');
    }

    public function saveAdmin(Request $request)
    {
        if (!$this->canConnectToDatabase()) {
            return redirect()->route('install.database');
        }

        try {
            $this->runMigrations();
        } catch (\Throwable $e) {
            return back()->withErrors(['admin_error' => 'Migration failed: ' . $e->getMessage()]);
        }

        if ($this->hasSuperAdmin()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'phone' => $this->uniqueInstallPhone(),
                'email' => $request->username . '@somiti.local',
                'password' => Hash::make($request->password),
                'role' => 'super_admin',
                'permissions' => null,
            ]);

            return redirect()->route('install.complete');
        } catch (\Throwable $e) {
            return back()->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['admin_error' => 'Super admin creation failed: ' . $e->getMessage()]);
        }
    }

    public function complete()
    {
        if (!$this->isInstalled()) {
            return redirect()->route('install.welcome');
        }

        return view('install.complete');
    }

    private function isInstalled(): bool
    {
        return $this->canConnectToDatabase()
            && Schema::hasTable('users')
            && Schema::hasColumn('users', 'role')
            && $this->hasSuperAdmin();
    }

    private function hasSuperAdmin(): bool
    {
        try {
            return Schema::hasTable('users')
                && Schema::hasColumn('users', 'role')
                && DB::table('users')->where('role', 'super_admin')->exists();
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function canConnectToDatabase(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function runMigrations(): void
    {
        Artisan::call('migrate', ['--force' => true]);
    }

    private function createDatabaseIfMissing(array $data): void
    {
        try {
            $this->useDatabaseConfig($data);
            DB::connection()->getPdo();
            return;
        } catch (\Throwable $e) {
            DB::purge('mysql');
        }

        $database = str_replace('`', '``', $data['db_name']);

        $serverConnection = [
            'driver' => 'mysql',
            'host' => $data['db_host'],
            'port' => $data['db_port'],
            'database' => null,
            'username' => $data['db_username'],
            'password' => $data['db_password'] ?? '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ];

        config(['database.connections.install_server' => $serverConnection]);
        DB::purge('install_server');
        DB::connection('install_server')->statement(
            "CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
        );
        DB::disconnect('install_server');

        $this->useDatabaseConfig($data);
        DB::connection()->getPdo();
    }

    private function useDatabaseConfig(array $data): void
    {
        config([
            'database.default' => 'mysql',
            'database.connections.mysql.host' => $data['db_host'],
            'database.connections.mysql.port' => $data['db_port'],
            'database.connections.mysql.database' => $data['db_name'],
            'database.connections.mysql.username' => $data['db_username'],
            'database.connections.mysql.password' => $data['db_password'] ?? '',
        ]);

        DB::purge('mysql');
        DB::reconnect('mysql');
    }

    private function uniqueInstallPhone(): string
    {
        do {
            $phone = 'install-' . Str::lower(Str::random(12));
        } while (Schema::hasTable('users') && DB::table('users')->where('phone', $phone)->exists());

        return $phone;
    }

    private function updateEnv(array $data): bool
    {
        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            return false;
        }

        $envContent = file_get_contents($envPath);

        foreach ($data as $key => $value) {
            $escapedValue = str_replace('"', '\"', (string) $value);

            if (preg_match("/^{$key}=/m", $envContent)) {
                $envContent = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}=\"{$escapedValue}\"",
                    $envContent
                );
            } else {
                $envContent .= "\n{$key}=\"{$escapedValue}\"";
            }
        }

        file_put_contents($envPath, $envContent);
        return true;
    }
}
