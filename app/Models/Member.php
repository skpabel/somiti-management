<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'account_no',
        'name_english',
        'name_bangla',
        'dob',
        'mobile',
        'gender',
        'nid',
        'shares',
        'photo',
        'registration_fee',
        'registration_date',
        'present_address',
        'permanent_address',
        'nominee_name',
        'nominee_relation',
        'nominee_mobile',
        'user_id',
        'can_apply_loan',
    ];

    // Link with User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Member has many Deposits
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    // ✅ নতুন যোগ: Member has many Loans
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}