<?php

namespace App\Livewire\Loan;

use App\Models\Loan;
use App\Models\Member;
use App\Models\Deposit;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\ActivityLog;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $existingChequePhoto = null; // ✅ নতুন যোগ
    public $activeLoanTab = 'loans';
    public $loanRepayments = [];
    public $showReplaceInput = false; //
    public $maxLoanCapacity = 0;

    // Pending Loan Edit Properties
    public $editingLoanId = null;
    public $originalLoanData = null;

    // Edit Warning Modal Properties
    public $showEditWarningModal = false;
    public $editChanges = [];

    // Edit History Modal Properties
    public $viewEditHistoryModal = false;
    public $editHistoryData = null;
    public $editHistoryLoanId = null;

    // Percentage & Risk Warning Properties
    public $existingLoanAmount = 0;
    public $existingLoanPercentage = 0;
    public $newLoanPercentage = 0;
    public $totalLoanPercentage = 0;
    public $loanRiskWarning = '';

    public $adminGuarantorWarning = '';

    // Add Modal Properties
    public $addModal = false;
    public $viewModal = false;

    // Form Properties
    public $selectedMemberId = '';
    public $loanAmount = 0;
    public $profitAmount = 0;
    public $totalPayable = 0;
    public $repaymentType = 'monthly';
    public $installmentAmount = 0;
    public $purpose = '';
    public $adminDescription = ''; // ✅ নতুন: Admin এর অতিরিক্ত ডেসক্রিপশন
    public $guarantorType = 'member'; 
    public $securityChequePhoto; 

    // Guarantor Properties
    public $guarantor1Id = '';
    public $guarantor2Id = '';
    public $guarantor1Override = false;
    public $guarantor2Override = false;
    
    // Warning Properties
    public $hasActiveLoanWarning = false;
    public $guarantor1Warning = '';
    public $guarantor2Warning = '';
    
    public $showOver80Warning = false;
    public $reasonForOver80 = '';
    public $memberDueFineWarning = false;
    public $memberLoanUnlocked = true;
    public $shareLimit = 0;
    public $totalDepositAmount = 0;
    public $totalDueAmount = 0;
    public $totalOtherPayAmount = 0;

    // View Loan Properties
    public $viewLoan = null;

    // ✅ Approve Modal Properties (সোর্স রিমুভ করা হয়েছে)
    public $approveLoan = null;
    public $approveModal = false;
    public $approveId = null;

    // ✅ Disburse Modal Properties (সোর্স ও ব্যালেন্স চেক এখানে শিফট করা হয়েছে)
    public $disburseModal = false;
    public $disburseId = null;
    public $disburseMethod = 'Bank';
    public $chequeNumber = '';
    public $transactionId = '';
    public $disburseNote = '';
    public $disbursePhoto; 
    public $currentBalance = 0;
    public $insufficientBalance = false;
    public $disburseRepaymentStartDate;
    public $disburseLoanAmount = 0;

    public function mount()
    {
        // Sub Account রিমুভ করা হয়েছে
        $this->loadRepaymentHistory();
    }

    public function setLoanTab($tab)
    {
        $this->activeLoanTab = $tab;
    }

    public function loadRepaymentHistory()
    {
        $this->loanRepayments = \App\Models\LoanRepayment::with(['loan.member', 'collector'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($repayment) {
                $memberName = $repayment->loan && $repayment->loan->member ? '#' . $repayment->loan->member->account_no . ' ' . $repayment->loan->member->name_english : 'N/A';
                $collectorName = $repayment->collector ? $repayment->collector->name : 'System';
                $details = is_array($repayment->transaction_details) ? $repayment->transaction_details : json_decode($repayment->transaction_details, true);
                $profitAmount = $details['profit'] ?? 0;
                return [
                    'date' => formatDateTime($repayment->created_at),
                    'member' => $memberName,
                    'method' => $repayment->payment_method,
                    'collector' => $collectorName,
                    'profit' => $profitAmount,
                    'amount' => $repayment->amount,
                ];
            })->toArray();
    }

    // ==========================================
    // APPLICATION LOGIC
    // ==========================================
    public function openAddModal()
    {
        $this->reset([
            'selectedMemberId', 'loanAmount', 'profitAmount', 'totalPayable', 'repaymentType', 'installmentAmount', 'purpose', 'adminDescription',
            'showOver80Warning', 'reasonForOver80', 'memberDueFineWarning', 'memberLoanUnlocked', 'shareLimit', 'maxLoanCapacity', 'totalDepositAmount', 'totalDueAmount', 'totalOtherPayAmount',
            'guarantor1Id', 'guarantor2Id', 'guarantor1Override', 'guarantor2Override', 'hasActiveLoanWarning', 'guarantor1Warning', 'guarantor2Warning', 'guarantorType', 'adminGuarantorWarning', 
            'existingLoanAmount', 'existingLoanPercentage', 'newLoanPercentage', 'totalLoanPercentage', 'loanRiskWarning',
            'securityChequePhoto', 'editingLoanId', 'originalLoanData', 'existingChequePhoto', 'showReplaceInput' // ✅ এখানে যোগ করুন
        ]);
        $this->addModal = true;
    }
    public function closeAddModal() { $this->addModal = false; }

    public function updatedSelectedMemberId()
    {
        if (!$this->selectedMemberId) {
            $this->memberLoanUnlocked = true;
            $this->memberDueFineWarning = false;
            $this->shareLimit = 0;
            $this->maxLoanCapacity = 0;
            $this->totalDepositAmount = 0;
            $this->totalDueAmount = 0;
            $this->totalOtherPayAmount = 0;
            $this->hasActiveLoanWarning = false;
            $this->existingLoanAmount = 0; 
            $this->existingLoanPercentage = 0; 
            $this->calculateLoanPercentages(); 
            return;
        }

        $member = Member::find($this->selectedMemberId);
        if ($member) {
            $this->memberLoanUnlocked = $member->can_apply_loan;
            
            // ✅ নতুন লজিক: মেম্বারের মোট ডিপোজিট + বকেয়া + অন্যান্য পেমেন্ট (Fine বাদ)
            $this->totalDepositAmount = Deposit::where('member_id', $member->id)->where('status', 'paid')->sum('deposit_amount');
            $this->totalDueAmount = Deposit::where('member_id', $member->id)->where('status', 'paid')->sum('due_amount');
            $this->totalOtherPayAmount = Deposit::where('member_id', $member->id)->where('status', 'paid')->sum(DB::raw('COALESCE(other_payment, 0)'));
            
            $totalPaidDeposits = $this->totalDepositAmount + $this->totalDueAmount + $this->totalOtherPayAmount;
            
            // ৮০% ক্যাপাসিটি বের করা
            $this->maxLoanCapacity = $totalPaidDeposits * 0.80;
            
            // আগের অ্যাক্টিভ লোন বের করা
            $this->existingLoanAmount = Loan::where('member_id', $member->id)
                ->whereIn('status', ['approved', 'disbursed', 'active'])
                ->sum('loan_amount');

            // ✅ মোট ক্যাপাসিটি থেকে আগের লোন বিয়োগ করে বর্তমান লিমিট বের করা (নেগেটিভ হলে ০ দেখাবে)
            $this->shareLimit = max(0, $this->maxLoanCapacity - $this->existingLoanAmount);

            $this->existingLoanPercentage = $this->maxLoanCapacity > 0 ? round(($this->existingLoanAmount / $this->maxLoanCapacity) * 100, 2) : 0;

            $this->hasActiveLoanWarning = $this->existingLoanAmount > 0;
            
            if ($this->guarantor1Id == $this->selectedMemberId) $this->guarantor1Id = '';
            if ($this->guarantor2Id == $this->selectedMemberId) $this->guarantor2Id = '';

            $this->calculateLoanPercentages();
        }
    }

    public function calculateLoanPercentages()
    {
        $member = Member::find($this->selectedMemberId);
        if (!$member) {
            $this->newLoanPercentage = 0;
            $this->totalLoanPercentage = 0;
            $this->loanRiskWarning = '';
            $this->showOver80Warning = false;
            return;
        }

        $loanAmount = (float) $this->loanAmount;
        $totalPotentialLoan = $this->existingLoanAmount + $loanAmount;
        
        // ✅ নতুন লোনের শতকরা হিসাব (ডিপোজিটের ৮০% এর ওপর ভিত্তি করে)
        $this->newLoanPercentage = $this->maxLoanCapacity > 0 ? round(($loanAmount / $this->maxLoanCapacity) * 100, 2) : 0;
        $this->totalLoanPercentage = $this->maxLoanCapacity > 0 ? round(($totalPotentialLoan / $this->maxLoanCapacity) * 100, 2) : 0;

        // ✅ ৮০% এর বেশি হলেই Reason চাইবে
        $this->showOver80Warning = $this->totalLoanPercentage > 100;
        
        if ($this->totalLoanPercentage >= 100) {
            $this->loanRiskWarning = "🚨 সর্বোচ্চ ঝুঁকি: মেম্বারের লোন সক্ষমতা ১০০% পূরণ হচ্ছে!";
        } elseif ($this->totalLoanPercentage > 80) {
            $this->loanRiskWarning = "⚠️ উচ্চ ঝুঁকি: মেম্বারের মোট লোন সক্ষমতার {$this->totalLoanPercentage}% হয়ে যাচ্ছে!";
        } elseif ($this->totalLoanPercentage > 50) {
            $this->loanRiskWarning = "⚠️ সতর্কতা: মেম্বারের মোট লোন সক্ষমতার {$this->totalLoanPercentage}% হচ্ছে।";
        } elseif ($this->existingLoanAmount > 0) {
            $this->loanRiskWarning = "ℹ️ তথ্য: মেম্বারের আগের লোন {$this->existingLoanPercentage}%। নতুন যোগ করলে মোট হবে {$this->totalLoanPercentage}%।";
        } else {
            $this->loanRiskWarning = '';
        }
    }

    public function calculateTotals()
    {
        // ✅ (float) দিয়ে ক্যাস্ট করা হয়েছে যাতে Empty String + Int এরর না আসে
        $this->totalPayable = (float) $this->loanAmount + (float) $this->profitAmount;
        
        $installments = 1;
        if ($this->repaymentType === 'one_time') {
            $installments = 1;
        } else {
            // ✅ 1_month, 2_months ... 12_months থেকে শুধু নাম্বারটা বের করা
            preg_match('/^(\d+)/', $this->repaymentType, $matches);
            $installments = isset($matches[1]) ? (int) $matches[1] : 1;
        }

        $this->installmentAmount = $this->repaymentType == 'one_time' ? $this->totalPayable : ($this->totalPayable > 0 ? $this->totalPayable / $installments : 0);
    }

    public function updatedLoanAmount() 
    { 
        $this->calculateTotals(); 
        $this->calculateLoanPercentages(); 
    }
    
    public function updatedProfitAmount() { $this->calculateTotals(); }
    public function updatedRepaymentType() { $this->calculateTotals(); }

    public function updatedGuarantor1Id()
    {
        if (!$this->guarantor1Id) { $this->guarantor1Warning = ''; return; }
        if ($this->guarantor1Id == $this->selectedMemberId) {
            $this->guarantor1Id = ''; $this->guarantor1Warning = '⛔ আবেদনকারী নিজে জামিনদার হতে পারবেন না!'; return;
        }
        if ($this->guarantor1Id == $this->guarantor2Id && $this->guarantor2Id) {
            $this->guarantor1Id = ''; $this->guarantor1Warning = '⛔ একই ব্যক্তি দুইবার জামিনদার হতে পারবেন না!'; return;
        }

        $this->guarantor1Warning = '';
        $this->guarantor1Override = false;

        $hasOwnLoan = Loan::where('member_id', $this->guarantor1Id)->whereIn('status', ['approved', 'disbursed', 'active'])->exists();
        $isAlreadyGuarantor = Loan::where(function($q) { $q->where('guarantor_1_id', $this->guarantor1Id)->orWhere('guarantor_2_id', $this->guarantor1Id); })->whereIn('status', ['approved', 'disbursed', 'active'])->exists();

        if ($hasOwnLoan) { $this->guarantor1Warning = '⚠️ এই মেম্বারের নিজের একটি অ্যাক্টিভ লোন রয়েছে!'; } 
        elseif ($isAlreadyGuarantor) { $this->guarantor1Warning = '⚠️ এই মেম্বার ইতিমধ্যে অন্য একটি অ্যাক্টিভ লোনের জামিনদার!'; }
    }

    public function updatedGuarantor2Id()
    {
        if (!$this->guarantor2Id) { $this->guarantor2Warning = ''; return; }
        if ($this->guarantor2Id == $this->selectedMemberId) {
            $this->guarantor2Id = ''; $this->guarantor2Warning = '⛔ আবেদনকারী নিজে জামিনদার হতে পারবেন না!'; return;
        }
        if ($this->guarantor2Id == $this->guarantor1Id && $this->guarantor1Id) {
            $this->guarantor2Id = ''; $this->guarantor2Warning = '⛔ একই ব্যক্তি দুইবার জামিনদার হতে পারবেন না!'; return;
        }

        $this->guarantor2Warning = '';
        $this->guarantor2Override = false;

        $hasOwnLoan = Loan::where('member_id', $this->guarantor2Id)->whereIn('status', ['approved', 'disbursed', 'active'])->exists();
        $isAlreadyGuarantor = Loan::where(function($q) { $q->where('guarantor_1_id', $this->guarantor2Id)->orWhere('guarantor_2_id', $this->guarantor2Id); })->whereIn('status', ['approved', 'disbursed', 'active'])->exists();

        if ($hasOwnLoan) { $this->guarantor2Warning = '⚠️ এই মেম্বারের নিজের একটি অ্যাক্টিভ লোন রয়েছে!'; } 
        elseif ($isAlreadyGuarantor) { $this->guarantor2Warning = '⚠️ এই মেম্বার ইতিমধ্যে অন্য একটি অ্যাক্টিভ লোনের জামিনদার!'; }
    }

    public function updatedGuarantorType()
    {
        if ($this->guarantorType == 'admin') {
            $adminId = auth()->id();
            $guaranteedCount = Loan::where('admin_guarantor_id', $adminId)->whereIn('status', ['approved', 'disbursed', 'active'])->count();
            $this->adminGuarantorWarning = $guaranteedCount > 0 ? "⚠️ সতর্কতা: আপনি ইতিমধ্যে {$guaranteedCount} জনের লোনের জামিনদার!" : '';
        } else {
            $this->adminGuarantorWarning = '';
        }
    }


 
    public function saveLoanApplication()
    {
        $rules = [
            'selectedMemberId' => 'required|exists:members,id',
            'guarantorType' => 'required|in:member,admin',
            'loanAmount' => 'required|numeric|min:1',
            'profitAmount' => 'required|numeric|min:0',
            'repaymentType' => 'required|string',
            'purpose' => 'required|string',
            'adminDescription' => 'nullable|string', // ✅ নতুন ভ্যালিডেশন
            // ✅ ৮০% এর বেশি কিন্তু ১০০% এর কম হলেই শুধু Reason চাইবে
            'reasonForOver80' => ($this->totalLoanPercentage > 80 && $this->totalLoanPercentage < 100) ? 'required|string' : 'nullable',
        ];

        if (!$this->editingLoanId) {
            $rules['securityChequePhoto'] = 'required|image|max:5120';
        } else {
            $rules['securityChequePhoto'] = 'nullable|image|max:5120';
        }

        if ($this->guarantorType == 'member') {
            $rules['guarantor1Id'] = 'required|different:guarantor2Id';
            $rules['guarantor2Id'] = 'required|different:guarantor1Id';
        }

        $this->validate($rules);

        if (!$this->memberLoanUnlocked) {
            session()->flash('message', '⛔ এই মেম্বারের লোন অ্যাক্সেস লক করা আছে!'); return;
        }

        if ($this->guarantorType == 'member') {
            if ($this->guarantor1Warning && !$this->guarantor1Override) {
                session()->flash('message', '⛔ জামিনদার ১ এর সমস্যা সমাধান করুন বা ওভাররাইড করুন!'); return;
            }
            if ($this->guarantor2Warning && !$this->guarantor2Override) {
                session()->flash('message', '⛔ জামিনদার ২ এর সমস্যা সমাধান করুন বা ওভাররাইড করুন!'); return;
            }
        }

        if ($this->editingLoanId) {
            $currentData = [
                'loan_amount' => $this->loanAmount,
                'profit_amount' => $this->profitAmount,
                'repayment_type' => $this->repaymentType,
                'purpose' => $this->purpose,
                'admin_description' => $this->adminDescription,
                'guarantor_type' => $this->guarantorType,
                'guarantor_1_id' => $this->guarantor1Id,
                'guarantor_2_id' => $this->guarantor2Id,
            ];

            if ($this->originalLoanData == $currentData) {
                $this->closeAddModal();
                session()->flash('message', 'ℹ️ No changes detected.'); return;
            }

            $changes = [];
            foreach ($currentData as $key => $value) {
                if (isset($this->originalLoanData[$key]) && $this->originalLoanData[$key] != $value) {
                    $changes[$key] = ['old' => $this->originalLoanData[$key], 'new' => $value];
                }
            }

            if (!empty($changes)) {
                $this->editChanges = $changes;
                $this->showEditWarningModal = true; 
                return;
            }

        } else {
            $securityChequePath = $this->securityChequePhoto->store('loan-cheques', 'public');

            $data = [
                'member_id' => $this->selectedMemberId,
                'guarantor_type' => $this->guarantorType,
                'loan_amount' => $this->loanAmount,
                'profit_amount' => $this->profitAmount,
                'total_payable' => $this->totalPayable,
                'repayment_type' => $this->repaymentType,
                'installment_amount' => $this->installmentAmount,
                'purpose' => $this->purpose,
                'admin_description' => $this->adminDescription, // ✅ সেভ
                'reason_for_over_80' => $this->reasonForOver80,
                'had_due_fine_warning' => $this->memberDueFineWarning,
                'status' => 'pending',
                'applied_by' => Auth::id(),
                'security_cheque' => $securityChequePath,
            ];

            if ($this->guarantorType == 'admin') {
                $data['admin_guarantor_id'] = Auth::id();
                $data['guarantor_1_id'] = null;
                $data['guarantor_2_id'] = null;
                $data['guarantor_1_override'] = false;
                $data['guarantor_2_override'] = false;
            } else {
                $data['admin_guarantor_id'] = null;
                $data['guarantor_1_id'] = $this->guarantor1Id;
                $data['guarantor_2_id'] = $this->guarantor2Id;
                $data['guarantor_1_override'] = $this->guarantor1Override;
                $data['guarantor_2_override'] = $this->guarantor2Override;
            }

            Loan::create($data);
            $this->closeAddModal();
            session()->flash('message', '✅ লোন অ্যাপ্লিকেশন সফলভাবে জমা হয়েছে!');
        }
    }

    public function confirmSaveEditChanges()
    {
        $loan = Loan::find($this->editingLoanId);
        if (!$loan) return;

        $updateData = [
            'member_id' => $this->selectedMemberId,
            'guarantor_type' => $this->guarantorType,
            'loan_amount' => $this->loanAmount,
            'profit_amount' => $this->profitAmount,
            'total_payable' => $this->totalPayable,
            'repayment_type' => $this->repaymentType,
            'installment_amount' => $this->installmentAmount,
            'purpose' => $this->purpose,
            'admin_description' => $this->adminDescription,
            'reason_for_over_80' => $this->reasonForOver80,
        ];

        if ($this->guarantorType == 'admin') {
            $updateData['admin_guarantor_id'] = Auth::id();
            $updateData['guarantor_1_id'] = null;
            $updateData['guarantor_2_id'] = null;
            $updateData['guarantor_1_override'] = false;
            $updateData['guarantor_2_override'] = false;
        } else {
            $updateData['admin_guarantor_id'] = null;
            $updateData['guarantor_1_id'] = $this->guarantor1Id;
            $updateData['guarantor_2_id'] = $this->guarantor2Id;
            $updateData['guarantor_1_override'] = $this->guarantor1Override;
            $updateData['guarantor_2_override'] = $this->guarantor2Override;
        }

        if ($this->securityChequePhoto) {
            $updateData['security_cheque'] = $this->securityChequePhoto->store('loan-cheques', 'public');
        }

        $loan->update($updateData);

        $history = $loan->edit_history ?? [];
        $history[] = [
            'date' => now()->format('j/M/Y, h:i A'),
            'user' => auth()->user()->name,
            'action' => 'Edited Pending Loan',
            'changes' => $this->editChanges
        ];
        $loan->edit_history = $history;
        $loan->save();

        $this->showEditWarningModal = false;
        $this->closeAddModal();
        $this->editingLoanId = null;
        $this->originalLoanData = null;
        $this->editChanges = [];

        session()->flash('message', '✏️ Loan updated successfully! Admin Note: ' . $loan->admin_description);
    }

    public function closeEditWarningModal() { $this->showEditWarningModal = false; }

    // ==========================================
    // ✅ APPROVAL LOGIC (Payment Source সরানো হয়েছে)
    // ==========================================
    public function openApproveModal($id)
    {
        $this->approveId = $id;
        $this->approveLoan = Loan::with(['member', 'guarantor1', 'guarantor2', 'adminGuarantor'])->find($id);
        $this->approveModal = true;
    }

    public function closeApproveModal() 
    { 
        $this->approveModal = false; 
        $this->approveLoan = null;
    }

    public function confirmApprove()
    {
        $loan = Loan::with('member')->find($this->approveId);
        if ($loan) {
            $history = $loan->edit_history ?? [];
            $history[] = [
                'date' => now()->format('j/M/Y, h:i A'),
                'user' => auth()->user()->name,
                'action' => 'Approved',
                'details' => 'Loan approved by admin.',
            ];

            $loan->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
                'edit_history' => $history,
            ]);

            // Create approval notice
            if (class_exists(\App\Models\Notice::class) && $loan->member) {
                $member = $loan->member;
                $amount = number_format($loan->loan_amount, 0);

                \App\Models\Notice::create([
                    'title' => '✅ Loan Application Approved',
                    'message' => "Dear {$member->name_english} (Acc#{$member->account_no}, Share#{$member->shares}) Your loan application for ৳{$amount} has been approved. Awaiting disbursement.",
                    'priority' => 'normal',
                    'target_group' => 'specific',
                    'target_member_ids' => [(string)$member->id],
                    'source' => 'loan_request',
                    'created_by' => auth()->id(),
                ]);
            }

            session()->flash('message', '✅ লোন অ্যাপ্রুভ করা হয়েছে! এখন ডিজবার্স করুন।');
        }
        $this->closeApproveModal();
    }

    public function rejectLoan($id)
    {
        $loan = Loan::with('member')->find($id);
        if ($loan) {
            $loan->update(['status' => 'rejected']);

            // Create rejection notice
            if (class_exists(\App\Models\Notice::class) && $loan->member) {
                $member = $loan->member;
                $amount = number_format($loan->loan_amount, 0);

                \App\Models\Notice::create([
                    'title' => '⛔ Loan Application Rejected',
                    'message' => "Dear {$member->name_english} (Acc#{$member->account_no}, Share#{$member->shares}) Your loan application for ৳{$amount} has been rejected by admin.",
                    'priority' => 'urgent',
                    'target_group' => 'specific',
                    'target_member_ids' => [(string)$member->id],
                    'source' => 'loan_request',
                    'created_by' => auth()->id(),
                ]);
            }

            session()->flash('message', '🗑️ লোন অ্যাপ্লিকেশন বাতিল করা হয়েছে।');
        }
    }

    // ==========================================
    // ✅ DISBURSEMENT LOGIC (Payment Source ও Balance Check এখানে)
    // ==========================================
    public function openDisburseModal($id)
    {
        $loan = Loan::find($id);
        $this->disburseId = $id;
        $this->disburseMethod = 'Bank'; // ডিফল্ট Bank
        $this->chequeNumber = '';
        $this->transactionId = '';
        $this->disburseNote = '';
        $this->disbursePhoto = null;
        $this->disburseRepaymentStartDate = now()->addMonth()->toDateString(); 
        $this->disburseLoanAmount = $loan->loan_amount;
        
        $this->checkDisburseBalance(); // ✅ ব্যালেন্স চেক করা
        
        $this->disburseModal = true;
    }

    public function closeDisburseModal() { $this->disburseModal = false; }

    public function updatedDisburseMethod() { $this->checkDisburseBalance(); }

    // ✅ টোটাল অ্যাকাউন্ট ব্যালেন্স চেক (Accounts এর মতো একই লজিক)
    public function checkDisburseBalance()
    {
        // ✅ DBBL Balance (Same as Accounts Management)
        $depositInflow = Deposit::where('status', 'paid')->sum(DB::raw('deposit_amount + due_amount + fine_amount + COALESCE(other_payment, 0)'));
        $repaymentInflow = \App\Models\LoanRepayment::sum('amount');
        
        $loanProfitInflow = \App\Models\LoanRepayment::get()->sum(function($r) {
            $details = is_array($r->transaction_details) ? $r->transaction_details : json_decode($r->transaction_details, true);
            return ($details['profit'] ?? 0);
        });
        
        $registrationFeeInflow = \App\Models\Member::sum('registration_fee');
        
        $manualInflow = \App\Models\ActivityLog::where('log_type', 'Manual Inflow')->get()->sum(function($log) {
            $props = is_array($log->properties) ? $log->properties : json_decode($log->properties, true);
            return ($props['amount'] ?? 0);
        });

        $totalInflow = $depositInflow + $repaymentInflow + $loanProfitInflow + $registrationFeeInflow + $manualInflow;

        $totalOutflow = Expense::sum('amount') + Loan::whereIn('status', ['disbursed', 'active', 'repaid'])->sum('loan_amount');

        $this->currentBalance = $totalInflow - $totalOutflow;

        $loan = Loan::find($this->disburseId);
        $this->insufficientBalance = ($loan && $this->currentBalance < $loan->loan_amount);
    }

    public function confirmDisbursement()
    {
        $this->validate([
            'disbursePhoto' => 'nullable|image|max:5120',
        ]);

        $loan = Loan::find($this->disburseId);
        if (!$loan) return;

        if ($this->insufficientBalance && $this->disburseMethod !== 'Mix') {
            session()->flash('message', '⛔ পর্যাপ্ত ব্যালেন্স নেই! লোন ডিজবার্স করা সম্ভব নয়।');
            return;
        }

        $photoPath = null;
        if ($this->disbursePhoto) {
            $photoPath = $this->disbursePhoto->store('loan-documents', 'public');
        }

        $details = [
            'method' => $this->disburseMethod,
            'cheque_number' => $this->chequeNumber,
            'transaction_id' => $this->transactionId,
            'note' => $this->disburseNote,
            'document_path' => $photoPath,
        ];

        $history = $loan->edit_history ?? [];
        $history[] = [
            'date' => now()->format('j/M/Y, h:i A'),
            'user' => auth()->user()->name,
            'action' => 'Disbursed',
            'details' => 'Loan disbursed via ' . $this->disburseMethod . ($this->chequeNumber ? ' (Cheque: '.$this->chequeNumber.')' : '') . ($this->transactionId ? ' (TrxID: '.$this->transactionId.')' : ''),
        ];

        $loan->update([
            'status' => 'disbursed',
            'disbursement_method' => $this->disburseMethod,
            'disbursement_details' => $details,
            'disbursement_date' => now(),
            'repayment_start_date' => $this->disburseRepaymentStartDate,
            'edit_history' => $history,
        ]);

        // ✅ নতুন যোগ: Activity Log for Disbursement
        ActivityLog::create([
            'user_id' => auth()->id(),
            'log_type' => 'Loan Disbursement',
            'action' => 'Disbursed',
            'description' => 'Loan Disbursed to Member Acc: #' . ($loan->member->account_no ?? 'N/A') . ' - Amount: ৳' . number_format($loan->loan_amount, 2),
            'properties' => [
                'loan_id' => $loan->id,
                'member_id' => $loan->member_id,
                'amount' => $loan->loan_amount,
                'method' => $this->disburseMethod,
            ]
        ]);

        // Create disbursement notice
        if (class_exists(\App\Models\Notice::class) && $loan->member) {
            $member = $loan->member;
            $amount = number_format($loan->loan_amount, 0);
            $installment = number_format($loan->installment_amount, 0);

            \App\Models\Notice::create([
                'title' => '💰 Loan Disbursed',
                'message' => "Dear {$member->name_english} (Acc#{$member->account_no}, Share#{$member->shares}) Your loan of ৳{$amount} has been disbursed successfully. Installment: ৳{$installment} per {$loan->repayment_type}.",
                'priority' => 'normal',
                'target_group' => 'specific',
                'target_member_ids' => [(string)$member->id],
                'source' => 'loan_request',
                'created_by' => auth()->id(),
            ]);
        }


        $this->closeDisburseModal();
        session()->flash('message', '💰 লোন সফলভাবে ডিজবার্স করা হয়েছে এবং Accounts Total Balance আপডেট হয়েছে!');
    }

    public function openViewModal($id)
    {
        $this->viewLoan = Loan::with(['member', 'applicant', 'approver', 'guarantor1', 'guarantor2', 'adminGuarantor', 'repayments.collector'])->findOrFail($id);
        $this->viewModal = true;
    }

    public function closeViewModal()
    {
        $this->viewModal = false;
        $this->viewLoan = null;
    }

    // ==========================================
    // ✅ LOAN REPAYMENT LOGIC
    // ==========================================

    public $repaymentModal = false;
    public $repayLoanId = null;
    public $repayMethod = 'Cash';
    public $repayTransactionDetails = '';

    public $repayIsPrincipal = true;
    public $repayIsProfit = false;   
    public $repayPrincipalAmount = 0;
    public $repayProfitAmount = 0;

    public function openRepaymentModal($id)
    {
        $loan = Loan::find($id);
        if (!$loan) return;

        $this->repayLoanId = $id;
        $this->repayIsPrincipal = true;
        $this->repayIsProfit = false;
        $this->repayMethod = 'Cash';
        $this->repayTransactionDetails = '';

        $totalPaidPrincipal = $loan->repayments->sum('amount');
        $totalPaidProfit = $loan->repayments->sum(function($r) {
            $details = is_array($r->transaction_details) ? $r->transaction_details : json_decode($r->transaction_details, true);
            return ($details['profit'] ?? 0);
        });

        $this->repayPrincipalAmount = round(max(0, $loan->loan_amount - $totalPaidPrincipal), 2);
        $this->repayProfitAmount = round(max(0, $loan->profit_amount - $totalPaidProfit), 2);

        $this->repaymentModal = true;
    }
    
    public function closeRepaymentModal() { $this->repaymentModal = false; }

        public function saveRepayment()
        {
            $rules = [ 'repayMethod' => 'required|string' ];
            $principalAmount = 0; // ✅ এখন শুধু মূল টাকা রাখবো

            if ($this->repayIsPrincipal) {
                $rules['repayPrincipalAmount'] = 'required|numeric|min:0';
                $principalAmount += (float) $this->repayPrincipalAmount;
            }
            if ($this->repayIsProfit) {
                $rules['repayProfitAmount'] = 'required|numeric|min:0';
            }

        if (!$this->repayIsPrincipal && !$this->repayIsProfit) {
            session()->flash('message', '⚠️ অনুগ্রহ করে কমপক্ষে একটি অপশন সিলেক্ট করুন!'); return;
        }

        $this->validate($rules);

        $loan = Loan::find($this->repayLoanId);
        if (!$loan) return;

                    $profitAmount = $this->repayIsProfit ? (float) $this->repayProfitAmount : 0;

            $repayment = \App\Models\LoanRepayment::create([
                'loan_id' => $loan->id,
                'amount' => $principalAmount, // ✅ এখন শুধু মূল টাকাই জমা হবে
                'payment_method' => $this->repayMethod,
                'transaction_details' => [
                    'info' => $this->repayTransactionDetails,
                    'principal' => $principalAmount,
                    'profit' => $profitAmount,
                ],
                'paid_by' => Auth::id(),
                'payment_date' => now(),
            ]);

            // ✅ Activity Log
            ActivityLog::create([
                'user_id' => auth()->id(),
                'log_type' => 'Loan Repayment',
                'action' => 'Repaid',
                'description' => 'Loan Repayment from #' . ($loan->member->account_no ?? 'N/A') . ' - Principal: ৳' . number_format($principalAmount, 0) . ', Profit: ৳' . number_format($profitAmount, 0),
                'properties' => [
                    'loan_id' => $loan->id,
                    'repayment_id' => $repayment->id,
                    'member_id' => $loan->member_id,
                    'principal' => $principalAmount,
                    'profit' => $profitAmount,
                    'method' => $this->repayMethod,
                ]
            ]);

        $totalPaid = $loan->repayments()->sum('amount');
        
        if ($totalPaid >= $loan->total_payable) {
            $loan->update(['status' => 'repaid']);
        } elseif ($loan->status == 'disbursed') {
            $loan->update(['status' => 'active']);
        }

        $this->closeRepaymentModal();
        $this->viewLoan = $loan->fresh()->load('repayments.collector');
        session()->flash('message', '✅ কিস্তি সফলভাবে আদায় করা হয়েছে!');
    }

    public function render()
    {
        $loans = Loan::with('member', 'repayments')->orderBy('created_at', 'desc')->paginate(15);
        
        $allMembers = Member::where('can_apply_loan', true)
            ->orderByRaw('CAST(account_no AS UNSIGNED) ASC')
            ->get();

        // Loan Stats Calculation
        $loanStats = (object)[
            'total_applications' => Loan::count(),
            'pending_requests' => Loan::where('status', 'pending')->count(),
            'active_loans' => Loan::whereIn('status', ['disbursed', 'active'])->count(),
            'total_disbursed' => Loan::whereIn('status', ['disbursed', 'active', 'repaid'])->sum('loan_amount'),
            'total_collected' => \App\Models\LoanRepayment::sum('amount'),
            'total_profit' => \App\Models\LoanRepayment::get()->sum(function($r) {
                $details = is_array($r->transaction_details) ? $r->transaction_details : json_decode($r->transaction_details, true);
                return ($details['profit'] ?? 0);
            }),
        ];

        return view('livewire.loan.index', compact('loans', 'allMembers', 'loanStats'));
    }

    public function openEditModal($id)
    {
        $loan = Loan::findOrFail($id);
        
        if ($loan->status !== 'pending') {
            session()->flash('message', '⛔ Only pending loans can be edited!'); return;
        }

        $this->editingLoanId = $id;
        $this->selectedMemberId = $loan->member_id;
        $this->guarantorType = $loan->guarantor_type;
        $this->guarantor1Id = $loan->guarantor_1_id;
        $this->guarantor2Id = $loan->guarantor_2_id;
        $this->guarantor1Override = $loan->guarantor_1_override;
        $this->guarantor2Override = $loan->guarantor_2_override;
        $this->loanAmount = $loan->loan_amount;
        $this->profitAmount = $loan->profit_amount;
        $this->repaymentType = $loan->repayment_type;
        $this->purpose = $loan->purpose;
        $this->adminDescription = $loan->admin_description; // ✅ এডিট ফিল
        $this->reasonForOver80 = $loan->reason_for_over_80;
        $this->existingChequePhoto = $loan->security_cheque; // ✅ নতুন যোগ: আগের ছবি রাখা
        $this->securityChequePhoto = null; // ✅ নতুন যোগ: নতুন আপলোড ইনপুট ফাঁকা রাখা
        $this->showReplaceInput = false;
        $this->originalLoanData = [
            'loan_amount' => $loan->loan_amount,
            'profit_amount' => $loan->profit_amount,
            'repayment_type' => $loan->repayment_type,
            'purpose' => $loan->purpose,
            'admin_description' => $loan->admin_description,
            'guarantor_type' => $loan->guarantor_type,
            'guarantor_1_id' => $loan->guarantor_1_id,
            'guarantor_2_id' => $loan->guarantor_2_id,
        ];
        
        $this->updatedSelectedMemberId();
        $this->calculateTotals();

        $this->addModal = true;
    }

    public function openEditHistoryModal($id)
    {
        $loan = Loan::find($id);
        $this->editHistoryLoanId = $id;
        $this->editHistoryData = $loan->edit_history ?? [];
        $this->viewEditHistoryModal = true;
    }

    public function closeEditHistoryModal()
    {
        $this->viewEditHistoryModal = false;
        $this->editHistoryData = null;
        $this->editHistoryLoanId = null;
    }

}