<?php

namespace App\Livewire\Expense;

use App\Models\Deposit;
use App\Models\Expense;
use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $addModal = false;
    public $deleteModal = false;
    public $deleteId = null;

    public $editModal = false;
    public $editId = null;

    public $historyModal = false;
    public $historyData = [];

    // Form Properties
    public $expense_date;
    public $expense_month; 
    public $category; 
    public $description;
    public $amount;
    public $payment_method = 'Cash';
    public $bank_name;
    public $medium_type = 'Direct';
    public $member_id = null;

    public $paymentOptions = [];
    public $members = [];

    // Filter & Stats
    public $selectedMonth = '';
    public $availableMonths = [];
    public $totalExpense = 0;
    public $monthlyExpense = 0;
    public $topCategory = '';
    public $paymentMethodStats = [];

    public function mount()
    {
        $this->expense_month = now()->format('Y-m');
        $this->expense_date = now()->format('Y-m') . '-01'; // ডিফল্ট বর্তমান মাসের ১ তারিখ
        
        $this->paymentOptions = [
            ['value' => 'Cash', 'label' => '💵 Cash'],
            ['value' => 'Bkash', 'label' => '📱 Bkash'],
            ['value' => 'Nagad', 'label' => '📲 Nagad'],
            ['value' => 'Rocket', 'label' => '🚀 Rocket'],
            ['value' => 'Bank', 'label' => '🏦 Main Bank'],
        ];

        $this->members = Member::select('id', 'account_no', 'name_english')->orderBy('account_no')->get();

        $this->loadAvailableMonths();
        $this->loadStats();
    }

    public function loadAvailableMonths()
    {
        // ডিপোজিট টেবিলের month_year কলাম থেকে মাসগুলো বের করব
        $months = Deposit::selectRaw("month_year")
            ->whereNotNull('month_year')
            ->distinct()
            ->orderBy('month_year', 'desc')
            ->pluck('month_year')
            ->toArray();

        $this->availableMonths = [];
        foreach ($months as $month) {
            $monthValue = \Carbon\Carbon::parse($month)->format('Y-m');
            $label = \Carbon\Carbon::parse($month)->format('M Y'); 
            
            $this->availableMonths[] = ['value' => $monthValue, 'label' => $label];
        }

        $uniqueMonths = collect($this->availableMonths)->unique('value')->values()->toArray();
        $this->availableMonths = $uniqueMonths;

        $currentMonth = now()->format('Y-m');
        $monthValues = array_column($this->availableMonths, 'value');
        
        if (in_array($currentMonth, $monthValues)) {
            $this->selectedMonth = $currentMonth;
        } elseif (!empty($monthValues)) {
            $this->selectedMonth = $monthValues[0];
        } else {
            $this->selectedMonth = ''; 
        }
    }

    // যখন Expense Date চেঞ্জ হবে, তখন অটোমেটিক Expense Month সেট হবে
    public function updatedExpenseDate($value)
    {
        if ($value) {
            $this->expense_month = \Carbon\Carbon::parse($value)->format('Y-m');
        }
    }

    public function loadStats()
    {
        $this->totalExpense = Expense::sum('amount');

        if ($this->selectedMonth) {
            $monthExpenses = Expense::where('expense_month', $this->selectedMonth)->get();

            $this->monthlyExpense = $monthExpenses->sum('amount');

            $topCat = $monthExpenses->groupBy('category')
                ->map(fn($items) => $items->sum('amount'))
                ->sortDesc()
                ->keys()
                ->first();
            $this->topCategory = $topCat ?: 'N/A';

            $this->paymentMethodStats = [];
            foreach (['Cash', 'Bkash', 'Nagad', 'Rocket', 'Bank'] as $method) {
                $methodExpenses = $monthExpenses->where('payment_method', $method);
                $this->paymentMethodStats[$method] = [
                    'amount' => $methodExpenses->sum('amount'),
                    'transactions' => $methodExpenses->count(),
                ];
            }
        } else {
            $this->monthlyExpense = $this->totalExpense;

            $topCat = Expense::selectRaw('category, SUM(amount) as total')
                ->groupBy('category')
                ->orderByDesc('total')
                ->first();
            $this->topCategory = $topCat ? $topCat->category : 'N/A';

            $this->paymentMethodStats = [];
            foreach (['Cash', 'Bkash', 'Nagad', 'Rocket', 'Bank'] as $method) {
                $methodExpenses = Expense::where('payment_method', $method)->get();
                $this->paymentMethodStats[$method] = [
                    'amount' => $methodExpenses->sum('amount'),
                    'transactions' => $methodExpenses->count(),
                ];
            }
        }
    }

    public function updatedSelectedMonth()
    {
        $this->loadStats();
    }

    public function rules()
    {
        return [
            'expense_date' => 'required|date',
            'expense_month' => 'required|string',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'bank_name' => 'nullable|string',
            'medium_type' => 'required|string|in:Direct,Member',
            'member_id' => 'nullable|exists:members,id',
            'description' => 'nullable|string',
        ];
    }

    public function openAddModal()
    {
        $this->reset(['category', 'description', 'amount', 'payment_method', 'bank_name', 'medium_type', 'member_id', 'editId']);
        
        $this->expense_month = now()->format('Y-m');
        $this->expense_date = now()->format('Y-m') . '-01'; // বর্তমান মাসের ১ তারিখ

        $this->payment_method = 'Cash';
        $this->medium_type = 'Direct';
        $this->addModal = true;
    }

    public function closeAddModal()
    {
        $this->addModal = false;
    }

    public function openEditModal($id)
    {
        $expense = Expense::findOrFail($id);
        
        $this->editId = $id;
        
        // এখানে মাসের ১ তারিখ না দিয়ে, ডাটাবেসে সেভ করা আসল তারিখটা সেট করব
        $this->expense_date = \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d');
        $this->expense_month = $expense->expense_month ?? \Carbon\Carbon::parse($expense->expense_date)->format('Y-m');
        
        $this->category = $expense->category;
        $this->description = $expense->description;
        $this->amount = $expense->amount;
        $this->bank_name = $expense->bank_name;
        $this->payment_method = $expense->payment_method;
        $this->medium_type = $expense->medium_type ?? 'Direct';
        $this->member_id = $expense->member_id;

        $this->editModal = true;
    }
    public function closeEditModal()
    {
        $this->editModal = false;
        $this->editId = null;
    }

    public function saveExpense()
    {
        $this->validate();
        $this->expense_month = \Carbon\Carbon::parse($this->expense_date)->format('Y-m');

        $data = [
            'expense_date' => $this->expense_date,
            'expense_month' => $this->expense_month,
            'category' => $this->category,
            'description' => $this->description,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'bank_name' => $this->payment_method == 'Bank' ? $this->bank_name : null,
            'medium_type' => $this->medium_type,
            'member_id' => $this->medium_type == 'Member' ? $this->member_id : null,
        ];

        if ($this->editId) {
            $expense = Expense::find($this->editId);
            if ($expense) {
                $history = $expense->edit_history ?? [];
                
                $oldData = $expense->only(['expense_date', 'expense_month', 'category', 'description', 'amount', 'payment_method', 'bank_name', 'medium_type', 'member_id']);
                $newData = Arr::only($data, ['expense_date', 'expense_month', 'category', 'description', 'amount', 'payment_method', 'bank_name', 'medium_type', 'member_id']);

                $history[] = [
                    'updated_by' => Auth::id(),
                    'updated_at' => now()->toDateTimeString(),
                    'old_data' => $oldData,
                    'new_data' => $newData, 
                ];
                $data['edit_history'] = $history;

                $expense->update($data);
            }
            session()->flash('message', '✏️ Expense updated successfully!');
            $this->closeEditModal();
        } else {
            $data['created_by'] = Auth::id();
            Expense::create($data);
            session()->flash('message', '💸 Expense added successfully!');
            $this->closeAddModal();
        }

        $this->loadAvailableMonths();
        $this->loadStats();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->deleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
        $this->deleteId = null;
    }

    public function deleteExpense()
    {
        Expense::find($this->deleteId)?->delete();
        $this->deleteModal = false;
        $this->deleteId = null;
        session()->flash('message', '🗑️ Expense deleted successfully!');
        $this->loadAvailableMonths();
        $this->loadStats();
    }

    public function openHistoryModal($id)
    {
        $expense = Expense::with('creator')->find($id);
        if ($expense && $expense->edit_history) {
            $this->historyData = $expense->edit_history;
            $this->historyModal = true;
        } else {
            session()->flash('message', '❌ No edit history found!');
        }
    }

    public function closeHistoryModal()
    {
        $this->historyModal = false;
        $this->historyData = [];
    }

    public function render()
    {
        $query = Expense::with(['creator', 'member'])->orderBy('expense_date', 'desc');

        if ($this->selectedMonth) {
            $query->where('expense_month', $this->selectedMonth);
        }

        $expenses = $query->get();
        return view('livewire.expense.index', compact('expenses'));
    }
}