<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password',
        'role', // ✅ নতুন যোগ
        'permissions', // ✅ নতুন যোগ
        'photo',
        'theme',
        'language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'permissions' => 'array', // ✅ JSON ডাটা অটোমেটিক Array তে কনভার্ট হবে
        ];
    }

    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }

    // ==========================================
    // ✅ ROLE & PERMISSION HELPER METHODS
    // ==========================================

    // চেক করা সুপার এডমিন কিনা
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    // চেক করা এডমিন কিনা
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // চেক করা সাধারণ ইউজার কিনা
    public function isUser(): bool
    {
        // ✅ যে কোনো রোল যদি super_admin বা admin না হয়, তবে তাকে সাধারণ ইউজার ধরা হবে
        return !$this->isSuperAdmin() && !$this->isAdmin();
    }

    // ✅ চেক করা নির্দিষ্ট মডিউলে এক্সেস আছে কিনা
    public function hasPermission(string $permission): bool
    {
        // সুপার এডমিনের সব এক্সেস থাকবে
        if ($this->isSuperAdmin()) {
            return true;
        }

        // এডমিনের ক্ষেত্রে permissions array চেক করা
        if ($this->isAdmin()) {
            return in_array($permission, $this->permissions ?? []);
        }

        // সাধারণ ইউজারের কোনো এডমিন প্যানেল এক্সেস নেই
        return false;
    }
}