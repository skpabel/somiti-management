<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'log_type',
        'action',
        'description',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    // কে লগ এন্ট্রি করেছে তার রিলেশন
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}