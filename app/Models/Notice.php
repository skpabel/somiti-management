<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notice extends Model
{
    protected $fillable = [
        'title',
        'message',
        'priority',
        'target_group',
        'target_member_ids',
        'created_by',
        'source', // sms_portal, deposit_request, loan_request
    ];

    protected $casts = [
        'target_member_ids' => 'array',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
