<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanRepayment extends Model
{
    protected $fillable = [
        'loan_id',
        'amount',
        'payment_method',
        'transaction_details',
        'paid_by',
        'payment_date',
    ];

    protected $casts = [
        'transaction_details' => 'array',
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
}