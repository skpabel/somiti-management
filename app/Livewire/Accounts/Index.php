<?php

namespace App\Livewire\Accounts;

use App\Models\Deposit;
use App\Models\Member;
use App\Models\Expense;
use App\Models\Loan;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    // Date Filter
    public $selectedMonth;

    // Main Bank Balance (All Time)
    public $totalBankBalance = 0;
    public $totalBankInflow = 0;
    public $totalBankOutflow = 0;

    // Monthly Stats
    public $monthlyTotal = 0;
    public $monthlyInflow = 0;
    public $monthlyOutflow = 0;
    public $paymentMethodStats = [];
    public $monthlyCollections = [];
    public $monthlyExpenses = []; // নতুন যোগ
    public $monthlyLoanRepayments = [];
    public $monthlyTransactions = [];
    public $activeTab = 'transactions'; // ডিফল্ট ট্যাব

    // Add Money Modal Properties
    public $addMoneyModal = false;
    public $viewManualInflowModal = false;
    public $viewManualInflowData = null;
    public $addAmount = 0;
    public $addMethod = 'Cash';
    public $addCategory = 'Manual Profit';
    public $addDescription = '';
    public $addDateTime = '';

    // Payment Method Card Config
    protected $methodConfig = [
        'Cash'   => ['icon' => '💵', 'color' => 'emerald'],
        'Bkash'  => ['icon' => '📱', 'color' => 'pink'],
        'Nagad'  => ['icon' => '📲', 'color' => 'orange'],
        'Rocket' => ['icon' => '🚀', 'color' => 'purple'],
        'Bank'   => ['icon' => '🏦', 'color' => 'blue'],
    ];

    public function mount()
    {
        $this->selectedMonth = Carbon::now()->format('Y-m');
        $this->calculateBankBalance();
        $this->loadMonthlyData();
    }

    public function calculateBankBalance()
    {
        // All Time Inflow: Paid Deposits + Loan Repayments (Principal + Profit)
        $depositInflow = Deposit::where('status', 'paid')
            ->sum(\DB::raw('deposit_amount + due_amount + fine_amount + other_payment'));
        
        $repaymentInflow = \App\Models\LoanRepayment::sum('amount');
        
        // ✅ Loan Profit (All Time)
        $loanProfitInflow = \App\Models\LoanRepayment::get()->sum(function($r) {
            $details = is_array($r->transaction_details) ? $r->transaction_details : json_decode($r->transaction_details, true);
            return ($details['profit'] ?? 0);
        });
        
        $registrationFeeInflow = Member::sum('registration_fee');
        
        // ✅ Manual Inflow (Add Money)
        $manualInflow = \App\Models\ActivityLog::where('log_type', 'Manual Inflow')->get()->sum(function($log) {
            $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
            return ($props['amount'] ?? 0);
        });

        $this->totalBankInflow = $depositInflow + $repaymentInflow + $loanProfitInflow + $registrationFeeInflow + $manualInflow;

        // All Time Outflow: Expenses + Loan Disbursements (Disburse খরচ না, কিন্তু Main Balance থেকে কাটে)
        $this->totalBankOutflow = Expense::sum('amount') + Loan::whereIn('status', ['disbursed', 'active', 'repaid'])->sum('loan_amount');

        // Net Bank Balance
        $this->totalBankBalance = $this->totalBankInflow - $this->totalBankOutflow;
    }

    public function loadMonthlyData()
    {
        // ✅ All Time চেক করার লজিক
        $isAllTime = ($this->selectedMonth === 'all');
        $monthYear = $this->selectedMonth; 
        $monthParse = $isAllTime ? null : \Carbon\Carbon::parse($monthYear . '-01');

        // ===== Monthly Inflow: Only Paid Deposits =====
        $depositQuery = Deposit::where('status', 'paid');
        if (!$isAllTime) {
            $depositQuery->where('month_year', $monthYear);
        }
        $depositInflow = $depositQuery->sum(\DB::raw('deposit_amount + due_amount + fine_amount + other_payment'));

        $regFeeQuery = Member::where('registration_fee', '>', 0);
        if (!$isAllTime) {
            $regFeeQuery->whereMonth('registration_date', $monthParse->month)
                        ->whereYear('registration_date', $monthParse->year);
        }
        $monthlyRegFee = $regFeeQuery->sum('registration_fee');
        $this->monthlyInflow = $depositInflow + $monthlyRegFee;

        // ===== Monthly Outflow: Expenses =====
        $expenseQuery = Expense::whereNotNull('expense_month');
        if (!$isAllTime) {
            $expenseQuery->where('expense_month', $monthYear);
        }
        $this->monthlyOutflow = $expenseQuery->sum('amount');

        // ===== Manual Inflow (Monthly) =====
        $manualInflowQuery = \App\Models\ActivityLog::where('log_type', 'Manual Inflow');
        if (!$isAllTime) {
            $manualInflowQuery->whereMonth('created_at', $monthParse->month)
                             ->whereYear('created_at', $monthParse->year);
        }
        $monthlyManualInflows = $manualInflowQuery->get();
        $this->monthlyInflow += $monthlyManualInflows->sum(function($log) {
            $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
            return ($props['amount'] ?? 0);
        });

        // ===== Net Balance =====
        $this->monthlyTotal = $this->monthlyInflow - $this->monthlyOutflow;

        // ===== Payment Method Wise Stats =====
        $this->paymentMethodStats = [];
        foreach (array_keys($this->methodConfig) as $method) {
            
            $depMethodQuery = Deposit::where('status', 'paid')->where('payment_method', $method);
            if (!$isAllTime) {
                $depMethodQuery->where('month_year', $monthYear);
            }
            $deposits = $depMethodQuery->get();
            $depositAmount = $deposits->sum(fn($d) => $d->deposit_amount + $d->due_amount + $d->fine_amount + $d->other_payment);
            $totalTransactions = $deposits->count();

            $repayQuery = \App\Models\LoanRepayment::where('payment_method', $method);
            if (!$isAllTime) {
                $repayQuery->whereMonth('payment_date', $monthParse->month)
                           ->whereYear('payment_date', $monthParse->year);
            }
            $repayAmount = $repayQuery->sum('amount');

            $repayCountQuery = \App\Models\LoanRepayment::where('payment_method', $method);
            if (!$isAllTime) {
                $repayCountQuery->whereMonth('payment_date', $monthParse->month)
                                ->whereYear('payment_date', $monthParse->year);
            }
            $repayCount = $repayCountQuery->count();

            // ✅ Manual Inflow per method
            $manualMethodAmount = $monthlyManualInflows->filter(function($log) use ($method) {
                $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
                return ($props['method'] ?? '') === $method;
            })->sum(function($log) {
                $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
                return ($props['amount'] ?? 0);
            });
            $manualMethodCount = $monthlyManualInflows->filter(function($log) use ($method) {
                $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
                return ($props['method'] ?? '') === $method;
            })->count();

            $this->paymentMethodStats[$method] = [
                'amount' => $depositAmount + $repayAmount + $manualMethodAmount,
                'transactions' => $totalTransactions + $repayCount + $manualMethodCount,
            ];
        }

        // ===== Monthly Collections Table =====
        $collectionsQuery = Deposit::where('status', 'paid');
        if (!$isAllTime) {
            $collectionsQuery->where('month_year', $monthYear);
        }
        $this->monthlyCollections = $collectionsQuery->with('member')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($deposit) {
                $memberName = $deposit->member ? '#' . $deposit->member->account_no . ' ' . $deposit->member->name_english : 'Unknown Member';
                return [
                    'date' => formatDateTime($deposit->updated_at),
                    'timestamp' => $deposit->updated_at->timestamp,
                    'member' => $memberName,
                    'method' => $deposit->payment_method,
                    'amount' => $deposit->deposit_amount + $deposit->due_amount + $deposit->fine_amount + $deposit->other_payment,
                ];
            })->toArray();

        // ===== Monthly Expenses Table =====
        $expensesQuery = Expense::whereNotNull('expense_month');
        if (!$isAllTime) {
            $expensesQuery->where('expense_month', $monthYear);
        }
        $this->monthlyExpenses = $expensesQuery->with(['member', 'creator'])
            ->orderBy('expense_date', 'desc')
            ->get()
            ->map(function ($expense) {
                return [
                    'date' => formatDateTime($expense->created_at),
                    'timestamp' => $expense->created_at->timestamp,
                    'subject' => $expense->category == 'Loan Disbursement' ? '💰 Loan Given' : $expense->category,
                    'method' => $expense->payment_method,
                    'through' => $expense->medium_type == 'Member' && $expense->member ? '#'.$expense->member->account_no.' '.$expense->member->name_english : 'Direct',
                    'amount' => $expense->amount,
                ];
            })->toArray();

        // ===== Monthly Loan Repayments Table =====
        $repaymentsQuery = \App\Models\LoanRepayment::with(['loan.member', 'collector']);
        if (!$isAllTime) {
            $repaymentsQuery->whereMonth('payment_date', $monthParse->month)
                           ->whereYear('payment_date', $monthParse->year);
        }
        $this->monthlyLoanRepayments = $repaymentsQuery->orderBy('payment_date', 'desc')
            ->get()
            ->map(function ($repayment) {
                $memberName = $repayment->loan && $repayment->loan->member ? '#' . $repayment->loan->member->account_no . ' ' . $repayment->loan->member->name_english : 'N/A';
                $collectorName = $repayment->collector ? $repayment->collector->name : 'System';
                
                $details = is_array($repayment->transaction_details) ? $repayment->transaction_details : json_decode($repayment->transaction_details, true);
                $profitAmount = $details['profit'] ?? 0;
                
                return [
                    'date' => formatDateTime($repayment->created_at),
                    'timestamp' => $repayment->created_at->timestamp,
                    'member' => $memberName,
                    'method' => $repayment->payment_method,
                    'collector' => $collectorName,
                    'profit' => $profitAmount,
                    'amount' => $repayment->amount,
                ];
            })->toArray();

        // ===== Monthly Transaction Log (All In/Out) =====
        $transactions = [];

        foreach ($this->monthlyCollections as $item) {
            $transactions[] = [
                'date' => $item['date'],
                'timestamp' => $item['timestamp'],
                'type' => 'in',
                'category' => 'Deposit',
                'details' => $item['member'],
                'method' => $item['method'],
                'amount' => $item['amount'],
            ];
        }

        foreach ($this->monthlyLoanRepayments as $item) {
            if ($item['amount'] > 0) {
                $transactions[] = [
                    'date' => $item['date'],
                    'timestamp' => $item['timestamp'],
                    'type' => 'in',
                    'category' => 'Loan Repayment',
                    'details' => $item['member'],
                    'method' => $item['method'],
                    'amount' => $item['amount'],
                ];
            }
        }

        foreach ($this->monthlyLoanRepayments as $item) {
            if ($item['profit'] > 0) {
                $transactions[] = [
                    'date' => $item['date'],
                    'timestamp' => $item['timestamp'],
                    'type' => 'in',
                    'category' => 'Loan Profit',
                    'details' => $item['member'],
                    'method' => $item['method'],
                    'amount' => $item['profit'],
                ];
            }
        }

        // Loan Disbursements (Outflow)
        $disbursementsQuery = Loan::whereIn('status', ['disbursed', 'active', 'repaid'])->with('member');
        if (!$isAllTime) {
            $disbursementsQuery->whereMonth('disbursement_date', $monthParse->month)
                              ->whereYear('disbursement_date', $monthParse->year);
        }
        $monthlyDisbursements = $disbursementsQuery->get();
        foreach ($monthlyDisbursements as $loan) {
            $memberName = $loan->member ? '#' . $loan->member->account_no . ' ' . $loan->member->name_english : 'N/A';
            $disburseMethod = is_array($loan->disbursement_details) ? ($loan->disbursement_details['method'] ?? 'Bank') : 'Bank';
            $transactions[] = [
                'date' => formatDateTime($loan->created_at),
                'timestamp' => strtotime($loan->created_at),
                'type' => 'out',
                'category' => 'Loan Disbursement',
                'details' => $memberName,
                'method' => $disburseMethod,
                'amount' => $loan->loan_amount,
            ];
        }

        // Registration Fee (Inflow)
        $regFeesQuery = Member::where('registration_fee', '>', 0);
        if (!$isAllTime) {
            $regFeesQuery->whereMonth('registration_date', $monthParse->month)
                        ->whereYear('registration_date', $monthParse->year);
        }
        $regFees = $regFeesQuery->get();
        foreach ($regFees as $fee) {
            $transactions[] = [
                'date' => formatDateTime($fee->created_at),
                'timestamp' => strtotime($fee->created_at),
                'type' => 'in',
                'category' => 'Registration Fee',
                'details' => '#' . $fee->account_no . ' ' . $fee->name_english,
                'method' => 'Cash',
                'amount' => $fee->registration_fee,
            ];
        }

        // ✅ Manual Inflows (Transaction Log)
        foreach ($monthlyManualInflows as $log) {
            $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
            $transactions[] = [
                'date' => formatDateTime($log->created_at),
                'timestamp' => strtotime($log->created_at),
                'type' => 'in',
                'category' => $props['category'] ?? 'Manual Inflow',
                'details' => $log->description ?? 'Manual Inflow',
                'method' => $props['method'] ?? 'Cash',
                'amount' => $props['amount'] ?? 0,
            ];
        }

        foreach ($this->monthlyExpenses as $item) {
            $transactions[] = [
                'date' => $item['date'],
                'timestamp' => $item['timestamp'],
                'type' => 'out',
                'category' => $item['subject'],
                'details' => $item['through'],
                'method' => $item['method'],
                'amount' => $item['amount'],
            ];
        }

        usort($transactions, function ($a, $b) {
            return ($b['timestamp'] ?? 0) - ($a['timestamp'] ?? 0);
        });

        $this->monthlyTransactions = $transactions;
    }
    public function updatedSelectedMonth()
    {
        $this->calculateBankBalance();
        $this->loadMonthlyData();
    }

    // ট্যাব পরিবর্তন করার ফাংশন
    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function getMethodConfig(): array
    {
        return $this->methodConfig;
    }

    // ==========================================
    // ✅ ADD MONEY LOGIC
    // ==========================================
    public function openAddMoneyModal()
    {
        $this->reset(['addAmount', 'addMethod', 'addCategory', 'addDescription', 'addDateTime']);
        $this->addDateTime = now()->format('Y-m-d\TH:i');
        $this->addMoneyModal = true;
    }

    public function closeAddMoneyModal()
    {
        $this->addMoneyModal = false;
    }

    public function saveAddMoney()
    {
        $this->validate([
            'addAmount' => 'required|numeric|min:1',
            'addMethod' => 'required|string',
            'addCategory' => 'required|string',
            'addDateTime' => 'required|date',
        ]);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'log_type' => 'Manual Inflow',
            'action' => 'Added',
            'description' => $this->addDescription ?: ('Manual ' . $this->addCategory),
            'properties' => [
                'amount' => $this->addAmount,
                'method' => $this->addMethod,
                'category' => $this->addCategory,
            ],
            'created_at' => \Carbon\Carbon::parse($this->addDateTime)->toDateTimeString(),
        ]);

        $this->closeAddMoneyModal();
        $this->calculateBankBalance();
        $this->loadMonthlyData();
        session()->flash('message', '✅ সফলভাবে ৳' . number_format($this->addAmount, 0) . ' অ্যাকাউন্টে যোগ করা হয়েছে!');
    }

    public function openManualInflowModal($timestamp)
    {
        $log = \App\Models\ActivityLog::where('log_type', 'Manual Inflow')
            ->whereRaw('UNIX_TIMESTAMP(created_at) = ?', [$timestamp])
            ->first();
        
        if ($log) {
            $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
            $this->viewManualInflowData = [
                'date' => formatDateTime($log->created_at),
                'category' => $props['category'] ?? 'N/A',
                'amount' => $props['amount'] ?? 0,
                'method' => $props['method'] ?? 'N/A',
                'description' => $log->description ?? 'N/A',
                'user' => $log->user ? $log->user->name : 'System',
            ];
        }
        $this->viewManualInflowModal = true;
    }

    public function closeManualInflowModal()
    {
        $this->viewManualInflowModal = false;
        $this->viewManualInflowData = null;
    }

    public function render()
    {
        return view('livewire.accounts.index');
    }
}