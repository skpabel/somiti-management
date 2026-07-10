<?php

namespace App\Livewire\User;

use App\Models\Deposit;
use App\Models\DepositRequest as DepositRequestModel;
use App\Models\Member;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.guest')]
class DepositRequest extends Component
{
    use WithFileUploads;

    public $member;

    // Multi-select request types
    public $selectedTypes = []; // ['deposit', 'due', 'fine']

    // Amount per type
    public $depositAmount = 0;
    public $dueAmount = 0;
    public $fineAmount = 0;

    // Detail popup for combined requests
    public $detailPopup = false;
    public $detailRequest = null;

    // Common fields
    public $selectedMonthYear = '';
    public $paymentMethod = 'Cash';
    public $transactionId = '';
    public $screenshot = null;
    public $note = '';

    // Available months (unpaid drafts)
    public $availableMonths = [];

    // Current selected month data
    public $currentMonthData = null;

    // Previous requests
    public $previousRequests = [];

    // Payment options
    public $paymentOptions = [];

    // Pending checks — now month-level (one request per month)
    public $pendingThisMonth = false;

    public function mount()
    {
        $this->member = auth()->user()->member;

        if (!$this->member) {
            return redirect()->route('logout');
        }

        $this->paymentOptions = [
            ['value' => 'Cash',   'label' => '💵 Cash'],
            ['value' => 'Bkash',  'label' => '📱 Bkash'],
            ['value' => 'Nagad',  'label' => '📱 Nagad'],
            ['value' => 'Rocket', 'label' => '📱 Rocket'],
            ['value' => 'Bank',   'label' => '🏦 Bank'],
        ];

        $this->loadAvailableMonths();
        $this->loadPreviousRequests();

        // Auto-select month from query param (from notification redirect)
        $monthParam = request()->query('month');

        if ($monthParam && collect($this->availableMonths)->firstWhere('month_year', $monthParam)) {
            $this->selectedMonthYear = $monthParam;
        } elseif (count($this->availableMonths) > 0) {
            $this->selectedMonthYear = $this->availableMonths[0]['month_year'];
        }

        if ($this->selectedMonthYear) {
            $this->loadMonthData();
        }
    }

    public function loadAvailableMonths()
    {
        $drafts = Deposit::where('member_id', $this->member->id)
            ->where('status', 'draft')
            ->orderBy('month_year', 'asc')
            ->get();

        $this->availableMonths = $drafts->map(function ($d) {
            return [
                'month_year'     => $d->month_year,
                'month_label'    => Carbon::parse($d->month_year . '-01')->format('F Y'),
                'deposit_amount' => $d->deposit_amount,
                'due_amount'     => $d->due_amount,
                'fine_amount'    => $d->fine_amount,
            ];
        })->toArray();
    }

    public function loadMonthData()
    {
        $this->currentMonthData = collect($this->availableMonths)
            ->firstWhere('month_year', $this->selectedMonthYear);

        // Reset selections
        $this->selectedTypes = [];
        $this->depositAmount = $this->currentMonthData['deposit_amount'] ?? 0;
        // Due & Fine: use existing amount if > 0, otherwise leave 0 so member can input freely
        $this->dueAmount  = $this->currentMonthData['due_amount'] ?? 0;
        $this->fineAmount = $this->currentMonthData['fine_amount'] ?? 0;

        $this->checkPendings();
    }

    public function loadPreviousRequests()
    {
        $this->previousRequests = DepositRequestModel::where('member_id', $this->member->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->toArray();
    }

    public function updatedSelectedMonthYear()
    {
        $this->loadMonthData();
    }

    // Toggle type selection
    public function toggleType($type)
    {
        if (in_array($type, $this->selectedTypes)) {
            $this->selectedTypes = array_values(array_filter($this->selectedTypes, fn($t) => $t !== $type));
        } else {
            $this->selectedTypes[] = $type;
        }
    }

    public function checkPendings()
    {
        if (!$this->selectedMonthYear) return;
        $this->pendingThisMonth = DepositRequestModel::hasPending(
            $this->member->id,
            $this->selectedMonthYear
        );
    }

    public function getTotalAmountProperty()
    {
        $total = 0;
        if (in_array('deposit', $this->selectedTypes)) $total += (float)$this->depositAmount;
        if (in_array('due', $this->selectedTypes))     $total += (float)$this->dueAmount;
        if (in_array('fine', $this->selectedTypes))    $total += (float)$this->fineAmount;
        return $total;
    }

    public function submitRequest()
    {
        if (empty($this->selectedTypes)) {
            session()->flash('error', 'Please select at least one type.');
            return;
        }

        if ($this->pendingThisMonth) {
            session()->flash('error', 'You already have a pending request for this month.');
            return;
        }

        $this->validate([
            'selectedMonthYear' => 'required',
            'paymentMethod'     => 'required',
            'screenshot'        => 'nullable|image|max:5120',
        ], [
            'screenshot.image' => 'Only image files are allowed.',
            'screenshot.max'   => 'Max image size is 5 MB.',
        ]);

        // Screenshot upload
        $screenshotPath = null;
        if ($this->screenshot) {
            $screenshotPath = $this->screenshot->store('deposit-requests', 'public');
        }

        // Build grouped amounts
        $dAmt = in_array('deposit', $this->selectedTypes) ? (float)$this->depositAmount : 0;
        $uAmt = in_array('due',     $this->selectedTypes) ? (float)$this->dueAmount     : 0;
        $fAmt = in_array('fine',    $this->selectedTypes) ? (float)$this->fineAmount    : 0;
        $totalAmt = $dAmt + $uAmt + $fAmt;

        // request_type: single type name or 'combined'
        $reqType = count($this->selectedTypes) === 1
            ? $this->selectedTypes[0]
            : 'combined';

        // Create ONE grouped request row
        DepositRequestModel::create([
            'member_id'      => $this->member->id,
            'request_type'   => $reqType,
            'month_year'     => $this->selectedMonthYear,
            'amount'         => $totalAmt,
            'deposit_amount' => $dAmt,
            'due_amount'     => $uAmt,
            'fine_amount'    => $fAmt,
            'payment_method' => $this->paymentMethod,
            'transaction_id' => $this->transactionId ?: null,
            'screenshot'     => $screenshotPath,
            'note'           => $this->note ?: null,
            'status'         => 'pending',
        ]);

        $this->reset(['selectedTypes', 'transactionId', 'screenshot', 'note']);
        $this->loadPreviousRequests();
        $this->checkPendings();

        $parts = array_filter([
            $dAmt > 0 ? 'Deposit ৳'.number_format($dAmt, 0) : null,
            $uAmt > 0 ? 'Due ৳'.number_format($uAmt, 0)     : null,
            $fAmt > 0 ? 'Fine ৳'.number_format($fAmt, 0)    : null,
        ]);
        session()->flash('success', 'Request sent! ' . implode(' + ', $parts));
    }

    public function showDetail($requestId)
    {
        $req = DepositRequestModel::find($requestId);
        if (!$req) return;

        $this->detailRequest = [
            'id'             => $req->id,
            'request_type'   => $req->request_type,
            'month_label'    => Carbon::parse($req->month_year . '-01')->format('F Y'),
            'deposit_amount' => (float)($req->deposit_amount ?? 0),
            'due_amount'     => (float)($req->due_amount     ?? 0),
            'fine_amount'    => (float)($req->fine_amount    ?? 0),
            'amount'         => (float)($req->amount         ?? 0),
            'payment_method' => $req->payment_method,
            'transaction_id' => $req->transaction_id,
            'screenshot'     => $req->screenshot,
            'note'           => $req->note,
            'status'         => $req->status,
            'admin_remark'   => $req->admin_remark,
            'created_at'     => $req->created_at->format('d M Y, h:i A'),
        ];
        $this->detailPopup = true;
    }

    public function closeDetail()
    {
        $this->detailPopup   = false;
        $this->detailRequest = null;
    }

    public function render()
    {
        return view('livewire.user.deposit-request');
    }
}
