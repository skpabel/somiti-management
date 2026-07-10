<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositRequest extends Model
{
    protected $fillable = [
        'member_id',
        'request_type',
        'month_year',
        'amount',
        'deposit_amount',
        'due_amount',
        'fine_amount',
        'payment_method',
        'transaction_id',
        'screenshot',
        'note',
        'status',
        'admin_id',
        'admin_remark',
    ];

    // মেম্বার রিলেশন
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    // এডমিন রিলেশন
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // এই month এ কোনো pending request আছে কিনা (grouped — per month)
    public static function hasPending($memberId, $monthYear): bool
    {
        return self::where('member_id', $memberId)
            ->where('month_year', $monthYear)
            ->where('status', 'pending')
            ->exists();
    }
}
