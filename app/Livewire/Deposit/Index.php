<?php

namespace App\Livewire\Deposit;

use App\Models\Deposit;
use App\Models\DepositRequest as DepositRequestModel;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $deleteOtherReasons = false; 
    public $selectedMemberId = '';
    public $paymentOptions = [];
    public $editingOtherPaymentId = null;
    public $editingOtherPaymentValue = null;
    public $otherPaymentId = null;
    public $tempOtherPaymentValue = null;
    public $showOtherPaymentReasonModal = false;
    public $otherPaymentReason = '';
    
    // Add Deposit Modal
    public $addDepositModal = false;
    public $selectedMonth;

    // Unlock Deposit Modal
    public $unlockDepositModal = false;
    public $unlockDepositId = null;

    // Delete Deposit Modal
    public $deleteDepositModal = false;
    public $deleteDepositId = null;
    public $clear_comment = false; 
    public $clear_history = false; 
    
    public $originalDepositData = null; 
    public $showChangeLogModal = false; 
    public $changeLogData = null;       
    public $editingPaidId = null; 

    // Pay Confirmation Modal
    public $payDepositModal = false;
    public $payDepositId = null;
    public $payDepositData = null;
    public $autoPayMonths = [];         // available unpaid months list
    public $selectedAutoPayMonths = [];  // admin checked months
    public $autoPayTotalMismatch = false;

    // Comment Modal
    public $commentModal = false;
    public $commentDepositId = null;
    public $commentText = '';
    public $commentHistory = [];
    public $isPaidComment = false;
    
    public $showEditHistoryModal = false;
    public $editHistoryData = null;
    public $editHistoryDepositId = null; 
    public $depositAmountChanged = false; 
    public $changeLogComment = '';       

    // Draft Deposit Edit Properties
    public $editingDraftDepositId = null;
    public $editingDraftDepositValue = null;
    public $showDraftChangeReasonModal = false;
    public $draftChangeReason = '';

    // ✅ Auto-Pay Revert/Adjust Modal (due edit এর পর)
    public $showAutoPayAdjustModal = false;
    public $autoPayAdjustMonths = [];       // সব months (auto-paid + unpaid draft)
    public $selectedAdjustMonths = [];      // checked থাকবে (paid হবে)
    public $adjustDepositId = null;         // কোন deposit edit হচ্ছে
    public $adjustNewDue = 0;               // নতুন due amount

    // Stats
    public $totalMembers = 0;
    public $paidMembers = 0;
    public $unpaidMembers = 0;
    public $totalCollection = 0;
    public $totalDueCollection = 0; 
    public $totalFine = 0;       
    
    // Due Month Tab Properties
    public $activeTab = 'recent';
    public $recentFilterMonth = 'all';
    public $dueMonth;
    public $dueMembers = [];

    // Requests Tab
    public $depositRequests = [];
    public $requestsFilter = 'pending'; // pending / approved / rejected / all
    public $pendingRequestsCount = 0;

    // Active request info — shown inside Add Deposit modal as a reminder
    public $activeRequestInfo = null;

    // Approve Modal
    public $approveRequestModal = false;
    public $approvingRequest = null;

    // Reject Modal
    public $rejectRequestModal = false;
    public $rejectingRequestId = null;
    public $rejectRemark = '';

    // View Reject Reason Modal (read-only, for rejected requests)
    public $showRejectReasonModal = false;
    public $viewingRejectRemark = '';
    
    // Fine Waiver Modal
    public $showFineWaiverModal = false;
    public $waiverDepositId = null;
    public $waiverReason = '';
    
    public $receiptModal = false;
    public $receiptData = null;   

    // Member Deposit Status Tab
    public $selectedStatusMemberId = '';
    public $memberDepositDetails = [];
    public $memberDepositSummary = null;

    public function mount()
    {
        $this->selectedMonth = Carbon::now()->format('F Y');

        // ✅ Due Month Tab Initial Data
        $this->dueMonth = Carbon::now()->format('F Y');
        $this->loadDueMembers();
        $this->pendingRequestsCount = DepositRequestModel::where('status', 'pending')->count();

        // ✅ শুধুমাত্র Cash, Bkash, Nagad, Rocket, Bank
        $this->paymentOptions = [
            ['value' => 'Cash', 'label' => '💵 Cash'],
            ['value' => 'Bkash', 'label' => '📱 Bkash'],
            ['value' => 'Nagad', 'label' => '📱 Nagad'],
            ['value' => 'Rocket', 'label' => '📱 Rocket'],
            ['value' => 'Bank', 'label' => '🏦 Main Bank'],
        ];
    }

    public function updatedSelectedMonth()
    {
        // ✅ মাস পরিবর্তন করলে যদি কোনো ডিপোজিট এডিট অবস্থায় থাকে, সেটি অটো ক্যানসেল হয়ে যাবে
        if ($this->editingPaidId) {
            $this->cancelEditedPaid($this->editingPaidId);
        }

        $this->generateDraftsForMonth();
        $this->calculateStats();
    }

    public function generateDraftsForMonth()
    {
        $selectedMonthYear = $this->getMonthYearFormat();
        $members = Member::all();

        // ✅ January 2026 থেকে selected month পর্যন্ত সব missing months এর draft তৈরি করো
        $allMonths = $this->getMonthList();

        foreach ($allMonths as $month) {
            $monthYear     = Carbon::parse('01 ' . $month)->format('Y-m');
            $previousMonth = Carbon::parse('01 ' . $month)->subMonth()->format('Y-m');

            $existingDeposits = Deposit::where('month_year', $monthYear)
                ->get()
                ->keyBy('member_id');

            foreach ($members as $member) {
                if (isset($existingDeposits[$member->id])) {
                    continue;
                }

                $depositAmount = $member->shares * 10000;

                $previousDue = Deposit::where('member_id', $member->id)
                    ->where('month_year', $previousMonth)
                    ->where('status', '!=', 'paid')
                    ->sum('due_amount');

                Deposit::create([
                    'member_id'      => $member->id,
                    'month_year'     => $monthYear,
                    'deposit_amount' => $depositAmount,
                    'due_amount'     => $previousDue,
                    'fine_amount'    => 0,
                    'payment_method' => 'Cash',
                    'paid_by'        => Auth::id(),
                    'paid_by_info'   => $this->getPaidByInfo(),
                    'status'         => 'draft',
                ]);
            }

            if ($monthYear === $selectedMonthYear) break;
        }
    }

    public function calculateStats()
    {
        $this->totalMembers = Member::count();
        $monthYear = $this->getMonthYearFormat();
        
        $paidDeposits = Deposit::where('month_year', $monthYear)->where('status', 'paid')->get();
        
        $this->paidMembers = $paidDeposits->count();
        $this->unpaidMembers = $this->totalMembers - $this->paidMembers;
        
        $this->totalCollection = $paidDeposits->sum('deposit_amount') + $paidDeposits->sum('due_amount') + $paidDeposits->sum('fine_amount') + $paidDeposits->sum('other_payment');
        $this->totalDueCollection = $paidDeposits->sum('due_amount');
        $this->totalFine = $paidDeposits->sum('fine_amount');
    }

    public function getMonthYearFormat()
    {
        try {
            return Carbon::parse('01 ' . $this->selectedMonth)->format('Y-m');
        } catch (\Exception $e) {
            return Carbon::now()->format('Y-m');
        }
    }

    public function getMonthList()
    {
        $start = Carbon::create(2026, 1, 1);
        $end = Carbon::now();
        $months = [];
        while ($start->lte($end)) {
            $months[] = $start->format('F Y');
            $start->addMonth();
        }
        return $months;
    }

    public function openAddDepositModal()
    {
        $this->generateDraftsForMonth();
        $this->calculateStats();
        $this->addDepositModal = true;
    }

    // ✅ Monthly Status থেকে সরাসরি মেম্বারের রোতে যাওয়ার মেথড
    public function goToDeposit($memberId, $monthYear = null)
    {
        if ($monthYear) {
            $this->selectedMonth = Carbon::parse($monthYear . '-01')->format('F Y');
        } else {
            $this->selectedMonth = $this->dueMonth;
        }
        
        $this->generateDraftsForMonth();
        $this->calculateStats();
        
        $this->addDepositModal = true;
        
        $this->dispatch('scroll-to-member', memberId: $memberId);
    }

    public function closeAddDepositModal()
    {
        $this->addDepositModal = false;
        $this->activeRequestInfo = null; // clear request reminder
    }

    public function getPaidByInfo()
    {
        $user = Auth::user();
        if ($user->username === 'admin' || $user->username === 'superadmin') {
            return 'Superadmin';
        } elseif (str_contains(strtolower($user->username ?? ''), 'admin')) {
            return 'Admin';
        } else {
            $member = Member::where('user_id', $user->id)->first();
            if ($member) return 'Member Acc# ' . $member->account_no;
        }
        return 'User';
    }

    public function openCommentModal($depositId)
    {
        $deposit = Deposit::find($depositId);
        $this->commentDepositId = $depositId;
        $this->commentText = $deposit->comment ?? '';
        $this->commentHistory = array_values(array_reverse($deposit->comment_history ?? []));
        $this->isPaidComment = $deposit->status === 'paid';
        $this->commentModal = true;
    }

    public function saveComment()
    {
        $deposit = Deposit::find($this->commentDepositId);
        if ($deposit) {
            $history = $deposit->comment_history ?? [];
            $history[] = [
                'date' => now()->format('d M Y, h:i A'),
                'user' => auth()->user()->name,
                'text' => $this->commentText,
            ];
            
            $deposit->comment_history = $history;
            $deposit->comment = $this->commentText;
            $deposit->save();
        }
        $this->commentModal = false;
        session()->flash('message', '💬 Comment saved!');
    }

    public function closeCommentModal() { $this->commentModal = false; }

    public function deleteCommentHistoryItem($depositId, $index)
    {
        if (Auth::user()->username !== 'admin' && Auth::user()->username !== 'superadmin') {
            session()->flash('message', '⛔ Only Superadmin can delete comment history.');
            return;
        }

        $deposit = Deposit::find($depositId);
        if ($deposit) {
            $history = $deposit->comment_history ?? [];
            $originalIndex = count($history) - 1 - $index;
            
            if (isset($history[$originalIndex])) {
                unset($history[$originalIndex]);
                $deposit->comment_history = array_values($history);
                
                $lastIndex = array_key_last($deposit->comment_history);
                $deposit->comment = $lastIndex !== null ? $deposit->comment_history[$lastIndex]['text'] : null;
                
                $deposit->save();
                
                $this->commentHistory = array_values(array_reverse($deposit->comment_history ?? []));
                $this->commentText = $deposit->comment ?? '';
                session()->flash('message', '🗑️ Comment history deleted!');
            }
        }
    }

    public function updateDueAmount($depositId, $value)
    {
        $deposit = Deposit::find($depositId);
        if ($deposit && $deposit->status === 'draft') {
            $deposit->due_amount = $value;
            $deposit->save();
            $this->calculateStats();
        }
    }

    public function updateFineAmount($depositId, $value)
    {
        $deposit = Deposit::find($depositId);
        if ($deposit && $deposit->status === 'draft') {
            // যদি ফাইন ০ করতে চায় কিন্তু আগে ফাইন বেশি ছিল, তাহলে রিজন চাইবে
            if ($value == 0 && $deposit->fine_amount > 0) {
                $this->waiverDepositId = $depositId;
                $this->waiverReason = '';
                $this->showFineWaiverModal = true;
                return; // এখানে স্টপ, মডালে ক্লিক করলে সেভ হবে
            }
            
            $deposit->fine_amount = $value;
            $deposit->save();
            $this->calculateStats();
        }
    }

    public function confirmFineWaiver()
    {
        $this->validate(['waiverReason' => 'required|string'], [
            'waiverReason.required' => 'Please provide a reason for waiving the fine.'
        ]);

        $deposit = Deposit::find($this->waiverDepositId);
        if ($deposit) {
            $history = $deposit->edit_history ?? [];
            $isSuperAdmin = (auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin');

            $history[] = [
                'date' => now()->format('d M Y, h:i A'),
                'user' => auth()->user()->name,
                'is_superadmin' => $isSuperAdmin,
                'action' => 'Fine Waived',
                'old_values' => ['fine_amount' => $deposit->fine_amount],
                'new_values' => ['fine_amount' => 0],
                'reason' => $this->waiverReason,
            ];
            $deposit->edit_history = $history;
            $deposit->fine_amount = 0; // ফাইন মওকুফ
            $deposit->save();
            $this->calculateStats();
            
            session()->flash('message', '✅ Fine waived successfully!');
        }
        
        $this->showFineWaiverModal = false;
        $this->waiverDepositId = null;
        $this->waiverReason = '';
    }

    public function closeFineWaiverModal()
    {
        $this->showFineWaiverModal = false;
        $this->waiverDepositId = null;
        $this->waiverReason = '';
    }

    public function updatePaymentMethod($depositId, $value) {
        $deposit = Deposit::find($depositId);
        if ($deposit) {
            // ✅ সরাসরি পেমেন্ট মেথড আপডেট (কোনো লকিং নেই)
            $deposit->payment_method = $value;
           
            $deposit->save();
        }
    }
    
    public function updateBankName($depositId, $value) {
        $deposit = Deposit::find($depositId);
        if ($deposit) { $deposit->bank_name = $value; $deposit->save(); }
    }

    // ===== Unlock Deposit Methods =====
    public function showUnlockModal($id)
    {
        // ✅ যদি আগেই কোনো ডিপোজিট এডিট করা অবস্থায় থাকে, তবে নতুনটি আনলক করতে দেবে না
        if ($this->editingPaidId) {
            session()->flash('message', '⚠️ Please save or cancel the current editing deposit first!');
            return;
        }

        $this->unlockDepositId = $id;
        $this->unlockDepositModal = true;
    }

    public function confirmUnlock()
    {
        // ✅ কোনো লকিং নেই, সরাসরি আনলক করা যাবে
        $deposit = Deposit::find($this->unlockDepositId);
        if ($deposit) {
            $this->originalDepositData = [
                'deposit_amount' => $deposit->deposit_amount,
                'due_amount' => $deposit->due_amount,
                'fine_amount' => $deposit->fine_amount,
                'payment_method' => $deposit->payment_method,
            ];

            $deposit->status = 'draft';
            $deposit->save();
            $this->editingPaidId = $this->unlockDepositId;
            $this->calculateStats();
            session()->flash('message', '✏️ Unlocked for editing!');
        }
        $this->unlockDepositModal = false;
        $this->unlockDepositId = null;
    }

    public function closeUnlockModal()
    {
        $this->unlockDepositModal = false;
        $this->unlockDepositId = null;
    }

    public function saveEditedPaid($id)
    {
        $deposit = Deposit::find($id);
        if (!$deposit) return;

        $currentData = [
            'deposit_amount' => $deposit->deposit_amount,
            'due_amount' => $deposit->due_amount,
            'fine_amount' => $deposit->fine_amount,
            'payment_method' => $deposit->payment_method,
        ];

        if ($this->originalDepositData == $currentData) {
            $deposit->status = 'paid';
            $deposit->save();
            $this->editingPaidId = null;
            $this->originalDepositData = null;
            session()->flash('message', '🔒 Locked back. No changes detected.');
        } else {
            $this->changeLogData = [
                'old' => $this->originalDepositData,
                'new' => $currentData,
                'deposit_id' => $id,
                'share' => $deposit->member->shares,
            ];

            $this->depositAmountChanged = $this->originalDepositData['deposit_amount'] != $currentData['deposit_amount'];

            // ✅ Due amount change হয়েছে কিনা check করো
            $oldDue = (float) $this->originalDepositData['due_amount'];
            $newDue = (float) $currentData['due_amount'];
            $dueChanged = $oldDue != $newDue;

            if ($dueChanged) {
                // ✅ Auto-paid months আছে কিনা check করো
                $autoPaidMonths = Deposit::where('member_id', $deposit->member_id)
                    ->where('month_year', '<', $deposit->month_year)
                    ->where('status', 'paid')
                    ->where('deposit_amount', 0)
                    ->orderBy('month_year', 'asc')
                    ->get();

                // ✅ Unpaid draft months ও আছে কিনা check করো
                $unpaidDraftMonths = Deposit::where('member_id', $deposit->member_id)
                    ->where('month_year', '<', $deposit->month_year)
                    ->where('status', 'draft')
                    ->orderBy('month_year', 'asc')
                    ->get();

                if ($autoPaidMonths->count() > 0 || $unpaidDraftMonths->count() > 0) {
                    // ✅ Popup খোলার জন্য data prepare করো
                    $this->adjustDepositId = $id;
                    $this->adjustNewDue = $newDue;
                    $this->autoPayAdjustMonths = [];
                    $this->selectedAdjustMonths = [];

                    // সব months একসাথে list করো (auto-paid + unpaid draft)
                    $allPreviousMonths = Deposit::where('member_id', $deposit->member_id)
                        ->where('month_year', '<', $deposit->month_year)
                        ->whereIn('status', ['paid', 'draft'])
                        ->where(function($q) {
                            $q->where('deposit_amount', 0) // auto-paid
                              ->orWhere('status', 'draft'); // unpaid draft
                        })
                        ->orderBy('month_year', 'asc')
                        ->get();

                    $coveredTotal = 0;
                    foreach ($allPreviousMonths as $m) {
                        $mAmount = $m->member->shares * 10000;
                        $isAutoPaid = $m->status === 'paid' && $m->deposit_amount == 0;
                        $canCover = ($coveredTotal + $mAmount) <= $newDue;

                        $this->autoPayAdjustMonths[] = [
                            'id'          => $m->id,
                            'month_year'  => $m->month_year,
                            'month_label' => Carbon::parse($m->month_year . '-01')->format('F Y'),
                            'amount'      => $mAmount,
                            'is_auto_paid'=> $isAutoPaid,
                        ];

                        // ✅ Auto-select: due দিয়ে cover হওয়া months checked থাকবে
                        if ($canCover) {
                            $this->selectedAdjustMonths[] = $m->id;
                            $coveredTotal += $mAmount;
                        }
                    }

                    $this->showAutoPayAdjustModal = true;
                    return; // ChangeLog modal এখন খুলবে না
                }
            }

            // Due change হয়নি বা auto-paid নেই — সরাসরি ChangeLog modal
            $this->showChangeLogModal = true;
        }
    }

    public function confirmChangeLogSave()
    {
        if ($this->depositAmountChanged) {
            $this->validate(['changeLogComment' => 'required|string'], [
                'changeLogComment.required' => 'Please write a reason for changing the deposit amount.'
            ]);
        }

        $deposit = Deposit::find($this->changeLogData['deposit_id']);
        if ($deposit) {
            $history = $deposit->edit_history ?? [];
            $isSuperAdmin = (auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin');

            $editEntry = [
                'date' => now()->format('d M Y, h:i A'),
                'user' => auth()->user()->name,
                'is_superadmin' => $isSuperAdmin, // ক্রাউন আইকন দেখানোর জন্য ফ্ল্যাগ
                'action' => 'Edited', 
                'old_values' => $this->changeLogData['old'],
                'new_values' => $this->changeLogData['new'],
            ];
            
            if ($this->depositAmountChanged && $this->changeLogComment) {
                $editEntry['reason'] = $this->changeLogComment;
            }

            $history[] = $editEntry;
            $deposit->edit_history = $history;
            $deposit->status = 'paid';
            $deposit->save();

            // ✅ save করার পর fresh model নাও যাতে due_amount সঠিক থাকে
            $deposit->refresh();

            $this->editingPaidId = null;
            $this->originalDepositData = null;
            $this->showChangeLogModal = false;
            $this->changeLogData = null;
            $this->depositAmountChanged = false;
            $this->changeLogComment = '';
            
            session()->flash('message', '✅ Saved successfully with change log!');
        }
    }



    // ✅ Auto-Pay Adjust Modal — Confirm
    public function confirmAutoPayAdjust()
    {
        $deposit = Deposit::find($this->adjustDepositId);
        if (!$deposit) return;

        $isSuperAdmin = (auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin');

        foreach ($this->autoPayAdjustMonths as $monthData) {
            $ap = Deposit::find($monthData['id']);
            if (!$ap) continue;

            $isChecked = in_array($monthData['id'], $this->selectedAdjustMonths);
            $isCurrentlyAutoPaid = $ap->status === 'paid' && $ap->deposit_amount == 0;

            if ($isChecked && !$isCurrentlyAutoPaid) {
                // ✅ নতুন check করা month — paid করো (auto-pay)
                $apHistory = $ap->edit_history ?? [];
                $apHistory[] = [
                    'date'          => now()->format('d M Y, h:i A'),
                    'user'          => auth()->user()->name,
                    'is_superadmin' => $isSuperAdmin,
                    'action'        => 'Paid',
                    'details'       => 'Paid via due adjustment in ' . Carbon::parse($deposit->month_year . '-01')->format('F Y') . '.',
                ];
                $ap->status = 'paid';
                $ap->deposit_amount = 0;
                $ap->fine_amount = 0;
                $ap->transaction_id = 'TXN-' . now()->format('ymdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4));
                $ap->edit_history = $apHistory;
                $ap->save();

            } elseif (!$isChecked && $isCurrentlyAutoPaid) {
                // ✅ Uncheck করা auto-paid month — draft এ revert করো
                $apAmount = $ap->member->shares * 10000;
                $apHistory = $ap->edit_history ?? [];
                $apHistory[] = [
                    'date'          => now()->format('d M Y, h:i A'),
                    'user'          => auth()->user()->name,
                    'is_superadmin' => $isSuperAdmin,
                    'action'        => 'Reverted',
                    'details'       => 'Auto-pay reverted: due adjusted in ' . Carbon::parse($deposit->month_year . '-01')->format('F Y') . '.',
                ];
                $ap->status = 'draft';
                $ap->deposit_amount = $apAmount;
                $ap->transaction_id = null;
                $ap->edit_history = $apHistory;
                $ap->save();
            }
            // checked + already auto-paid → কোনো change নেই
            // unchecked + draft → কোনো change নেই
        }

        // ✅ Modal বন্ধ করো, ChangeLog modal খোলো
        $this->showAutoPayAdjustModal = false;
        $this->autoPayAdjustMonths = [];
        $this->selectedAdjustMonths = [];
        $this->adjustDepositId = null;
        $this->adjustNewDue = 0;

        // এখন ChangeLog modal খোলো
        $this->showChangeLogModal = true;
    }

    public function closeAutoPayAdjustModal()
    {
        $this->showAutoPayAdjustModal = false;
        $this->autoPayAdjustMonths = [];
        $this->selectedAdjustMonths = [];
        $this->adjustDepositId = null;
        $this->adjustNewDue = 0;
    }

    public function closeChangeLogModal()
    {        $this->showChangeLogModal = false;
        $this->depositAmountChanged = false;
        $this->changeLogComment = '';
    }

    public function openEditHistoryModal($id)
    {
        $deposit = Deposit::find($id);
        $this->editHistoryDepositId = $id; 
        $this->editHistoryData = $deposit->edit_history ?? [];
        $this->showEditHistoryModal = true;
    }

    public function closeEditHistoryModal()
    {
        $this->showEditHistoryModal = false;
        $this->editHistoryData = null;
    }

    public function deleteEditHistoryItem($index)
    {
        if (auth()->user()->username !== 'admin' && auth()->user()->username !== 'superadmin') {
            session()->flash('message', '⛔ Only Superadmin can delete audit history.');
            return;
        }

        $deposit = Deposit::find($this->editHistoryDepositId);
        
        if ($deposit) {
            $history = $deposit->edit_history ?? [];
            $originalIndex = count($history) - 1 - $index;
            
            if (isset($history[$originalIndex])) {
                unset($history[$originalIndex]);
                $deposit->edit_history = array_values($history);
                $deposit->save();
                
                $this->editHistoryData = $deposit->edit_history ?? [];
                session()->flash('message', '🗑️ History log deleted!');
            }
        }
    }

    public function cancelEditedPaid($id)
    {
        $deposit = Deposit::find($id);
        if ($deposit && $this->originalDepositData) {
            $deposit->deposit_amount = $this->originalDepositData['deposit_amount'];
            $deposit->due_amount = $this->originalDepositData['due_amount'];
            $deposit->fine_amount = $this->originalDepositData['fine_amount'];
            $deposit->payment_method = $this->originalDepositData['payment_method'];
            
            $deposit->status = 'paid';
            $deposit->save();
            $this->calculateStats();
        }
        $this->editingPaidId = null;
        $this->originalDepositData = null;
    }

    // ===== Delete Deposit Methods =====
    public function showDeleteModal($id)
    {
        $this->deleteDepositId = $id;
        $this->clear_comment = false; 
        $this->clear_history = false; 
        $this->deleteOtherReasons = false;
        $this->deleteDepositModal = true;
    }

    public function confirmDelete()
    {
        $deposit = Deposit::find($this->deleteDepositId);
        if ($deposit) {
            $isSuperadmin = Auth::user()->username === 'admin' || Auth::user()->username === 'superadmin';
            
            $oldDeposit = $deposit->deposit_amount;
            $oldDue = $deposit->due_amount;
            $oldFine = $deposit->fine_amount;

            $deposit->deposit_amount = $deposit->member->shares * 10000;
            $deposit->due_amount = 0;
            $deposit->fine_amount = 0;
            $deposit->other_payment = 0; // ✅ Other Payment কে 0 করার কোড যোগ করা হয়েছে
            $deposit->status = 'draft';
            $deposit->transaction_id = null;

            if ($isSuperadmin && $this->clear_history) {
                $deposit->edit_history = []; 
            } else {
                $history = $deposit->edit_history ?? [];
                $history[] = [
                    'date' => now()->format('d M Y, h:i A'),
                    'user' => auth()->user()->name,
                    'action' => 'Cleared',
                    'details' => 'Record cleared. (Old Deposit: ৳'.number_format($oldDeposit,0).', Due: ৳'.number_format($oldDue,0).', Fine: ৳'.number_format($oldFine,0).')'
                ];
                $deposit->edit_history = $history;
            }

            if ($isSuperadmin && $this->clear_comment) {
                $deposit->comment = null;
                $deposit->comment_history = []; 
            }

            // ✅ নতুন চেকবক্সের লজিক
            if ($isSuperadmin && $this->deleteOtherReasons) {
                $deposit->other_reason_history = [];
                $deposit->other_payment_reason = null;
            }

            $deposit->save();

            // ✅ Auto-paid previous months গুলো draft এ ফিরিয়ে দাও
            $currentMonthYear = $deposit->month_year;
            Deposit::with('member')
                ->where('member_id', $deposit->member_id)
                ->where('month_year', '<', $currentMonthYear)
                ->where('status', 'paid')
                ->where('deposit_amount', 0)
                ->each(function ($autoPaid) {
                    $autoPaid->status = 'draft';
                    $autoPaid->deposit_amount = $autoPaid->member->shares * 10000;
                    $autoPaid->transaction_id = null;
                    $history = $autoPaid->edit_history ?? [];
                    $history[] = [
                        'date'   => now()->format('d M Y, h:i A'),
                        'user'   => auth()->user()->name,
                        'action' => 'Reverted',
                        'details' => 'Auto-pay reverted due to parent month deletion.',
                    ];
                    $autoPaid->edit_history = $history;
                    $autoPaid->save();
                });

            $this->editingPaidId = null;
            $this->calculateStats();
            session()->flash('message', '🗑️ Record cleared! Deposit reset to default share value.');
        }
        $this->closeDeleteModal();
    }

    public function closeDeleteModal()
    {
        $this->deleteDepositModal = false;
        $this->deleteDepositId = null;
        $this->clear_comment = false; 
        $this->clear_history = false; 
        $this->deleteOtherReasons = false;
    }

    public function showPayConfirmModal($id)
    {
        $deposit = Deposit::find($id);

        // ✅ যদি Other Payment > 0 হয় কিন্তু Reason খালি থাকে, 
        // তাহলে Pay মডাল খুলবে না, বরং বাধ্য করে আবার Reason মডাল খুলবে
        if ($deposit && $deposit->other_payment > 0 && empty($deposit->other_payment_reason)) {
            $this->otherPaymentId = $deposit->id;
            $this->tempOtherPaymentValue = $deposit->other_payment;
            $this->otherPaymentReason = '';
            $this->showOtherPaymentReasonModal = true;
            return; // এখানে স্টপ করে দিচ্ছি, নিচের কোড রান হবে না
        }

        // ✅ রিজন দেওয়া থাকলে বা Other Pay 0 হলে সরাসরি Pay মডাল ওপেন হবে
        // \u2705 Checkbox-based due month selection
        $this->autoPayMonths = [];
        $this->selectedAutoPayMonths = [];
        $this->autoPayTotalMismatch = false;

        if ($deposit && $deposit->due_amount > 0) {
            $currentMonthYear = $this->getMonthYearFormat();

            $unpaidDeposits = Deposit::where('member_id', $deposit->member_id)
                ->where('month_year', '<', $currentMonthYear)
                ->where('status', 'draft')
                ->orderBy('month_year', 'asc')
                ->get();

            foreach ($unpaidDeposits as $unpaid) {
                $this->autoPayMonths[] = [
                    'id'          => $unpaid->id,
                    'month_year'  => $unpaid->month_year,
                    'month_label' => Carbon::parse($unpaid->month_year . '-01')->format('F Y'),
                    'amount'      => $unpaid->deposit_amount,
                ];
            }
        }

        $this->payDepositId = $id;
        $this->payDepositData = Deposit::with('member')->find($id);
        $this->payDepositModal = true;
    }

    public function confirmPay()
    {
        $deposit = Deposit::find($this->payDepositId);
        if ($deposit) {
            // ✅ Validation: selected months total > due_amount হলে block করো
            if (!empty($this->selectedAutoPayMonths)) {
                $selectedTotal = collect($this->autoPayMonths)
                    ->whereIn('id', $this->selectedAutoPayMonths)
                    ->sum('amount');
                if ($selectedTotal > $deposit->due_amount) {
                    session()->flash('message', '⚠️ Selected months total (৳' . number_format($selectedTotal, 0) . ') exceeds due amount (৳' . number_format($deposit->due_amount, 0) . '). Please uncheck some months.');
                    return;
                }
            }

            $history = $deposit->edit_history ?? [];
            $isSuperAdmin = (auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin');
            $currentMonthLabel = \Carbon\Carbon::parse($deposit->month_year . '-01')->format('F Y');

            // \u2705 Checkbox selected months pay \u0995\u09b0\u09cb
            if ($deposit->due_amount > 0 && !empty($this->selectedAutoPayMonths)) {
                foreach ($this->selectedAutoPayMonths as $prevId) {
                    $prevDeposit = Deposit::find($prevId);
                    if (!$prevDeposit || $prevDeposit->status === 'paid') continue;

                    $prevHistory = $prevDeposit->edit_history ?? [];
                    $prevHistory[] = [
                        'date'          => now()->format('d M Y, h:i A'),
                        'user'          => auth()->user()->name,
                        'is_superadmin' => $isSuperAdmin,
                        'action'        => 'Paid',
                        'details'       => 'Paid via ' . $currentMonthLabel . ' due collection.',
                    ];

                    $prevDeposit->deposit_amount = 0;
                    $prevDeposit->fine_amount    = 0;
                    $prevDeposit->status         = 'paid';
                    $prevDeposit->paid_by        = Auth::id();
                    $prevDeposit->paid_by_info   = $this->getPaidByInfo();
                    $prevDeposit->edit_history   = $prevHistory;
                    $prevDeposit->transaction_id = 'TXN-' . now()->format('ymdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4));
                    $prevDeposit->save();
                }
            }

            
            $details = 'Payment recorded. Deposit: ৳' . number_format($deposit->deposit_amount, 0) . ', Due: ৳' . number_format($deposit->due_amount, 0) . ', Fine: ৳' . number_format($deposit->fine_amount, 0);
            if ($deposit->other_payment > 0) {
                $details .= ', Other Pay: ৳' . number_format($deposit->other_payment, 0);
            }

            // ✅ Auto-paid months list current deposit এর history তে যোগ করা
            $autoPaidLabels = [];
            if (!empty($this->selectedAutoPayMonths)) {
                foreach ($this->selectedAutoPayMonths as $prevId) {
                    $prev = Deposit::find($prevId);
                    if ($prev) {
                        $autoPaidLabels[] = \Carbon\Carbon::parse($prev->month_year . '-01')->format('F Y');
                    }
                }
            }
            if (!empty($autoPaidLabels)) {
                $details .= ' | Auto-paid months: ' . implode(', ', $autoPaidLabels);
            }

            $history[] = [
                'date' => now()->format('d M Y, h:i A'),
                'user' => auth()->user()->name,
                'is_superadmin' => $isSuperAdmin,
                'action' => 'Paid',
                'details' => $details
            ];
            $deposit->edit_history = $history;

            $deposit->status = 'paid';
            $deposit->paid_by = Auth::id();
            $deposit->paid_by_info = $this->getPaidByInfo();
            
            if (!$deposit->transaction_id) {
                $deposit->transaction_id = 'TXN-' . now()->format('ymdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4));
            }
            
            $deposit->save();
            
            $this->calculateStats();
            
            // ✅ অটো রিসিপ্ট পপআপ বন্ধ করা হয়েছে, পরে Action থেকে Print করা যাবে
            $this->payDepositModal = false; 
            session()->flash('message', '✅ Payment successful! You can print the receipt from the action column.');
        }
        $this->payDepositId = null;
        $this->payDepositData = null;
        $this->autoPayMonths         = [];
        $this->selectedAutoPayMonths = [];
        $this->autoPayTotalMismatch  = false;
    }


    public function closeReceiptModal()
    {
        $this->receiptModal = false;
        $this->receiptData = null;
    }
    
      public function openReceiptModal($id)
    {
        $this->receiptData = Deposit::with('member')->find($id);
        if ($this->receiptData) {
            $this->receiptModal = true;
        }
    }

    public function closePayConfirmModal()
    {
        $this->payDepositModal  = false;
        $this->payDepositId     = null;
        $this->payDepositData   = null;
        $this->autoPayMonths          = [];
        $this->selectedAutoPayMonths  = [];
        $this->autoPayTotalMismatch   = false;
    }

    // Draft Deposit Amount Edit Methods
    public function editDraftDepositAmount($id, $currentValue)
    {
        $this->editingDraftDepositId = $id;
        $this->editingDraftDepositValue = $currentValue;
    }

    public function cancelDraftDepositAmount()
    {
        $this->editingDraftDepositId = null;
        $this->editingDraftDepositValue = null;
    }

    public function saveDraftDepositAmount($id)
    {
        $deposit = Deposit::find($id);
        if (!$deposit) return;

        $defaultAmount = $deposit->member->shares * 10000;

        if ($this->editingDraftDepositValue != $defaultAmount) {
            $this->showDraftChangeReasonModal = true;
        } else {
            $deposit->deposit_amount = $this->editingDraftDepositValue;
            $deposit->save();
            $this->calculateStats();
            $this->editingDraftDepositId = null;
            $this->editingDraftDepositValue = null;
            session()->flash('message', '✅ Deposit amount reset to default!');
        }
    }

     public function confirmDraftChangeSave()
    {
        $this->validate(['draftChangeReason' => 'required|string'], [
            'draftChangeReason.required' => 'Please provide a reason for changing the deposit amount.'
        ]);

        $deposit = Deposit::find($this->editingDraftDepositId);
        if ($deposit) {
            $history = $deposit->edit_history ?? [];
            $isSuperAdmin = (auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin');

            // ✅ Deposit এডিটের হিস্ট্রি (Other Pay এর মতো ফরম্যাট)
            $history[] = [
                'date' => now()->format('d M Y, h:i A'),
                'user' => auth()->user()->name,
                'is_superadmin' => $isSuperAdmin,
                'action' => 'Edited Draft',
                'old_values' => [
                    'deposit_amount' => $deposit->deposit_amount, // আগের টাকা
                ],
                'new_values' => [
                    'deposit_amount' => $this->editingDraftDepositValue, // নতুন টাকা
                ],
                'reason' => $this->draftChangeReason, // রিজন
            ];
            $deposit->edit_history = $history;
            
            $deposit->deposit_amount = $this->editingDraftDepositValue;
            $deposit->save();
            
            $this->calculateStats();
            session()->flash('message', '✅ Deposit amount updated with change log!');
        }
        
        $this->showDraftChangeReasonModal = false;
        $this->editingDraftDepositId = null;
        $this->editingDraftDepositValue = null;
        $this->draftChangeReason = '';
    }

    public function closeDraftChangeReasonModal()
    {
        $this->showDraftChangeReasonModal = false;
    }

     public function editOtherPayment($id, $currentValue)
    {
        $this->editingOtherPaymentId = $id;
        $this->editingOtherPaymentValue = $currentValue;
    }

    public function cancelOtherPayment()
    {
        $this->editingOtherPaymentId = null;
        $this->editingOtherPaymentValue = null;
    }

    public function saveOtherPayment($id)
    {
        $deposit = Deposit::find($id);
        if (!$deposit || $deposit->status !== 'draft') return;

        $value = (float) $this->editingOtherPaymentValue;

        // যদি টাকা ০ এর বেশি হয় এবং আগের টাকা থেকে পরিবর্তন হয়
        if ($value > 0 && $deposit->other_payment != $value) {
            $this->otherPaymentId = $id;
            $this->tempOtherPaymentValue = $value;
            $this->otherPaymentReason = '';
            $this->showOtherPaymentReasonModal = true;
        } 
        // যদি টাকা ০ করে দেওয়া হয়
        elseif ($value <= 0 && $deposit->other_payment > 0) {
            $deposit->other_payment = $value;
            $deposit->other_payment_reason = null;
            $deposit->save();
            $this->calculateStats();
            $this->cancelOtherPayment();
        } 
        else {
            $this->cancelOtherPayment();
        }
    }


    public function confirmOtherPaymentSave()
    {
        $this->validate(['otherPaymentReason' => 'required|string'], [
            'otherPaymentReason.required' => 'Please provide a reason for this payment.'
        ]);

        $deposit = Deposit::find($this->otherPaymentId);
        if ($deposit) {
            $isSuperAdmin = (auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin');

            // ✅ Other Pay Reason History তে নতুন রিজন অ্যাড করা (কমেন্ট হিস্ট্রির মতো)
            $reasonHistory = $deposit->other_reason_history ?? [];
            $reasonHistory[] = [
                'date' => now()->format('d M Y, h:i A'),
                'user' => auth()->user()->name,
                'is_superadmin' => $isSuperAdmin,
                'text' => $this->otherPaymentReason,
            ];
            $deposit->other_reason_history = $reasonHistory;
            $deposit->other_payment_reason = $this->otherPaymentReason; // সর্বশেষ রিজন

            // ✅ অডিট এডিট হিস্ট্রি (Deposit এডিটের ফরম্যাট)
            $history = $deposit->edit_history ?? [];
            $history[] = [
                'date' => now()->format('d M Y, h:i A'),
                'user' => auth()->user()->name,
                'is_superadmin' => $isSuperAdmin,
                'action' => 'Edited Draft', // উপরে Edited Draft ব্যাজ দেখানোর জন্য
                'old_values' => [
                    'other_payment' => $deposit->other_payment, // আগের টাকা
                ],
                'new_values' => [
                    'other_payment' => $this->tempOtherPaymentValue, // নতুন টাকা
                ],
                'reason' => $this->otherPaymentReason, // রিজনটিও এখানে সেভ হবে
            ];
            $deposit->edit_history = $history;

            $deposit->other_payment = $this->tempOtherPaymentValue;
            $deposit->save();
            $this->calculateStats();
            
            $this->showOtherPaymentReasonModal = false;
            $this->otherPaymentId = null;
            $this->tempOtherPaymentValue = null;
            $this->otherPaymentReason = '';
            $this->editingOtherPaymentId = null;
            $this->editingOtherPaymentValue = null;

            // $this->showPayConfirmModal($deposit->id);
            
            session()->flash('message', '✅ Other payment updated with reason!');
        }
    }

        public function deleteOtherReasonHistoryItem($depositId, $index)
    {
        if (Auth::user()->username !== 'admin' && Auth::user()->username !== 'superadmin') {
            session()->flash('message', '⛔ Only Superadmin can delete other pay reasons.');
            return;
        }

        $deposit = Deposit::find($depositId);
        if ($deposit) {
            $history = $deposit->other_reason_history ?? [];
            $originalIndex = count($history) - 1 - $index; // Reverse index fix
            
            if (isset($history[$originalIndex])) {
                unset($history[$originalIndex]);
                $deposit->other_reason_history = array_values($history);
                
                // সর্বশেষ রিজন আপডেট করা
                $lastIndex = array_key_last($deposit->other_reason_history);
                $deposit->other_payment_reason = $lastIndex !== null ? $deposit->other_reason_history[$lastIndex]['text'] : null;
                
                $deposit->save();
                
                // রিসিপ্ট মডাল ওপেন থাকলে ডাটা রিফ্রেশ করা
                if ($this->receiptModal && $this->receiptData && $this->receiptData->id == $depositId) {
                    $this->receiptData = Deposit::with('member')->find($depositId);
                }
                
                session()->flash('message', '🗑️ Other pay reason deleted!');
            }
        }
    }


    public function closeOtherPaymentReasonModal()
    {
        // ক্যানসেল করলে শুধু মডাল বন্ধ হবে, কিন্তু ডাটাবেসে টাকা সেভ থাকবে 
        // এবং রিজন খালি থাকবে, তাই পে করতে গেলে আবার রিজন চাইবে
        $this->showOtherPaymentReasonModal = false;
        $this->otherPaymentId = null;
        $this->tempOtherPaymentValue = null;
        $this->otherPaymentReason = '';
    }

    // ===== Member Deposit Status Tab Methods =====
    public function updatedSelectedStatusMemberId()
    {
        $this->loadMemberDepositStatus();
    }

    public function loadMemberDepositStatus()
    {
        if ($this->selectedStatusMemberId) {
            $this->memberDepositDetails = Deposit::where('member_id', $this->selectedStatusMemberId)
                ->orderBy('month_year', 'desc')
                ->get();

            $paidDeposits = $this->memberDepositDetails->where('status', 'paid');
            $this->memberDepositSummary = (object)[
                'total_paid_months' => $paidDeposits->count(),
                'total_unpaid_months' => $this->memberDepositDetails->where('status', 'draft')->count(),
                'total_deposit' => $paidDeposits->sum('deposit_amount'),
                'total_due' => $paidDeposits->sum('due_amount'),
                'total_fine' => $paidDeposits->sum('fine_amount'),
                'total_other' => $paidDeposits->sum('other_payment'),
            ];
        } else {
            $this->memberDepositDetails = [];
            $this->memberDepositSummary = null;
        }
    }

    public function downloadMemberDepositReport()
    {
        $member = Member::find($this->selectedStatusMemberId);
        if (!$member) return;

        $deposits = Deposit::where('member_id', $this->selectedStatusMemberId)
            ->orderBy('month_year', 'desc')
            ->get();

        $filename = 'deposit-' . $member->account_no . '.csv';

        return response()->streamDownload(function () use ($deposits, $member) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['Deposit Report - ' . $member->name_english . ' (Acc#' . $member->account_no . ')']);
            fputcsv($handle, []);
            fputcsv($handle, ['Month', 'Status', 'Deposit(৳)', 'Due(৳)', 'Fine(৳)', 'Other Pay(৳)', 'Total(৳)', 'Payment Method', 'Paid By']);

            $tDeposit = 0; $tDue = 0; $tFine = 0; $tOther = 0;

            foreach ($deposits as $d) {
                $monthName = Carbon::parse($d->month_year . '-01')->format('F Y');
                $total = $d->deposit_amount + $d->due_amount + $d->fine_amount + $d->other_payment;
                fputcsv($handle, [$monthName, ucfirst($d->status), $d->deposit_amount, $d->due_amount, $d->fine_amount, $d->other_payment, $total, $d->payment_method, $d->paid_by_info]);

                if ($d->status === 'paid') {
                    $tDeposit += $d->deposit_amount;
                    $tDue += $d->due_amount;
                    $tFine += $d->fine_amount;
                    $tOther += $d->other_payment;
                }
            }

            fputcsv($handle, []);
            fputcsv($handle, ['TOTAL (Paid Only)', '', $tDeposit, $tDue, $tFine, $tOther, $tDeposit + $tDue + $tFine + $tOther]);

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    // ===== Due Month Tab Methods =====
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        if ($tab === 'due') {
            $this->loadDueMembers();
        } elseif ($tab === 'member-status' && $this->selectedStatusMemberId) {
            $this->loadMemberDepositStatus();
        } elseif ($tab === 'requests') {
            $this->loadDepositRequests();
        }
    }

    public function updatedDueMonth()
    {
        $this->loadDueMembers();
    }

    public function loadDueMembers()
    {
        $monthYear = Carbon::parse('01 ' . $this->dueMonth)->format('Y-m');
        
        // শুধু বকেয়াদের না, ঐ মাসের সব মেম্বারের ডাটা আনবে (Paid ও Unpaid সব)
        $this->dueMembers = Deposit::where('month_year', $monthYear)
            ->with('member')
            ->get()
            ->sortBy('member.account_no');
    }

    // ✅ ১৫ তারিখের পর থেকে মাস শেষ হওয়ার আগে পর্যন্ত (Late Period)
    public function isLatePeriod()
    {
        $selectedMonth = Carbon::parse('01 ' . $this->selectedMonth);
        $now = Carbon::now();
        return $selectedMonth->isSameMonth($now) && $now->day > 15;
    }

    // ✅ মাস শেষ হয়ে গেলে বা পুরনো মাস হলে (Past Due Period)
    public function isPastDuePeriod()
    {
        $selectedMonth = Carbon::parse('01 ' . $this->selectedMonth);
        $now = Carbon::now();
        // যদি সিলেক্ট করা মাসটি বর্তমান মাসের আগের হয়
        if ($selectedMonth->lt($now->startOfMonth())) {
            return true;
        }
        // বর্তমান মাসের শেষ দিন (৩০/৩১) পার হয়ে গেলেও Past Due ধরা হবে
        if ($selectedMonth->isSameMonth($now) && $now->day >= 30) {
            return true;
        }
        return false;
    }

    // ===== Deposit Requests Tab Methods =====

    public function loadDepositRequests()
    {
        $query = DepositRequestModel::with('member')
            ->orderBy('created_at', 'desc');

        if ($this->requestsFilter !== 'all') {
            $query->where('status', $this->requestsFilter);
        }

        $this->depositRequests = $query->get()->toArray();
        $this->pendingRequestsCount = DepositRequestModel::where('status', 'pending')->count();
    }

    public function updatedRequestsFilter()
    {
        $this->loadDepositRequests();
    }

    public function openApproveModal($requestId)
    {
        // Replaced by viewDepositRequest() + markRequestDone()
    }

    public function confirmApprove()
    {
        // Replaced by markRequestDone()
    }

    public function closeApproveModal()
    {
        $this->approveRequestModal = false;
        $this->approvingRequest    = null;
    }

    // ── View: Add Deposit modal খুলবে সঠিক month + member এ ──
    public function viewDepositRequest($requestId)
    {
        $request = DepositRequestModel::with('member')->find($requestId);
        if (!$request) return;

        // Store request info so Add Deposit modal can show it as reminder
        $this->activeRequestInfo = [
            'id'             => $request->id,
            'member_name'    => $request->member->name_english,
            'account_no'     => $request->member->account_no,
            'month_label'    => Carbon::parse($request->month_year . '-01')->format('F Y'),
            'month_year'     => $request->month_year,
            'deposit_amount' => (float)($request->deposit_amount ?? 0),
            'due_amount'     => (float)($request->due_amount     ?? 0),
            'fine_amount'    => (float)($request->fine_amount    ?? 0),
            'amount'         => (float)($request->amount         ?? 0),
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'screenshot'     => $request->screenshot,
            'note'           => $request->note,
        ];

        // Switch away from requests tab, open deposit modal at correct month+member
        $this->activeTab = 'recent';
        $this->goToDeposit($request->member_id, $request->month_year);
    }

    // ── Mark Done: শুধু status change, deposit table untouched ──
    public function markRequestDone($requestId)
    {
        $request = DepositRequestModel::with('member')->find($requestId);
        if (!$request || $request->status !== 'pending') return;

        $request->status   = 'approved';
        $request->admin_id = auth()->id();
        $request->save();

        // Create approval notice
        if (class_exists(\App\Models\Notice::class) && $request->member) {
            $member = $request->member;
            $amount = number_format($request->amount, 0);
            $month = \Carbon\Carbon::parse($request->month_year . '-01')->format('F Y');

            \App\Models\Notice::create([
                'title' => '✅ Deposit Request Approved',
                'message' => "Dear {$member->name_english} (Acc#{$member->account_no}, Share#{$member->shares}) Your deposit request for {$month} of ৳{$amount} has been approved by admin.",
                'priority' => 'normal',
                'target_group' => 'specific',
                'target_member_ids' => [(string)$member->id],
                'source' => 'deposit_request',
                'created_by' => auth()->id(),
            ]);
        }

        $this->loadDepositRequests();
        session()->flash('message', '✅ Request marked as done.');
    }


    public function openRejectModal($requestId)
    {
        $this->rejectingRequestId = $requestId;
        $this->rejectRemark       = '';
        $this->rejectRequestModal = true;
    }

    public function confirmReject()
    {
        $this->validate(['rejectRemark' => 'required|string|min:3'], [
            'rejectRemark.required' => 'Rejection কারণ লিখুন।',
            'rejectRemark.min'      => 'কমপক্ষে ৩ অক্ষর লিখুন।',
        ]);

        $request = DepositRequestModel::with('member')->find($this->rejectingRequestId);
        if ($request) {
            $request->status       = 'rejected';
            $request->admin_id     = auth()->id();
            $request->admin_remark = $this->rejectRemark;
            $request->save();

            // Create rejection notice
            if (class_exists(\App\Models\Notice::class) && $request->member) {
                $member = $request->member;
                $amount = number_format($request->amount, 0);
                $month = \Carbon\Carbon::parse($request->month_year . '-01')->format('F Y');

                \App\Models\Notice::create([
                    'title' => '⛔ Deposit Request Rejected',
                    'message' => "Dear {$member->name_english} (Acc#{$member->account_no}, Share#{$member->shares}) Your deposit request for {$month} of ৳{$amount} has been rejected. Reason: {$this->rejectRemark}",
                    'priority' => 'urgent',
                    'target_group' => 'specific',
                    'target_member_ids' => [(string)$member->id],
                    'source' => 'deposit_request',
                    'created_by' => auth()->id(),
                ]);
            }
        }

        $this->rejectRequestModal  = false;
        $this->rejectingRequestId  = null;
        $this->rejectRemark        = '';
        $this->loadDepositRequests();
        session()->flash('message', '⛔ Request rejected.');
    }


    public function closeRejectModal()
    {
        $this->rejectRequestModal = false;
        $this->rejectingRequestId = null;
        $this->rejectRemark       = '';
    }

    // ── Approved request: deposit collection এ member+month দেখুন ──
    public function viewApprovedRequestDeposit($requestId)
    {
        $request = DepositRequestModel::find($requestId);
        if (!$request) return;

        $this->activeRequestInfo = null;
        $this->activeTab = 'recent';
        $this->goToDeposit($request->member_id, $request->month_year);
    }

    public function openRejectReasonModal($requestId)
    {
        $request = DepositRequestModel::find($requestId);
        if (!$request || !$request->admin_remark) return;

        $this->viewingRejectRemark = $request->admin_remark;
        $this->showRejectReasonModal = true;
    }

    public function closeRejectReasonModal()
    {
        $this->showRejectReasonModal = false;
        $this->viewingRejectRemark = '';
    }

    public function render()
    {
        $months = $this->getMonthList();
        $monthYear = $this->getMonthYearFormat();
        
        $allMembers = Member::orderByRaw('CAST(account_no AS UNSIGNED) ASC')->get();

        $query = Deposit::where('month_year', $monthYear)->with('member');

        if ($this->selectedMemberId) {
            $query->where('member_id', $this->selectedMemberId);
        }

        $deposits = $query->get()->sortBy('member.account_no');

        // ✅ সামগ্রিক স্ট্যাটস (Overall Dashboard) - শুধুমাত্র Paid ডিপোজিট থেকে
        $overallStats = Deposit::where('status', 'paid')->selectRaw('
            COALESCE(SUM(deposit_amount), 0) as total_savings,
            COALESCE(SUM(due_amount), 0) as total_due,
            COALESCE(SUM(fine_amount), 0) as total_fine,
            COALESCE(SUM(other_payment), 0) as total_other
        ')->first();

        // ✅ Total Balance Calculation (শুধুমাত্র ডিপোজিট থেকে আসা মোট আয়)
        $totalBalance = $overallStats->total_savings + $overallStats->total_due + $overallStats->total_fine + $overallStats->total_other;

        // ✅ সাম্প্রতিক কার্যক্রম (শুধুমাত্র Paid ডিপোজিট দেখাবে, অটো ড্রাফট নয়)
        $recentActivitiesQuery = Deposit::with('member')->where('status', 'paid');

        if ($this->recentFilterMonth !== 'all') {
            $recentMonthYear = Carbon::parse('01 ' . $this->recentFilterMonth)->format('Y-m');
            $recentActivitiesQuery->where('month_year', $recentMonthYear);
        }

        $recentActivities = $recentActivitiesQuery->latest('updated_at')->take(100)->get();

        $isLatePeriod = $this->isLatePeriod();
        $isPastDuePeriod = $this->isPastDuePeriod();
        $dueMembers = $this->dueMembers;
        $memberDepositDetails = $this->memberDepositDetails;
        $memberDepositSummary = $this->memberDepositSummary;

        return view('livewire.deposit.index', compact('deposits', 'months', 'allMembers', 'overallStats', 'recentActivities', 'totalBalance', 'dueMembers', 'isLatePeriod', 'isPastDuePeriod', 'memberDepositDetails', 'memberDepositSummary'));
    }
}