<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    protected $fillable = [
        'member_id',
        'month_year',
        'deposit_amount',
        'due_amount',
        'fine_amount',
        'payment_method',
        'bank_name',
        'sub_account',
        'paid_by',
        'paid_by_info',
        'comment',
        'status',
        'transaction_id',
        'other_payment',
        'other_payment_reason',
        'other_reason_history',
        'edit_history',
        'comment_history',
    ];

    protected $casts = [
        'edit_history' => 'array',
        'comment_history' => 'array',
        'other_reason_history' => 'array',
    ];

    // Relationship: Deposit belongs to Member
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    // Relationship: Deposit entry made by which User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
}