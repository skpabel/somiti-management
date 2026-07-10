<?php

namespace App\Livewire\User;

use App\Models\Loan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class LoanDetail extends Component
{
    public $loanId;
    public $loan;
    public $repayments;
    public $totalPaid = 0;
    public $totalProfitPaid = 0;
    public $remaining = 0;
    public $paidPercent = 0;

    public function mount($loanId)
    {
        $this->loanId = $loanId;

        $this->loan = Loan::where('id', $loanId)
            ->where('member_id', auth()->user()->member->id)
            ->withSum('repayments', 'amount')
            ->firstOrFail();

        $this->repayments = $this->loan->repayments()->orderBy('payment_date', 'desc')->get();
        $this->totalPaid  = $this->repayments->sum('amount');
        $this->totalProfitPaid = $this->repayments->sum(function($r) {
            $d = is_array($r->transaction_details) ? $r->transaction_details : json_decode($r->transaction_details, true);
            return $d['profit'] ?? 0;
        });
        $this->remaining  = $this->loan->total_payable - $this->totalPaid;
        $this->paidPercent = $this->loan->total_payable > 0
            ? round(($this->totalPaid / $this->loan->total_payable) * 100)
            : 0;
    }

    public function render()
    {
        return view('livewire.user.loan-detail');
    }
}
