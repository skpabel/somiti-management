<?php

namespace App\Livewire\Member;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithFileUploads;

    public $search = '';
    
    // Modal Properties
    public $viewModal = false;
    public $deleteModal = false;
    public $selectedMember = null;
    public $deleteId = null;

    // Photo Upload
    public $new_photo;

    // Inline Editing Properties
    public $editingField = null;
    public $originalValue = null;
    public $editingValue = null;


    // ✅ Password Change Properties
    public $editingPassword = false;
    public $new_password = '';
    public $currentPasswordDisplay = '';
    public $passwordConfirmModal = false;


    // ✅ Username Change Properties (নতুন যোগ)
    public $editingUsername = false;
    public $new_username = '';
    public $usernameConfirmModal = false;

        // ✅ Add Member Modal Properties
    public $addMemberModal = false;
    public $name_english;
    public $name_bangla;
    public $account_no;
    public $dob;
    public $mobile;
    public $email;
    public $gender = 'Male';
    public $nid;
    public $shares = 1;
    public $photo;
    public $registration_fee = 0.00;
    public $registration_date;
    public $present_address;
    public $permanent_address;
    public $nominee_name;
    public $nominee_relation;
    public $nominee_mobile;
    public $showModal = false; // Review Modal এর জন্য
    public $calculatedAmount = 10000;



    // View Modal ওপেন
    public function viewMember($id)
    {
        $this->selectedMember = Member::findOrFail($id);
        $this->viewModal = true;
        $this->editingField = null;
        $this->originalValue = null;
        $this->new_photo = null;
        $this->editingPassword = false;
        $this->new_password = '';
        $this->passwordConfirmModal = false;
        $this->currentPasswordDisplay = substr($this->selectedMember->mobile, -6);
    }

    // View Modal বন্ধ
    public function closeViewModal()
    {
        $this->viewModal = false;
        $this->selectedMember = null;
        $this->editingField = null;
        $this->originalValue = null;
        $this->new_photo = null;
        $this->editingPassword = false;
        $this->new_password = '';
        $this->passwordConfirmModal = false;
    }

    // ✅ Inline Edit শুরু করা
    public function startEditing($field)
    {
        if ($this->editingField && $this->originalValue !== null) {
            $this->cancelEditing();
        }
        $this->editingField = $field;
        $this->originalValue = $this->selectedMember->$field;
        $this->editingValue = $this->selectedMember->$field; // ✅ ভ্যালু এখানে এসাইন করা হচ্ছে, তাই ফাঁকা হবে না
    }

    // ✅ Inline Edit ক্যান্সেল - আগের ভ্যালু ফিরিয়ে দেওয়া
    public function cancelEditing()
    {
        if ($this->editingField && $this->originalValue !== null) {
            $this->selectedMember->{$this->editingField} = $this->originalValue;
        }
        $this->editingField = null;
        $this->originalValue = null;
        $this->editingValue = null; // ✅ ক্যান্সেল করলে ভ্যালু ক্লিয়ার
    }

    // ✅ একটি ফিল্ড সেভ করা
        public function saveField($field)
        {
            $rules = [
                'account_no' => 'required|integer|unique:members,account_no,' . $this->selectedMember->id,
                'name_english' => 'required|string|max:255',
                'name_bangla' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
                'mobile' => 'required|string|unique:members,mobile,' . $this->selectedMember->id,
                'email' => 'nullable|email|unique:members,email,' . $this->selectedMember->id,
                'gender' => 'required|in:Male,Female,Other',
                'nid' => 'nullable|string|max:255',
                'shares' => 'required|in:0.5,1,2,3,4,5',
                'registration_fee' => 'nullable|numeric',
                'registration_date' => 'required|date',
                'present_address' => 'nullable|string',
                'permanent_address' => 'nullable|string',
                'nominee_name' => 'nullable|string|max:255',
                'nominee_relation' => 'nullable|string|max:255',
                'nominee_mobile' => 'nullable|string|max:255',
            ];

            // ✅ editingValue কে ভ্যালিডেট করা হচ্ছে
            if (isset($rules[$field])) {
                $this->validate([
                    'editingValue' => $rules[$field],
                ]);
            }

            // ✅ এডিট করা ভ্যালুটি Member মডেলে সেট করা হচ্ছে
            $this->selectedMember->$field = $this->editingValue;

            // User-এর তথ্যও আপডেট
            if ($this->selectedMember->user) {
                $user = $this->selectedMember->user;
                
                if ($field === 'mobile') {
                    $user->phone = $this->selectedMember->mobile;
                    // ❌ $user->username = $this->selectedMember->mobile; লাইনটি রিমুভ করা হয়েছে
                }
                
                if ($field === 'name_english') {
                    $user->name = $this->selectedMember->name_english;
                }
                
                $user->save();
            }

            $this->selectedMember->save();
            $this->selectedMember->refresh(); // ✅ সমাধান: Save করার পর ডাটাবেজ থেকে নতুন করে ডাটা নিয়ে আসবে

            $this->editingField = null;
            $this->originalValue = null;
            $this->editingValue = null;

            session()->flash('message', '✅ Updated successfully!');
        }

    // ✅ Photo Upload - refresh() যোগ করা হয়েছে
    public function updatePhoto()
    {
        $this->validate([
            'new_photo' => 'required|image|max:5120',
        ]);

        if ($this->selectedMember->photo) {
            Storage::disk('public')->delete($this->selectedMember->photo);
        }

        $filename = $this->selectedMember->account_no . '.' . $this->new_photo->getClientOriginalExtension();
        $this->selectedMember->photo = $this->new_photo->storeAs('member', $filename, 'public');
        $this->selectedMember->save();

        // ✅ ফটো আপডেটের পর রিফ্রেশ করা
        $this->selectedMember->refresh();
        $this->new_photo = null;
        
        session()->flash('message', '📸 Photo updated!');
    }

    // ============================================
    // ✅ PASSWORD CHANGE METHODS
    // ============================================

    // Password এডিট মোড টগল
    public function startPasswordEdit()
    {
        $this->editingPassword = true;
        $this->new_password = '';
    }

    public function cancelPasswordEdit()
    {
        $this->editingPassword = false;
        $this->new_password = '';
    }

    // ✅ Password Confirm Popup দেখানো
    public function showPasswordConfirm()
    {
        $this->validate([
            'new_password' => 'required|min:6'
        ]);

        $this->passwordConfirmModal = true;
    }

    // ✅ Password Confirm Popup বন্ধ
    public function closePasswordConfirm()
    {
        $this->passwordConfirmModal = false;
    }

    // ✅ Password আসলেই সেভ করা
            public function confirmPasswordChange()
            {
                $this->validate([
                    'new_password' => 'required|min:6'
                ]);

                if($this->selectedMember && $this->selectedMember->user_id) {
                    
                    // ডাটাবেজ থেকে সরাসরি ইউজার খুঁজে বের করা হচ্ছে
                    $user = User::find($this->selectedMember->user_id);
                    
                    if($user) {
                        $user->password = $this->new_password; 
                        $user->save();
                        
                        $this->currentPasswordDisplay = $this->new_password; // এই লাইনটি যুক্ত করুন
                        session()->flash('message', '🔐 Password changed successfully!');
                    }
                }

                $this->editingPassword = false;
                $this->new_password = '';
                $this->passwordConfirmModal = false;
            }


            // ============================================
// ✅ USERNAME CHANGE METHODS (নতুন যোগ)
// ============================================

public function startUsernameEdit()
{
    $this->editingUsername = true;
    $this->new_username = $this->selectedMember->user->username ?? $this->selectedMember->mobile;
}

public function cancelUsernameEdit()
{
    $this->editingUsername = false;
    $this->new_username = '';
}

public function showUsernameConfirm()
{
    $this->validate([
        'new_username' => 'required|string|unique:users,username,' . $this->selectedMember->user_id
    ]);

    $this->usernameConfirmModal = true;
}

public function closeUsernameConfirm()
{
    $this->usernameConfirmModal = false;
}

public function confirmUsernameChange()
{
    $this->validate([
        'new_username' => 'required|string|unique:users,username,' . $this->selectedMember->user_id
    ]);

    if($this->selectedMember && $this->selectedMember->user_id) {
        $user = User::find($this->selectedMember->user_id);
        
        if($user) {
            $user->username = $this->new_username; 
            $user->save();
            
            $this->selectedMember->refresh(); // রিফ্রেশ করে নতুন ইউজারনেম দেখাবে
            session()->flash('message', '👤 Username changed successfully!');
        }
    }

    $this->editingUsername = false;
    $this->new_username = '';
    $this->usernameConfirmModal = false;
}


    // ============================================
    // ✅ LOAN ACCESS TOGGLE METHODS
    // ============================================

    public function toggleLoanAccess()
    {
        if(!$this->selectedMember) return;

        $this->selectedMember->can_apply_loan = !$this->selectedMember->can_apply_loan;
        $this->selectedMember->save();
        $this->selectedMember->refresh(); 

        $status = $this->selectedMember->can_apply_loan ? 'Unlocked ✅' : 'Locked 🔒';
        session()->flash('message', "Loan access has been {$status} for this member!");
    }


    // ============================================
    // DELETE METHODS
    // ============================================

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

    public function deleteMember()
    {
        $member = Member::find($this->deleteId);

        if ($member) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            if($member->user) {
                $member->user->delete();
            }
            $member->delete();
            session()->flash('message', '🗑️ Member deleted.');
        }

        $this->closeDeleteModal();
        $this->closeViewModal();
    }



        // ✅ Add Member Modal ওপেন
    public function openAddMemberModal()
    {
        $this->reset(['name_english', 'name_bangla', 'account_no', 'dob', 'mobile', 'email', 'gender', 'nid', 'shares', 'photo', 'registration_fee', 'registration_date', 'present_address', 'permanent_address', 'nominee_name', 'nominee_relation', 'nominee_mobile']);
        
        // ✅ অটো-জেনারেট অ্যাকাউন্ট নম্বর লজিক
        $lastMember = Member::orderBy('id', 'desc')->first();
        $this->account_no = $lastMember ? $lastMember->account_no + 1 : 1;

        $this->registration_date = date('Y-m-d');
        $this->shares = 1;
        $this->updatedShares(1);
        $this->addMemberModal = true;
    }

    // Calculate Amount based on Shares
    public function updatedShares($value)
    {
        $this->calculatedAmount = $value * 10000;
    }

    // Validation Rules
    public function rules()
    {
        return [
            'account_no' => 'required|integer|unique:members,account_no',
            'name_english' => 'required|string|max:255',
            'mobile' => 'required|string|unique:members,mobile',
            'email' => 'nullable|email|unique:members,email',
            'shares' => 'required|in:0.5,1,2,3,4,5',
            'photo' => 'nullable|image|max:5120',
        ];
    }

    // Open Review Modal
    public function review()
    {
        $this->validate();
        $this->calculatedAmount = $this->shares * 10000;
        $this->showModal = true;
    }

    // Close Review Modal
    public function closeModal()
    {
        $this->showModal = false;
    }

    // Actual Save Method
    public function confirmSave()
    {
        $username = $this->mobile;
        $password = substr($this->mobile, -6);

        $user = User::create([
            'name' => $this->name_english,
            'username' => $username,
            'phone' => $this->mobile,
            'password' => Hash::make($password),
        ]);

        $photoPath = null;
        if ($this->photo) {
            $filename = $this->account_no . '.' . $this->photo->getClientOriginalExtension();
            $photoPath = $this->photo->storeAs('member', $filename, 'public');
        }

        Member::create([
            'account_no' => $this->account_no,
            'name_english' => $this->name_english,
            'name_bangla' => $this->name_bangla,
            'dob' => $this->dob,
            'mobile' => $this->mobile,
            'gender' => $this->gender,
            'nid' => $this->nid,
            'shares' => $this->shares,
            'photo' => $photoPath,
            'registration_fee' => $this->registration_fee,
            'registration_date' => $this->registration_date,
            'present_address' => $this->present_address,
            'permanent_address' => $this->permanent_address,
            'nominee_name' => $this->nominee_name,
            'nominee_relation' => $this->nominee_relation,
            'nominee_mobile' => $this->nominee_mobile,
            'user_id' => $user->id,
        ]);

        session()->flash('message', 'Member registered successfully! Username: ' . $username . ' & Password: ' . $password);
        
        $this->showModal = false;
        $this->addMemberModal = false; // ✅ সেভ হলে পপআপ ক্লোজ হবে
    }


    
        public function render()
    {
        $members = Member::where('name_english', 'like', '%' . $this->search . '%')
            ->orWhere('mobile', 'like', '%' . $this->search . '%')
            ->orWhere('account_no', 'like', '%' . $this->search . '%')
            ->orderByRaw('CAST(account_no AS UNSIGNED) ASC') // ✅ স্ট্রিংকে ইন্টিজারে কনভার্ট করে সর্ট করা হচ্ছে
            ->get();

        return view('livewire.member.index', compact('members'));
    }
}