<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Models\Member;
use App\Models\Setting;

use App\Models\Deposit;       // ✅ নতুন যোগ
use App\Models\Loan;          // ✅ নতুন যোগ
use App\Models\Expense;       // ✅ নতুন যোগ
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ActivityLog;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithFileUploads;
    // Add User Modal Properties
    public $addUserModal = false;
    public $selectedMemberId = '';
    public $newUsername = '';
    public $newPassword = '';
    public $newRole = 'user'; // Default 'user'
    public $selectedPermissions = [];

    // Edit User Modal Properties
    public $editUserModal = false;
    public $editUserId = null;
    public $editUsername = '';
    public $editPassword = '';
    public $editRole = '';
    public $editPermissions = [];

    // Module List for Permissions
    public $modules = [
        'dashboard' => 'Dashboard',
        'member_management' => 'Member Management',
        'deposit_management' => 'Deposit Management',
        'loan_management' => 'Loan Management',
        'accounts_management' => 'Accounts Management',
        'expenses_management' => 'Expenses Management',
        'sms_portal' => 'SMS Portal',
    ];

// ===== SMS Gateway Properties =====
    public $sms_api_url = '';
    public $sms_api_key = '';
    public $sms_api_username = ''; 
    public $sms_sender_id = '';
    public $sms_transaction_type = 'T'; 
    public $sms_is_active = false;

    // Test SMS Properties
    public $test_sms_phone = '';

    // ===== ✅ Tab State =====
    public $activeTab = 'organization';

    // ===== ✅ Admin Profile Properties =====
    public $admin_name = '';
    public $admin_photo = null;

    // ===== ✅ Reset Password Properties =====
    public $resetPasswordModal = false;
    public $old_password = '';
    public $new_password = '';
    public $confirm_password = '';

    // ===== ✅ Organization Properties =====
    public $organization_name = '';
    public $organization_logo = null;
    public $organization_logo_shape = 'round';

    // ===== ✅ Date & Time Properties =====
    public $date_format = 'd M, Y';
    public $timezone = 'Asia/Dhaka';
    public $time_format = 'h:i A';

    public function mount()
    {
        // Ensure Super Admin exists and is protected (fallback)
        
        // ✅ Tab query param handle
        if (request()->has('tab') && in_array(request()->tab, ['organization', 'admin_profile', 'user_management', 'sms', 'system_tools'])) {
            $this->activeTab = request()->tab;
        }

        // ✅ SMS Gateway Data Loading
        $this->sms_api_url = Setting::get('sms_api_url', '');
        $this->sms_api_key = Setting::get('sms_api_key', '');
        $this->sms_api_username = Setting::get('sms_api_username', ''); 
        $this->sms_sender_id = Setting::get('sms_sender_id', '');
        $this->sms_transaction_type = Setting::get('sms_transaction_type', 'T'); 
        $this->sms_is_active = Setting::get('sms_is_active', false);

        // ✅ Admin Profile Data Loading
        $this->admin_name = auth()->user()->name;

        // ✅ Organization Data Loading
        $this->organization_name = Setting::get('organization_name', '');
        $this->organization_logo = Setting::get('organization_logo', '');
        $this->organization_logo_shape = Setting::get('organization_logo_shape', 'round');

        // ✅ Date & Time Data Loading
        $this->date_format = Setting::get('date_format', 'd M, Y');
        $this->timezone = Setting::get('timezone', 'Asia/Dhaka');
        $this->time_format = Setting::get('time_format', 'h:i A');
    }

    public function openAddUserModal()
    {
        $this->reset(['selectedMemberId', 'newUsername', 'newPassword', 'newRole', 'selectedPermissions']);
        $this->newRole = 'user';
        $this->addUserModal = true;
    }

    public function closeAddUserModal()
    {
        $this->addUserModal = false;
    }

    // ✅ রোল চেঞ্জ হলে পারমিশন ক্লিয়ার করা
    public function updatedNewRole($value)
    {
        if ($value === 'user' || $value === 'super_admin') {
            $this->selectedPermissions = [];
        }
    }

    // ✅ মেম্বার সিলেক্ট করলে ইউজারনেম ও পাসওয়ার্ড অটো-ফিল
    public function updatedSelectedMemberId($value)
    {
        if ($value) {
            $member = Member::find($value);
            if ($member) {
                $this->newUsername = $member->mobile;
                $this->newPassword = substr($member->mobile, -6);
            }
        }
    }

    public function saveNewUser()
    {
        $this->validate([
            'selectedMemberId' => 'required|exists:members,id',
            'newUsername' => 'required|string|unique:users,username',
            'newPassword' => 'required|min:6',
            'newRole' => 'required|in:super_admin,admin,user',
        ]);

        $member = Member::find($this->selectedMemberId);

        // চেক করা এই মেম্বারের আগেই ইউজার অ্যাকাউন্ট আছে কিনা
        if ($member->user_id) {
            session()->flash('message', '⛔ এই মেম্বারের ইতিমধ্যে একটি ইউজার অ্যাকাউন্ট রয়েছে!');
            return;
        }

        $user = User::create([
            'name' => $member->name_english,
            'username' => $this->newUsername,
            'phone' => $member->mobile,
            'password' => Hash::make($this->newPassword),
            'role' => $this->newRole,
            'permissions' => $this->newRole === 'admin' ? $this->selectedPermissions : null,
        ]);

        // মেম্বারকে ইউজারের সাথে কানেক্ট করা
        $member->update(['user_id' => $user->id]);

        $this->closeAddUserModal();
        session()->flash('message', '✅ নতুন ইউজার সফলভাবে তৈরি হয়েছে!');
    }

    // ===== Edit User Methods =====
    public function openEditUserModal($id)
    {
        $user = User::findOrFail($id);
        $this->editUserId = $id;
        $this->editUsername = $user->username;
        $this->editPassword = '';
        $this->editRole = $user->role;
        $this->editPermissions = $user->permissions ?? [];
        $this->editUserModal = true;
    }

    public function closeEditUserModal()
    {
        $this->editUserModal = false;
    }

    public function updatedEditRole($value)
    {
        if ($value !== 'admin') {
            $this->editPermissions = [];
        }
    }

    public function updateUserInfo()
    {
        $this->validate([
            'editUsername' => 'required|string|unique:users,username,' . $this->editUserId,
            'editRole' => 'required|in:super_admin,admin,user',
        ]);

        $user = User::find($this->editUserId);

        $data = [
            'username' => $this->editUsername,
            'role' => $this->editRole,
            'permissions' => $this->editRole === 'admin' ? $this->editPermissions : null,
        ];

        if ($this->editPassword) {
            $data['password'] = Hash::make($this->editPassword);
        }

        $user->update($data);

        $this->closeEditUserModal();
        session()->flash('message', '✏️ ইউজার ইনফরমেশন আপডেট হয়েছে!');
    }

 // ===== SMS Gateway Settings Methods =====
    public function saveSmsSettings()
    {
        $this->validate([
            'sms_api_url' => 'required|url',
            'sms_api_key' => 'required|string',
            'sms_sender_id' => 'required|string',
        ]);

        Setting::set('sms_api_url', $this->sms_api_url);
        Setting::set('sms_api_key', $this->sms_api_key);
        Setting::set('sms_api_username', $this->sms_api_username); 
        Setting::set('sms_sender_id', $this->sms_sender_id);
        Setting::set('sms_transaction_type', $this->sms_transaction_type); 
        Setting::set('sms_is_active', $this->sms_is_active);

        session()->flash('message', '✅ SMS Gateway settings saved successfully!');
    }

     public function sendTestSms()
    {
        $this->validate([
            'test_sms_phone' => 'required|string|min:11',
        ], [
            'test_sms_phone.required' => 'টেস্ট করার জন্য একটি ফোন নম্বর দিন।',
        ]);

        if (!$this->sms_is_active || !$this->sms_api_url || !$this->sms_api_key) {
            session()->flash('message', '⛔ SMS Gateway সচল নয় অথবা API কনফিগারেশন সম্পূর্ণ নয়!');
            return;
        }

        try {
            $response = Http::post($this->sms_api_url, [
                'UserName' => $this->sms_api_username,
                'Apikey' => $this->sms_api_key,
                'MobileNumber' => $this->test_sms_phone,
                'CampaignId' => 'null',
                'SenderName' => $this->sms_sender_id,
                'TransactionType' => $this->sms_transaction_type,
                'Message' => 'সমিতি ম্যানেজমেন্ট থেকে টেস্ট SMS। আপনার কনফিগারেশন সফল হয়েছে!',
            ]);

            $data = $response->json();
            if ($response->successful() && isset($data['statusCode']) && $data['statusCode'] == "200") {
                session()->flash('message', '✅ টেস্ট SMS সফলভাবে পাঠানো হয়েছে! TrxID: ' . ($data['trxnId'] ?? 'N/A'));
            } else {
                session()->flash('message', '⛔ SMS পাঠাতে ব্যর্থ! API রেসপন্স: ' . ($data['responseResult'] ?? $response->body()));
            }
        } catch (\Exception $e) {
            session()->flash('message', '⛔ API কানেকশন এরর: ' . $e->getMessage());
        }

        $this->test_sms_phone = '';
    }

    // ===== ✅ Admin Name Update Method =====
    public function updateAdminName()
    {
        $this->validate([
            'admin_name' => 'required|string|max:255',
        ], [
            'admin_name.required' => 'নাম দিন।',
        ]);

        auth()->user()->update(['name' => $this->admin_name]);
        session()->flash('profile_message', '✅ নাম সফলভাবে আপডেট হয়েছে!');
    }

    // ===== ✅ Admin Profile Photo Auto Upload =====
    public function updatedAdminPhoto()
    {
        if (!auth()->user()->isSuperAdmin() || !$this->admin_photo) {
            return;
        }

        $this->validate([
            'admin_photo' => 'image|max:2048',
        ]);

        $path = $this->admin_photo->store('admin-photos', 'public');
        auth()->user()->update(['photo' => $path]);
        $this->admin_photo = null;
        session()->flash('profile_message', '✅ প্রোফাইল ফটো আপডেট হয়েছে!');
    }

    // ===== ✅ Organization Logo Auto Upload =====
    public function updatedOrganizationLogo()
    {
        if (!$this->organization_logo) {
            return;
        }

        $this->validate([
            'organization_logo' => 'image|max:2048',
        ]);

        $path = $this->organization_logo->store('organization', 'public');
        Setting::set('organization_logo', $path);
        $this->organization_logo = null;
        session()->flash('org_message', '✅ প্রতিষ্ঠানের লোগো আপডেট হয়েছে!');
    }

    // ===== ✅ Organization Logo Shape Auto Save =====
    public function updatedOrganizationLogoShape()
    {
        Setting::set('organization_logo_shape', $this->organization_logo_shape);
        session()->flash('org_message', '✅ লোগো শেপ আপডেট হয়েছে!');
    }

    // ===== ✅ Admin Profile Photo Method =====
    public function updateAdminPhoto()
    {
        if (!auth()->user()->isSuperAdmin()) {
            return;
        }

        $this->validate([
            'admin_photo' => 'nullable|image|max:2048',
        ], [
            'admin_photo.image' => 'শুধুমাত্র ছবি আপলোড করুন।',
            'admin_photo.max' => 'ছবির সাইজ সর্বোচ্চ 2MB হতে হবে।',
        ]);

        if ($this->admin_photo) {
            $path = $this->admin_photo->store('admin-photos', 'public');
            auth()->user()->update(['photo' => $path]);
            $this->admin_photo = null;
            session()->flash('profile_message', '✅ প্রোফাইল ফটো আপডেট হয়েছে!');
        }
    }

    // ===== ✅ Reset Password Methods =====
    public function openResetPasswordModal()
    {
        $this->reset(['old_password', 'new_password', 'confirm_password']);
        $this->resetPasswordModal = true;
    }

    public function closeResetPasswordModal()
    {
        $this->resetPasswordModal = false;
    }

    public function resetPassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'বর্তমান পাসওয়ার্ড দিন।',
            'new_password.required' => 'নতুন পাসওয়ার্ড দিন।',
            'new_password.min' => 'নতুন পাসওয়ার্ড কমপক্ষে ৬ অক্ষর হতে হবে।',
            'confirm_password.required' => 'নতুন পাসওয়ার্ড নিশ্চিত করুন।',
            'confirm_password.same' => 'দুইটি পাসওয়ার্ড মিলছে না।',
        ]);

        if (!Hash::check($this->old_password, auth()->user()->password)) {
            $this->addError('old_password', 'বর্তমান পাসওয়ার্ড ভুল হয়েছে!');
            return;
        }

        auth()->user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->closeResetPasswordModal();
        session()->flash('profile_message', '✅ পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে!');
    }

    // ===== ✅ Organization Name Save Method =====
    public function saveOrganizationSettings()
    {
        $this->validate([
            'organization_name' => 'required|string|max:255',
        ], [
            'organization_name.required' => 'প্রতিষ্ঠানের নাম দিন।',
        ]);

        Setting::set('organization_name', $this->organization_name);

        session()->flash('org_message', '✅ প্রতিষ্ঠানের নাম সফলভাবে সেভ হয়েছে!');
    }

    // ===== ✅ Date & Time Settings Methods =====
    public function saveDateTimeSettings()
    {
        $this->validate([
            'date_format' => 'required|string',
            'time_format' => 'required|string',
            'timezone' => 'required|string',
        ]);

        Setting::set('date_format', $this->date_format);
        Setting::set('time_format', $this->time_format);
        Setting::set('timezone', $this->timezone);

        session()->flash('message', '✅ Date & Time settings saved successfully!');
    }


    // ===== ✅ Export Data Methods =====
    public function exportMembers()
    {
        $fileName = 'members_list_' . now()->format('Y_m_d_H_i') . '.csv';
        $members = Member::orderBy('account_no')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($members) {
            $file = fopen('php://output', 'w');
            // UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['Account No', 'Name (English)', 'Name (Bangla)', 'Mobile', 'Gender', 'NID', 'Shares', 'Share Amount', 'Registration Date', 'Loan Access']);
            
            foreach ($members as $m) {
                fputcsv($file, [
                    $m->account_no,
                    $m->name_english,
                    $m->name_bangla,
                    $m->mobile,
                    $m->gender,
                    $m->nid,
                    $m->shares,
                    $m->shares * 10000,
                    $m->registration_date,
                    $m->can_apply_loan ? 'Unlocked ✅' : 'Locked 🔒',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportDeposits()
    {
        $fileName = 'deposits_history_' . now()->format('Y_m_d_H_i') . '.csv';
        $deposits = Deposit::with('member')->orderBy('month_year', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($deposits) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['Month', 'Account No', 'Member Name', 'Deposit Amount', 'Due Amount', 'Fine Amount', 'Payment Method', 'Status', 'Paid By']);
            
            foreach ($deposits as $d) {
                fputcsv($file, [
                    $d->month_year,
                    $d->member->account_no ?? 'N/A',
                    $d->member->name_english ?? 'N/A',
                    $d->deposit_amount,
                    $d->due_amount,
                    $d->fine_amount,
                    $d->payment_method,
                    ucfirst($d->status),
                    $d->paid_by_info ?? 'System',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportLoans()
    {
        $fileName = 'loans_data_' . now()->format('Y_m_d_H_i') . '.csv';
        $loans = Loan::with('member')->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($loans) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['Date', 'Account No', 'Member Name', 'Loan Amount', 'Profit', 'Total Payable', 'Repayment Type', 'Status']);
            
            foreach ($loans as $l) {
                fputcsv($file, [
                    $l->created_at->format('d M, Y'),
                    $l->member->account_no ?? 'N/A',
                    $l->member->name_english ?? 'N/A',
                    $l->loan_amount,
                    $l->profit_amount,
                    $l->total_payable,
                    str_replace('_', ' ', ucfirst($l->repayment_type)),
                    ucfirst($l->status),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportAccountStatement()
    {
        $fileName = 'account_statement_' . now()->format('Y_m_d_H_i') . '.csv';
        
        $paymentMethods = ['Cash', 'Bkash', 'Nagad', 'Rocket', 'Bank'];
       

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($paymentMethods) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['Account Name', 'Total Inflow (জমা)', 'Total Outflow (খরচ)', 'Net Balance (ব্যালেন্স)']);
            
            foreach ($paymentMethods as $method) {
                $inflow = Deposit::where('payment_method', $method)->where('status', 'paid')->sum(DB::raw('deposit_amount + due_amount + fine_amount'));
                $outflow = Expense::where('payment_method', $method)->sum('amount');
                
                fputcsv($file, [
                    $method,
                    $inflow,
                    $outflow,
                    $inflow - $outflow,
                ]);
            }


            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        // যে মেম্বারদের ইউজার অ্যাকাউন্ট নেই, শুধু তাদের লিস্ট দেখাবে
        $availableMembers = Member::whereNull('user_id')->orderBy('account_no', 'asc')->get();
        
        $users = User::with('member')->orderBy('id', 'asc')->get();

        // ✅ নতুন যোগ: সর্বশেষ ৫০টি অ্যাক্টিভিটি লগ নিয়ে আসা
        $activityLogs = ActivityLog::with('user')->latest()->take(50)->get();

        return view('livewire.settings.index', compact('availableMembers', 'users', 'activityLogs'));
    }
}