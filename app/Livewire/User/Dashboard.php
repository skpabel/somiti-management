<?php

namespace App\Livewire\User;

use App\Models\Member;
use App\Models\Deposit;
use App\Models\Loan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Dashboard extends Component
{
    public $member;
    public $accountNo;
    public $memberName;
    public $memberPhoto;
    public $shares;

    public $totalPaidDeposit = 0;
    public $totalDueAmount = 0;
    public $totalFineAmount = 0;

    public $recentDeposits;
    public $acceptableProfit = 0;

    public $hasActiveLoan = false;
    public $activeLoans = [];

    public $unreadNoticeCount = 0;
    public $nextPaymentDue = null;
    public $depositStatus = null; // 'paid', 'due', 'upcoming'

    public function mount()
    {
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $this->member = auth()->user()->member;

        if (!$this->member) {
            return redirect()->route('logout');
        }

        $this->accountNo   = $this->member->account_no;
        $this->memberName  = $this->member->name_english;
        $this->memberPhoto = $this->member->photo;
        $this->shares      = $this->member->shares;

        $paidDeposits = Deposit::where('member_id', $this->member->id)
            ->where('status', 'paid')->get();

        $this->totalPaidDeposit = $paidDeposits->sum(fn($d) => $d->deposit_amount + $d->due_amount + $d->other_payment);

        $this->totalDueAmount = Deposit::where('member_id', $this->member->id)
            ->where('status', 'draft')
            ->selectRaw('COALESCE(SUM(deposit_amount + due_amount + fine_amount), 0) as total')
            ->value('total') ?? 0;

        $this->totalFineAmount = Deposit::where('member_id', $this->member->id)
            ->where('status', 'draft')
            ->where('fine_amount', '>', 0)
            ->sum('fine_amount');

        $totalLoanProfit      = Loan::whereIn('status', ['disbursed', 'active', 'repaid'])->sum('profit_amount');
        $totalFine            = Deposit::sum('fine_amount');
        $totalRegistrationFee = Member::sum('registration_fee');
        $totalExpenses        = \App\Models\Expense::sum('amount');
        $totalShares          = Member::sum('shares');

        $netProfit = ($totalLoanProfit + $totalFine + $totalRegistrationFee) - $totalExpenses;
        $this->acceptableProfit = $totalShares > 0 ? ($netProfit / $totalShares) * $this->shares : 0;

        $this->recentDeposits = Deposit::where('member_id', $this->member->id)
            ->where('status', 'paid')
            ->with('member')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        // Active Loans
        $loans = Loan::where('member_id', $this->member->id)
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
                'disbursement_date'  => $loan->disbursement_date,
                'total_paid'         => $totalPaid,
                'remaining'          => $loan->total_payable - $totalPaid,
                'paid_percent'       => $loan->total_payable > 0 ? round(($totalPaid / $loan->total_payable) * 100) : 0,
                'next_due_date'      => $loan->next_due_date ? \formatDate($loan->next_due_date) : null,
            ];
        })->toArray();

        // Unread Notice Count
        if (class_exists(\App\Models\Notice::class) && class_exists(\App\Models\NoticeRead::class)) {
            $readIds = \App\Models\NoticeRead::where('member_id', $this->member->id)->pluck('notice_id');
            $this->unreadNoticeCount = \App\Models\Notice::whereNotIn('id', $readIds)->count();
        }

        // Next Payment Due (earliest unpaid deposit month)
        $nextDue = Deposit::where('member_id', $this->member->id)
            ->where('status', 'draft')
            ->orderBy('month_year', 'asc')
            ->first();

        if ($nextDue) {
            $this->nextPaymentDue = [
                'month'  => \Carbon\Carbon::createFromFormat('Y-m', $nextDue->month_year)->format('F Y'),
                'amount' => $nextDue->deposit_amount + $nextDue->due_amount + $nextDue->fine_amount,
            ];
        }

        // Deposit Status Card Logic
        $now = \Carbon\Carbon::now();
        $currentMonthYear = $now->format('Y-m');
        $nextMonthYear = $now->copy()->addMonth()->format('Y-m');
        $day = $now->day;

        $currentMonthDeposit = Deposit::where('member_id', $this->member->id)
            ->where('month_year', $currentMonthYear)
            ->first();

        $monthLabel     = $now->format('F Y');
        $nextMonthLabel = $now->copy()->addMonth()->format('F Y');
        $lastDate15     = \formatDate($now->copy()->setDay(15));
        $openDate10     = \formatDate($now->copy()->setDay(10));
        $nextOpenDate10 = \formatDate($now->copy()->addMonth()->setDay(10));

        // আগের সব বকেয়া মাস (current month বাদে)
        $previousDueDeposits = Deposit::where('member_id', $this->member->id)
            ->where('status', 'draft')
            ->where('month_year', '<', $currentMonthYear)
            ->orderBy('month_year', 'asc')
            ->get();

        // Priority 1: Previous months overdue (always show first regardless of current month)
        if ($previousDueDeposits->isNotEmpty()) {
            $dueCount       = $previousDueDeposits->count();
            $totalDueAmount = $previousDueDeposits->sum(fn($d) => $d->deposit_amount + $d->due_amount + $d->fine_amount);
            $estimatedFine  = $previousDueDeposits->sum(fn($d) => $d->deposit_amount * 0.05);
            $dueMonthLabels = $previousDueDeposits->map(fn($d) => \Carbon\Carbon::parse($d->month_year . '-01')->format('M Y'))->join(', ');
            $this->depositStatus = [
                'state'          => 'overdue',
                'month'          => $dueMonthLabels,
                'message'        => '⚠️ ' . $dueCount . ' month(s) overdue!',
                'sub'            => 'Overdue: ' . $dueMonthLabels . '. Please submit your deposit request.',
                'amount'         => $totalDueAmount,
                'estimated_fine' => $estimatedFine,
            ];

        // Priority 2: Current month paid, no overdue
        } elseif ($currentMonthDeposit && $currentMonthDeposit->status === 'paid') {
            // Next month deposit amount (if draft exists)
            $nextMonthDeposit = Deposit::where('member_id', $this->member->id)
                ->where('month_year', $nextMonthYear)
                ->where('status', 'draft')
                ->first();
            $nextAmount = $nextMonthDeposit ? ($nextMonthDeposit->deposit_amount + $nextMonthDeposit->due_amount + $nextMonthDeposit->fine_amount) : null;
            $this->depositStatus = [
                'state'        => 'paid',
                'month'        => $monthLabel,
                'message'      => 'All deposits clear up to ' . $monthLabel . '.',
                'sub'          => 'Next deposit opens on ' . $nextOpenDate10 . '.',
                'next_month'   => $nextMonthLabel,
                'next_amount'  => $nextAmount,
            ];
        } elseif ($day >= 10 && $day <= 15) {
            $amount = $currentMonthDeposit ? ($currentMonthDeposit->deposit_amount + $currentMonthDeposit->due_amount + $currentMonthDeposit->fine_amount) : 0;
            $this->depositStatus = [
                'state'   => 'due',
                'month'   => $monthLabel,
                'message' => $monthLabel . ' payment is due!',
                'sub'     => 'Last date: ' . $lastDate15 . '. Please submit a deposit request.',
                'amount'  => $amount,
            ];
        } elseif ($day > 15) {
            $amount = $currentMonthDeposit ? ($currentMonthDeposit->deposit_amount + $currentMonthDeposit->due_amount + $currentMonthDeposit->fine_amount) : 0;
            $this->depositStatus = [
                'state'   => 'overdue',
                'month'   => $monthLabel,
                'message' => $monthLabel . ' payment overdue!',
                'sub'     => 'Please contact admin or submit a deposit request.',
                'amount'  => $amount,
            ];
        } else {
            $this->depositStatus = [
                'state'   => 'upcoming',
                'month'   => $monthLabel,
                'message' => 'Next deposit: ' . $monthLabel,
                'sub'     => 'Collection opens on ' . $openDate10 . '. If you have already paid, submit a deposit request.',
            ];
        }
    }

    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
