<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    protected $fillable = [
        'member_id',
        'guarantor_type',
        'admin_guarantor_id',
        'guarantor_1_id',
        'guarantor_2_id',
        'guarantor_1_override',
        'guarantor_2_override',
        'security_cheque',
        'approve_cheque',
        'loan_amount',
        'profit_amount',
        'total_payable',
        'purpose',
        'repayment_type',
        'installment_amount',
        'reason_for_over_80',
        'had_due_fine_warning',
        'status',
        'applied_by',
        'approved_by',
        'rejection_reason',
        'disbursement_method',
        'disbursement_details',
        'disbursement_date',
        'repayment_start_date',
        'edit_history',
        'admin_description',
    ];

    protected $casts = [
        'disbursement_details' => 'array',
        'edit_history' => 'array',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function guarantor1(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'guarantor_1_id');
    }

    public function guarantor2(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'guarantor_2_id');
    }

    public function adminGuarantor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_guarantor_id');
    }

    public function repayments(): HasMany
    {
        return $this->hasMany(LoanRepayment::class);
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applied_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function createDisbursementExpense()
    {
        if ($this->status === 'disbursed') {
            $existingExpense = Expense::where('category', 'Loan Disbursement')
                ->where('description', 'Like', '%Loan ID: ' . $this->id . '%')
                ->first();

            if (!$existingExpense) {
                Expense::create([
                    'expense_date'   => $this->disbursement_date,
                    'expense_month'  => \Carbon\Carbon::parse($this->disbursement_date)->format('F Y'),
                    'category'       => 'Loan Disbursement',
                    'description'    => 'Loan Disbursed - Member Acc: ' . ($this->member->account_no ?? 'N/A') . ' (Loan ID: ' . $this->id . ')',
                    'amount'         => $this->loan_amount,
                    'payment_method' => $this->disbursement_method ?? 'Cash',
                    'bank_name'      => $this->disbursement_details['bank_name'] ?? null,
                    'member_id'      => $this->member_id,
                    'created_by'     => $this->approved_by ?? auth()->id(),
                ]);
            }
        }
    }

    public function getNextDueDateAttribute()
    {
        if (!in_array($this->status, ['disbursed', 'active'])) {
            return null;
        }

        $baseDate = $this->repayment_start_date ?? $this->disbursement_date;

        if (!$baseDate) {
            return null;
        }

        // one_time loan: date stays fixed regardless of partial payments
        if ($this->repayment_type === 'one_time') {
            try {
                return \Carbon\Carbon::parse($baseDate);
            } catch (\Exception $e) {
                return null;
            }
        }

        $paidCount = $this->repayments()->count();

        $monthsToAdd = match($this->repayment_type) {
            'monthly'  => 1,
            '2_months' => 2,
            '3_months' => 3,
            '5_months' => 5,
            '6_months' => 6,
            default    => 1,
        };

        try {
            return \Carbon\Carbon::parse($baseDate)->addMonths($monthsToAdd * $paidCount);
        } catch (\Exception $e) {
            return null;
        }
    }
}
