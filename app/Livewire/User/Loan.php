<?php

namespace App\Livewire\User;

use App\Models\Loan as LoanModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Loan extends Component
{
    public $member;
    public $activeLoans = [];
    public $hasActiveLoan = false;

    public function mount()
    {
        $this->member = auth()->user()->member;

        if (!$this->member) {
            return redirect()->route('logout');
        }

        $loans = LoanModel::where('member_id', $this->member->id)
            ->whereIn('status', ['disbursed', 'active'])
            ->latest()
            ->get();

        $this->hasActiveLoan = $loans->isNotEmpty();

        $this->activeLoans = $loans->map(function ($loan) {
            $totalPaid = $loan->repayments()->sum('amount');
            return [
                'id'                 => $loan->id,
                'loan_amount'        => $loan->loan_amount,
                'profit_amount'      => $loan->profit_amount,
                'total_payable'      => $loan->total_payable,
                'installment_amount' => $loan->installment_amount,
                'repayment_type'     => $loan->repayment_type,
                'purpose'            => $loan->purpose,
                'disbursement_date'  => $loan->disbursement_date
                    ? \Carbon\Carbon::parse($loan->disbursement_date)->format('d M Y')
                    : null,
                'total_paid'         => $totalPaid,
                'remaining'          => $loan->total_payable - $totalPaid,
                'paid_percent'       => $loan->total_payable > 0
                    ? round(($totalPaid / $loan->total_payable) * 100)
                    : 0,
                'next_due_date'      => $loan->next_due_date
                    ? \Carbon\Carbon::parse($loan->next_due_date)->format('d M Y')
                    : null,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.user.loan');
    }
}
