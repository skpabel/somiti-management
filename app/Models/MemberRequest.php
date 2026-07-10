<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberRequest extends Model
{
    protected $fillable = [
        'member_id',
        'type',
        'status',
        'data',
        'admin_id',
        'admin_remark',
    ];

    protected $casts = [
        'data' => 'array', // JSON ডাটা অটোমেটিক Array তে কনভার্ট হবে
    ];

    // রিলেশন: কোন মেম্বার রিকোয়েস্ট করেছে
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    // রিলেশন: কোন এডমিন অ্যাকশন নিয়েছে
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // হেল্পার: চেক করা এই মেম্বারের কি পেন্ডিং রিকোয়েস্ট আছে কিনা
    public static function hasPendingRequest($memberId, $type): bool
    {
        return self::where('member_id', $memberId)
                    ->where('type', $type)
                    ->where('status', 'pending')
                    ->exists();
    }
}