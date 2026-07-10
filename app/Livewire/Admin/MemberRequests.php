<?php

namespace App\Livewire\Admin;

use App\Models\MemberRequest;
use App\Models\Member;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class MemberRequests extends Component
{
    public $requests;
    public $rejectModal = false;
    public $rejectId = null;
    public $rejectRemark = '';

    // ✅ Add Member Modal Properties
    public $addMemberModal = false;
    public $addReqId = null;
    public $m_name = '';
    public $m_mobile = '';
    public $m_email = '';
    public $m_account_no = '';
    public $m_shares = 1;
    public $m_calculatedAmount = 10000;

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        // Pending সবার আগে, এরপর Approved/Rejected হিস্টরি
        $this->requests = MemberRequest::with('member', 'member.user')
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderByRaw("CASE WHEN status = 'rejected' THEN 0 ELSE 1 END")
            ->latest()
            ->get();
    }

    // ===== Open Add Member Modal =====
    public function openAddMemberModal($id)
    {
        $req = MemberRequest::find($id);
        if ($req && $req->type === 'new_registration') {
            $this->addReqId = $id;
            $this->m_name = $req->data['name'] ?? '';
            $this->m_mobile = $req->data['mobile'] ?? '';
            $this->m_email = $req->data['email'] ?? '';
            
            $lastMember = Member::orderBy('id', 'desc')->first();
            $this->m_account_no = $lastMember ? $lastMember->account_no + 1 : 1;
            $this->m_shares = 1;
            $this->updatedMShares(1);
            
            $this->addMemberModal = true;
        }
    }

    public function closeAddMemberModal()
    {
        $this->addMemberModal = false;
        $this->addReqId = null;
    }

    public function updatedMShares($value)
    {
        $this->m_calculatedAmount = $value * 10000;
    }

    // ===== Save Member From Request =====
    public function saveNewMember()
    {
        $this->validate([
            'm_account_no' => 'required|integer|unique:members,account_no',
            'm_name' => 'required|string|max:255',
            'm_mobile' => 'required|string|unique:members,mobile',
            'm_shares' => 'required|in:0.5,1,2,3,4,5',
        ]);

        // ✅ মোবাইল নম্বর ক্লিন করা (যদি ভুলবশত ০ থাকে)
        $cleanMobile = ltrim($this->m_mobile, '0');
        
        $username = $cleanMobile;
        $password = substr($cleanMobile, -6);

        $user = User::create([
            'name' => $this->m_name,
            'username' => $username,
            'phone' => $cleanMobile,
            'password' => Hash::make($password),
        ]);

        Member::create([
            'account_no' => $this->m_account_no,
            'name_english' => $this->m_name,
            'mobile' => $cleanMobile,
            'email' => $this->m_email,
            'shares' => $this->m_shares,
            'registration_date' => date('Y-m-d'),
            'user_id' => $user->id,
        ]);

        // Request Approve
        if ($this->addReqId) {
            MemberRequest::find($this->addReqId)->update([
                'status' => 'approved',
                'admin_id' => auth()->id(),
            ]);
        }

        // ✅ Send Welcome SMS with Login Details
        $orgName = Setting::get('organization_name', 'Somiti');
        $sms_api_url = Setting::get('sms_api_url');
        $sms_api_key = Setting::get('sms_api_key');
        $sms_sender_id = Setting::get('sms_sender_id');
        
        if ($sms_api_url && $sms_api_key && $sms_sender_id) {
            try {
                $message = "Dear {$this->m_name},\nWelcome to {$orgName}.\nYour Member ID: {$this->m_account_no},\nShare: {$this->m_shares},\nUser: {$username},\nPassword: {$password}";
                
                Http::post($sms_api_url, [
                    'UserName' => Setting::get('sms_api_username'),
                    'Apikey' => $sms_api_key,
                    'MobileNumber' => $this->m_mobile,
                    'CampaignId' => 'null',
                    'SenderName' => $sms_sender_id,
                    'TransactionType' => Setting::get('sms_transaction_type', 'T'),
                    'Message' => $message,
                ]);
            } catch (\Exception $e) {
                // Silent fail for SMS
            }
        }

        $this->closeAddMemberModal();
        $this->loadRequests();
        session()->flash('message', "✅ Member added! Username: $username & Password: $password");
    }

    // ===== Approve Logic =====
    public function approveRequest($id)
    {
        $request = MemberRequest::find($id);
        if (!$request) return;

        // রিকোয়েস্ট টাইপ অনুযায়ী অ্যাকশন নেওয়া
        if ($request->type === 'loan_unlock') {
            $member = Member::find($request->member_id);
            if ($member) {
                $member->can_apply_loan = true;
                $member->save();
            }
        }
        
        // প্রোফাইল এডিট রিকোয়েস্ট হলে শুধু স্ট্যাটাস অ্যাপ্রুভ করা হবে, 
        // মেম্বর পরবর্তী ধাপে এডিট করতে পারবে (ধাপ ৬ এ করবো)
        
        $request->update([
            'status' => 'approved',
            'admin_id' => auth()->id(),
        ]);

        $this->loadRequests();
        session()->flash('message', '✅ Request approved successfully!');
    }

    // ===== Reject Logic =====
    public function openRejectModal($id)
    {
        $this->rejectId = $id;
        $this->rejectRemark = '';
        $this->rejectModal = true;
    }

    public function closeRejectModal()
    {
        $this->rejectModal = false;
        $this->rejectId = null;
        $this->rejectRemark = '';
    }

    public function confirmReject()
    {
        $this->validate([
            'rejectRemark' => 'required|string|min:3',
        ], [
            'rejectRemark.required' => 'দয়া করে রিজেক্ট করার কারণ উল্লেখ করুন।',
        ]);

        $request = MemberRequest::find($this->rejectId);
        if ($request) {
            $request->update([
                'status' => 'rejected',
                'admin_id' => auth()->id(),
                'admin_remark' => $this->rejectRemark,
            ]);

            // ✅ Send Rejection SMS if it's a new registration
            if ($request->type === 'new_registration' && isset($request->data['mobile'])) {
                $mobile = $request->data['mobile'];
                $sms_api_url = Setting::get('sms_api_url');
                $sms_api_key = Setting::get('sms_api_key');
                $sms_sender_id = Setting::get('sms_sender_id');
                
                if ($sms_api_url && $sms_api_key && $sms_sender_id) {
                    try {
                        Http::post($sms_api_url, [
                            'UserName' => Setting::get('sms_api_username'),
                            'Apikey' => $sms_api_key,
                            'MobileNumber' => $mobile,
                            'CampaignId' => 'null',
                            'SenderName' => $sms_sender_id,
                            'TransactionType' => Setting::get('sms_transaction_type', 'T'),
                            'Message' => "Your registration request to ".Setting::get('organization_name', 'Somiti')." has been rejected. Reason: {$this->rejectRemark}",
                        ]);
                    } catch (\Exception $e) {
                        // Silent fail for SMS
                    }
                }
            }
        }

        $this->closeRejectModal();
        $this->loadRequests();
        session()->flash('message', '⛔ Request rejected.');
    }

    public function render()
    {
        return view('livewire.admin.member-requests');
    }
}