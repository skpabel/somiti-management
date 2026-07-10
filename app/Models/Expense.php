<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = [
        'expense_date',
        'expense_month', // নতুন যোগ
        'category',
        'description',
        'amount',
        'payment_method',
        'bank_name',
        'medium_type',
        'member_id',
        'edit_history',
        'created_by',
    ];

    protected $casts = [
        'edit_history' => 'array',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}