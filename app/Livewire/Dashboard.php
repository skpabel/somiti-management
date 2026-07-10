<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Deposit;
use App\Models\Expense;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $totalMembers;
    public $totalShares;
    public $currentMonthCollection = 0;
    public $currentMonthDue = 0;
    public $currentMonthExpense = 0;
    public $recentTransactions;
    public $totalCollection;
    public $totalDue;
    public $totalExpenses;
    

    public function mount()
    {
        $this->totalMembers = Member::count();
        $this->totalShares = Member::sum('shares');

        $currentMonth = now()->format('Y-m');

        // ✅ চলতি মাসের পেইড ডিপোজিট থেকে মোট কালেকশন বের করা
        $paidDeposits = Deposit::where('month_year', $currentMonth)->where('status', 'paid')->get();
        $this->currentMonthCollection = $paidDeposits->sum('deposit_amount') + $paidDeposits->sum('due_amount') + $paidDeposits->sum('fine_amount');

        // ✅ চলতি মাসের ড্রাফট ডিপোজিট থেকে মোট বকেয়া বের করা
        $draftDeposits = Deposit::where('month_year', $currentMonth)->where('status', 'draft')->get();
        $this->currentMonthDue = $draftDeposits->sum('due_amount') + $draftDeposits->sum('fine_amount');

        // ✅ চলতি মাসের মোট খরচ বের করা
        $this->currentMonthExpense = Expense::whereMonth('expense_date', now()->month)
                                            ->whereYear('expense_date', now()->year)
                                            ->sum('amount');

        // ✅ All Time Stats
        $this->totalCollection = Deposit::where('status', 'paid')->sum(\DB::raw('deposit_amount + due_amount + fine_amount + other_payment'));
        $this->totalDue = Deposit::where('status', 'draft')->sum(\DB::raw('due_amount + fine_amount'));
        $this->totalExpenses = Expense::sum('amount');

        // ✅ সাম্প্রতিক জমা এবং খরচ একসাথে দেখানো
        $deposits = Deposit::where('status', 'paid')->with('member')->latest()->take(5)->get();
        $expenses = Expense::with('creator')->latest()->take(5)->get();

        $transactions = collect();

        foreach ($deposits as $d) {
            $transactions->push([
                'type' => 'deposit',
                'date' => $d->updated_at,
                'name' => $d->member->name_english ?? 'Unknown',
                'desc' => 'Monthly Collection (' . \Carbon\Carbon::createFromFormat('Y-m', $d->month_year)->format('M Y') . ')',
                'amount' => $d->deposit_amount + $d->due_amount + $d->fine_amount + $d->other_payment,
            ]);
        }

        foreach ($expenses as $e) {
            $transactions->push([
                'type' => 'expense',
                'date' => $e->created_at,
                'name' => $e->creator?->name ?? 'System', // ✅ বাগ ফিক্স: null safe operator ব্যবহার করা হয়েছে
                'desc' => $e->category . ($e->description ? ' - ' . $e->description : ''),
                'amount' => $e->amount,
            ]);
        }

        // সব একসাথে সর্বশেষ তারিখ অনুযায়ী সাজিয়ে প্রথম ১০টি নেওয়া
        $this->recentTransactions = $transactions->sortByDesc('date')->take(10);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}