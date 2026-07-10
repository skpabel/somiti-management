<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsLog extends Model
{
    protected $fillable = [
        'user_id',
        'member_id',
        'acc_no',
        'member_name',
        'phone',
        'sms_type',
        'message',
        'status',
        'trxn_id',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    // কে SMS পাঠিয়েছেন
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // কাকে পাঠানো হয়েছে (সিস্টেমের মেম্বার হলে)
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}