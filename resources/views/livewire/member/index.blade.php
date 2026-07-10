<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- ===== Gradient Header ===== -->
    <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-6 sm:p-8 rounded-t-2xl shadow-lg text-white">
        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Member List</h1>
                    <p class="text-sm text-blue-100 mt-1">সকল নিবন্ধিত সদস্যদের তালিকা</p>
                </div>
            </div>
            <button wire:click="openAddMemberModal" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add Member
            </button>
        </div>
    </div>

    <!-- ===== Body Section (Search & Cards) ===== -->
    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">
        
         <!-- Search Box -->
        <div class="mb-6">
            <input type="text" wire:model.live="search" placeholder="🔍 Search by Name, Mobile or Account No..." class="input input-bordered w-full max-w-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-base-200" />
        </div>

        <!-- ✅ Responsive Member List (Deposit Style) -->
        <div class="bg-base-100 rounded-xl shadow-sm border border-base-300 overflow-hidden">
            
            <!-- ===== DESKTOP VIEW (Deposit Style Flex Row) ===== -->
            <div class="hidden md:block p-4 space-y-3">
                @forelse ($members as $member)
                <div class="bg-base-100 border border-base-300 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer group" wire:click="viewMember({{ $member->id }})">
                    <div class="flex items-center gap-4">
                        <!-- Left: Photo, Name, Share -->
                        <div class="flex items-center gap-3 w-72 flex-shrink-0 border-r border-base-200 pr-4">
                            <div class="avatar">
                                <div class="w-12 rounded-full shadow-sm overflow-hidden bg-green-500 flex items-center justify-center">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" class="w-12 h-12 object-cover" />
                                    @else
                                        <span class="text-white text-sm font-bold">{{ strtoupper(substr($member->name_english ?? 'N', 0, 1)) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-base-content leading-tight truncate" title="{{ $member->name_english }}">{{ $member->name_english }}</p>
                                <p class="text-xs text-base-content/50 mt-0.5">#{{ $member->account_no }} <span class="text-base-content/30">|</span> Share: {{ $member->shares }}</p>
                            </div>
                        </div>

                        <!-- Right: Details Grid -->
                        <div class="flex-1 grid grid-cols-4 gap-2 text-center text-xs">
                            <div>
                                <p class="text-[10px] text-base-content/40 uppercase font-bold">Mobile</p>
                                <p class="text-sm font-bold text-base-content/80 mt-0.5">{{ $member->mobile }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/40 uppercase font-bold">Gender</p>
                                <p class="text-sm font-semibold text-base-content/70 mt-0.5">{{ $member->gender }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/40 uppercase font-bold">NID</p>
                                <p class="text-sm font-semibold text-base-content/70 mt-0.5 truncate" title="{{ $member->nid ?? 'N/A' }}">{{ $member->nid ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/40 uppercase font-bold">Reg. Date</p>
                                <p class="text-sm font-bold text-indigo-600 mt-0.5">{{ formatDateTime($member->registration_date) }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-center gap-2 flex-shrink-0 border-l border-base-200 pl-4">
                            <button wire:click.stop="viewMember({{ $member->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 p-0.5" title="View Details">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-10 text-base-content/40 text-sm bg-base-100 rounded-xl border border-base-300">কোনো সদস্য পাওয়া যায়নি।</div>
                @endforelse
            </div>

            <!-- ===== MOBILE VIEW (Deposit Style Gradient Cards) ===== -->
            <div class="md:hidden space-y-4 p-4">
                @forelse ($members as $member)
                <div wire:click="viewMember({{ $member->id }})" class="bg-base-100 rounded-xl shadow-md border border-base-300 overflow-hidden flex flex-col hover:shadow-lg transition-shadow cursor-pointer group">
                    
                    <!-- Card Header (Gradient) -->
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-3 text-white flex justify-between items-center">
                        <div>
                            <span class="font-bold text-lg">#{{ $member->account_no }}</span>
                            <h4 class="font-semibold text-sm leading-tight truncate">{{ $member->name_english }}</h4>
                            @if($member->name_bangla)
                                <p class="text-[10px] text-indigo-100 truncate">{{ $member->name_bangla }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="bg-white/20 px-2 py-1 rounded text-xs font-bold backdrop-blur-sm">{{ $member->shares }} Share</span>
                            <!-- Photo in Header -->
                            <div class="avatar">
                                <div class="w-9 rounded-full shadow-sm overflow-hidden bg-white/20 border-2 border-white/30 flex items-center justify-center">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" class="w-9 h-9 object-cover" />
                                    @else
                                        <span class="text-white text-xs font-bold">{{ strtoupper(substr($member->name_english ?? 'N', 0, 1)) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body (Colored Grid Boxes) -->
                    <div class="p-4 grid grid-cols-3 gap-3 text-center">
                        <div class="bg-green-500/10 rounded-lg p-1.5">
                            <p class="text-[9px] text-base-content/40 uppercase font-bold">Mobile</p>
                            <p class="text-xs font-bold text-green-600 mt-0.5">{{ $member->mobile }}</p>
                        </div>
                        <div class="bg-blue-500/10 rounded-lg p-1.5">
                            <p class="text-[9px] text-base-content/40 uppercase font-bold">Gender</p>
                            <p class="text-xs font-bold text-blue-600 mt-0.5">{{ $member->gender }}</p>
                        </div>
                        <div class="bg-purple-500/10 rounded-lg p-1.5">
                            <p class="text-[9px] text-base-content/40 uppercase font-bold">Reg. Date</p>
                            <p class="text-xs font-bold text-purple-600 mt-0.5">{{ formatDateTime($member->registration_date) }}</p>
                        </div>
                        <div class="bg-orange-500/10 rounded-lg p-1.5 col-span-3">
                            <p class="text-[9px] text-base-content/40 uppercase font-bold">NID</p>
                            <p class="text-xs font-bold text-orange-600 mt-0.5 truncate">{{ $member->nid ?? 'Not Set' }}</p>
                        </div>
                    </div>

                </div>
                @empty
                <div class="col-span-full text-center py-12 text-base-content/40">
                    কোনো সদস্য পাওয়া যায়নি।
                </div>
                @endforelse
            </div>

        </div>
    <!-- ===== View / Edit Member Details Modal ===== -->
    @if($viewModal && $selectedMember)
        <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4" wire:click="closeViewModal">
            <div class="bg-base-100 rounded-2xl shadow-2xl max-w-2xl w-full p-0 relative max-h-[90vh] overflow-y-auto" wire:click.stop>
                
                <!-- ===== Header: Photo + Account No ===== -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-6 rounded-t-2xl text-white relative">
                    
                    <!-- Close Button -->
                    <button wire:click="closeViewModal" class="absolute top-4 right-4 text-white/70 hover:text-white z-10 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>

                    <div class="flex items-center gap-5">
                        
                        <!-- Photo -->
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white/30 shadow-md bg-green-500 flex items-center justify-center">
                                @if($selectedMember->photo)
                                    <img src="{{ asset('storage/' . $selectedMember->photo) }}" class="w-24 h-24 object-cover" />
                                @else
                                    <span class="text-white text-3xl font-bold">{{ strtoupper($selectedMember->name_english[0]) }}</span>
                                @endif
                            </div>
                            <!-- Photo Upload Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="document.getElementById('photo-upload').click()">
                                <div class="bg-black bg-opacity-50 rounded-full w-24 h-24 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                            </div>
                            <input type="file" id="photo-upload" wire:model="new_photo" class="hidden" />
                        </div>

                        <!-- Name & Account No -->
                        <div>
                            <div class="inline-block border-2 border-white/40 text-white bg-white/10 font-bold text-sm px-3 py-0.5 rounded-lg mb-2 backdrop-blur-sm">
                                Acc No: {{ $selectedMember->account_no }}
                            </div>
                            <h2 class="text-2xl font-bold text-white">{{ $selectedMember->name_english }}</h2>
                            @if($selectedMember->name_bangla)
                                <p class="text-sm text-indigo-100">{{ $selectedMember->name_bangla }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Photo Upload Progress -->
                    @if($new_photo)
                        <div class="mt-4 flex items-center gap-3 bg-white/10 p-2 rounded-lg">
                            <img src="{{ $new_photo->temporaryUrl() }}" class="w-12 h-12 rounded-lg object-cover" />
                            <button wire:click="updatePhoto" class="btn btn-sm bg-green-500 hover:bg-green-600 text-white border-none shadow-sm">
                                ✅ Upload Photo
                            </button>
                        </div>
                    @endif
                </div>

                <!-- ===== Body: All Details ===== -->
                <div class="p-6 space-y-0">

                    <!-- 👤 Personal Information -->
                    <h3 class="font-bold text-base-content border-b border-base-300 pb-2 mb-3 text-base">👤 Personal Information</h3>

                    @include('livewire.member.partials.field-row', ['label' => 'Name (English)', 'field' => 'name_english', 'value' => $selectedMember->name_english])
                    @include('livewire.member.partials.field-row', ['label' => 'Name (Bangla)', 'field' => 'name_bangla', 'value' => $selectedMember->name_bangla])
                    @include('livewire.member.partials.field-row', ['label' => 'Date of Birth', 'field' => 'dob', 'value' => $selectedMember->dob, 'type' => 'date'])
                    @include('livewire.member.partials.field-row', ['label' => 'Mobile', 'field' => 'mobile', 'value' => $selectedMember->mobile])
                    @include('livewire.member.partials.field-row', ['label' => 'Email', 'field' => 'email', 'value' => $selectedMember->email])
                    @include('livewire.member.partials.field-row', ['label' => 'Gender', 'field' => 'gender', 'value' => $selectedMember->gender, 'type' => 'select', 'options' => ['Male', 'Female', 'Other']])
                    @include('livewire.member.partials.field-row', ['label' => 'NID', 'field' => 'nid', 'value' => $selectedMember->nid])

                    <!-- 💳 Share Details -->
                    <h3 class="font-bold text-base-content border-b border-base-300 pb-2 mb-3 mt-5 text-base">💳 Share Details</h3>

                    @include('livewire.member.partials.field-row', ['label' => 'Shares', 'field' => 'shares', 'value' => $selectedMember->shares, 'type' => 'select', 'options' => ['0.5', '1', '2', '3', '4', '5']])
                    
                    <!-- Share Amount (Read Only) -->
                    <div class="flex items-center py-2.5 border-b border-base-200 px-2">
                        <div class="w-1/3 text-sm text-base-content/50 font-medium">Amount</div>
                        <div class="flex-1 text-sm text-base-content">৳ {{ $selectedMember->shares * 10000 }}</div>
                    </div>
                    
                    @include('livewire.member.partials.field-row', ['label' => 'Registration Fee', 'field' => 'registration_fee', 'value' => $selectedMember->registration_fee, 'type' => 'number'])
                    @include('livewire.member.partials.field-row', ['label' => 'Registration Date', 'field' => 'registration_date', 'value' => $selectedMember->registration_date, 'type' => 'date'])

                    <!-- 🏠 Address -->
                    <h3 class="font-bold text-base-content border-b border-base-300 pb-2 mb-3 mt-5 text-base">🏠 Address</h3>

                    @include('livewire.member.partials.field-row', ['label' => 'Present Address', 'field' => 'present_address', 'value' => $selectedMember->present_address, 'type' => 'textarea'])
                    @include('livewire.member.partials.field-row', ['label' => 'Permanent Address', 'field' => 'permanent_address', 'value' => $selectedMember->permanent_address, 'type' => 'textarea'])

                    <!-- 👪 Nominee -->
                    <h3 class="font-bold text-base-content border-b border-base-300 pb-2 mb-3 mt-5 text-base">👪 Nominee</h3>

                    @include('livewire.member.partials.field-row', ['label' => 'Nominee Name', 'field' => 'nominee_name', 'value' => $selectedMember->nominee_name])
                    @include('livewire.member.partials.field-row', ['label' => 'Relation', 'field' => 'nominee_relation', 'value' => $selectedMember->nominee_relation])
                    @include('livewire.member.partials.field-row', ['label' => 'Nominee Mobile', 'field' => 'nominee_mobile', 'value' => $selectedMember->nominee_mobile])


                     <!-- ✅ Settings Cards Wrapper (Bulletproof Gap Fix) -->
                    <div class="flex flex-col gap-4 mt-4">
                        
                        <!-- ✅ Loan Access Toggle -->
                        <div class="bg-purple-500/10 p-4 rounded-xl border border-purple-500/20">
                            <h3 class="font-bold text-purple-400 mb-3 text-base flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                                Loan Management Access
                            </h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-base-content/70">Allow this member to apply for loans</p>
                                    @if($selectedMember->can_apply_loan)
                                        <p class="text-xs text-green-500 mt-1">✅ Loan access is currently unlocked.</p>
                                    @else
                                        <p class="text-xs text-red-400 mt-1">🔒 Loan access is currently locked.</p>
                                    @endif
                                </div>
                                <button wire:click="toggleLoanAccess" 
                                    wire:confirm="{{ $selectedMember->can_apply_loan ? 'Are you sure you want to lock loan access?' : 'Are you sure you want to unlock loan access?' }}"
                                    class="btn btn-sm {{ $selectedMember->can_apply_loan ? 'btn-error' : 'btn-success' }} text-white border-none shadow-md">
                                    {{ $selectedMember->can_apply_loan ? '🔒 Lock Loan' : '🔓 Unlock Loan' }}
                                </button>
                            </div>
                        </div>

                        <!-- ✅ Login Info (Password & Username Change for Admin) -->
                        @if($selectedMember->user)
                        <div class="bg-indigo-500/10 p-4 rounded-xl border border-indigo-500/20">
                            <h3 class="font-bold text-indigo-400 mb-2 text-base">🔐 Login Information</h3>
                            <div class="text-sm space-y-1.5">
                                
                                <!-- ✅ Username Change Section -->
                                <div class="flex justify-between items-center">
                                    <span class="text-indigo-400">Username:</span>
                                    
                                    @if($editingUsername)
                                        <!-- Edit Mode -->
                                        <div class="flex items-center gap-2 flex-1 ml-4">
                                            <input type="text" wire:model="new_username" class="input input-bordered input-sm flex-1" placeholder="Enter new username" />
                                            <button wire:click="showUsernameConfirm" class="btn btn-success btn-sm btn-circle" title="Save">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            </button>
                                            <button wire:click="cancelUsernameEdit" class="btn btn-ghost btn-sm btn-circle" title="Cancel">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                        @error('new_username') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                    @else
                                        <!-- View Mode -->
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono font-semibold text-base-content">{{ $selectedMember->user->username ?? $selectedMember->mobile }}</span>
                                            <button wire:click="startUsernameEdit" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-500/10" title="Change Username">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <!-- ✅ Password Change Section -->
                                <div class="flex justify-between items-center">
                                    <span class="text-indigo-400">Password:</span>
                                    
                                    @if($editingPassword)
                                        <!-- Edit Mode -->
                                        <div class="flex items-center gap-2 flex-1 ml-4">
                                            <input type="text" wire:model="new_password" class="input input-bordered input-sm flex-1" placeholder="Enter new password" />
                                            <button wire:click="showPasswordConfirm" class="btn btn-success btn-sm btn-circle" title="Save">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            </button>
                                            <button wire:click="cancelPasswordEdit" class="btn btn-ghost btn-sm btn-circle" title="Cancel">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                        @error('new_password') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                    @else
                                        <!-- View Mode -->
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono font-semibold text-base-content">{{ $currentPasswordDisplay }}</span>
                                            <button wire:click="startPasswordEdit" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-500/10" title="Change Password">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <p class="text-xs text-indigo-400/60 mt-2">⚠️ Default password is last 6 digits of mobile</p>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 p-6 border-t border-base-300 rounded-b-2xl">
                    @php 
                        // চেক করা হচ্ছে মেম্বারের কোনো জমা বা লোন আছে কিনা
                        $hasTransactions = ($selectedMember->deposits()->exists() || $selectedMember->loans()->exists()); 
                    @endphp
                    
                    <button wire:click="confirmDelete({{ $selectedMember->id }})" {{ $hasTransactions ? 'disabled' : '' }} class="flex-1 py-2.5 border-2 border-red-500/30 text-red-500 font-bold rounded-xl transition-all text-sm flex items-center justify-center gap-2 {{ $hasTransactions ? 'opacity-40 cursor-not-allowed bg-base-200' : 'hover:bg-red-500 hover:text-white hover:border-red-500' }}" @if($hasTransactions) title="Cannot delete, member has transactions" @endif>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        {{ $hasTransactions ? 'Transaction Exists' : 'Delete Member' }}
                    </button>
                    
                    <button wire:click="closeViewModal" class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all text-sm shadow-md flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        Close
                    </button>
                </div>

            </div>
        </div>
    @endif

    <!-- ===== Delete Confirmation Modal ===== -->
    @if($deleteModal)
        <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[60] p-4" wire:click="closeDeleteModal">
            <div class="bg-base-100 rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center" wire:click.stop>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-500/10 mb-4">
                    <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-base-content mb-2">Delete Member?</h3>
                <p class="text-sm text-base-content/60 mb-6">Are you sure? This cannot be undone.</p>
                <div class="flex gap-4">
                    <button wire:click="closeDeleteModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200">Cancel</button>
                    <button wire:click="deleteMember" class="w-1/2 bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-xl shadow-md">Yes, Delete</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ===== Password Change Warning Modal ===== -->
    @if($passwordConfirmModal)
        <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[70] p-4" wire:click="closePasswordConfirm">
            <div class="bg-base-100 rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center" wire:click.stop>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-500/10 mb-4">
                    <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-base-content mb-2">⚠️ Change Password?</h3>
                <p class="text-sm text-base-content/60 mb-6">Are you sure you want to change this member's password to: <span class="font-mono font-bold text-indigo-400">{{ $new_password }}</span>?</p>
                <div class="flex gap-4">
                    <button wire:click="closePasswordConfirm" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200">Cancel</button>
                    <button wire:click="confirmPasswordChange" class="w-1/2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 rounded-xl shadow-md">Yes, Change</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ===== ✅ Username Change Warning Modal ===== -->
    @if($usernameConfirmModal)
        <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[70] p-4" wire:click="closeUsernameConfirm">
            <div class="bg-base-100 rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center" wire:click.stop>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-500/10 mb-4">
                    <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-base-content mb-2">⚠️ Change Username?</h3>
                <p class="text-sm text-base-content/60 mb-6">Are you sure you want to change this member's username to: <span class="font-mono font-bold text-indigo-400">{{ $new_username }}</span>?</p>
                <div class="flex gap-4">
                    <button wire:click="closeUsernameConfirm" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200">Cancel</button>
                    <button wire:click="confirmUsernameChange" class="w-1/2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 rounded-xl shadow-md">Yes, Change</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ===== Add Member Form Modal ===== -->
    @if($addMemberModal)
        <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-40 p-4" wire:click="$set('addMemberModal', false)">
            <div class="bg-base-100 rounded-2xl shadow-2xl max-w-5xl w-full relative max-h-[90vh] overflow-y-auto" wire:click.stop>
                
                <!-- Close Button -->
                <button wire:click="$set('addMemberModal', false)" class="absolute top-4 right-4 text-base-content/40 hover:text-base-content z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div wire:key="member-form">
                    <!-- ===== Header Section ===== -->
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-6 sm:p-8 rounded-t-2xl shadow-lg text-white">
                        <h1 class="text-2xl sm:text-3xl font-bold flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z" /></svg>
                            Member Registration
                        </h1>
                        <p class="text-indigo-100 mt-2 text-sm sm:text-base">Fill in the personal and nominee details to register a new member.</p>
                    </div>

                    <!-- ===== Form Body Section ===== -->
                    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl border border-t-0 border-base-300">
                        
                        <!-- Info Box -->
                        <div class="bg-indigo-500/10 p-4 rounded-xl mb-8 flex items-start gap-4 text-indigo-400 border border-indigo-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex-shrink-0 mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                            <div>
                                <p class="font-semibold text-sm">User Login Information</p>
                                <p class="text-xs mt-1">A user account will be created automatically using the last 11 digits of the mobile number. The password will be the same as the mobile number.</p>
                            </div>
                        </div>

                        <form wire:submit="review" class="space-y-8">
                            <!-- ===== 👤 Personal Information ===== -->
                            <div>
                                <h3 class="text-lg font-bold text-base-content mb-4 border-b border-base-300 pb-2">👤 Personal Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">Name (English) *</label>
                                        <input type="text" wire:model="name_english" placeholder="Full Name in English" class="input input-bordered w-full @error('name_english') input-error animate-shake @enderror" />
                                        @error('name_english') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">Name (Bangla)</label>
                                        <input type="text" wire:model="name_bangla" placeholder="বাংলায় নাম" class="input input-bordered w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">🔢 Account / Serial No *</label>
                                        <input type="number" wire:model="account_no" placeholder="1" class="input input-bordered w-full @error('account_no') input-error animate-shake @enderror" />
                                        @error('account_no') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">📅 Date of Birth</label>
                                        <input type="date" wire:model="dob" class="input input-bordered w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">📱 Mobile Number *</label>
                                        <input type="text" wire:model="mobile" placeholder="8801712345678" class="input input-bordered w-full @error('mobile') input-error animate-shake @enderror" />
                                        @error('mobile') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">📧 Email Address</label>
                                        <input type="email" wire:model="email" placeholder="example@gmail.com" class="input input-bordered w-full @error('email') input-error animate-shake @enderror" />
                                        @error('email') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">🚻 Gender</label>
                                        <select wire:model="gender" class="select select-bordered w-full">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">🆔 NID Number</label>
                                        <input type="text" wire:model="nid" placeholder="National ID Number" class="input input-bordered w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">📈 Number of Shares *</label>
                                        <select wire:model.live="shares" class="select select-bordered w-full @error('shares') select-error animate-shake @enderror">
                                            <option value="0.5">0.5 Share (৳ 5,000)</option>
                                            <option value="1">1 Share (৳ 10,000)</option>
                                            <option value="2">2 Shares (৳ 20,000)</option>
                                            <option value="3">3 Shares (৳ 30,000)</option>
                                            <option value="4">4 Shares (৳ 40,000)</option>
                                            <option value="5">5 Shares (৳ 50,000)</option>
                                        </select>
                                        @error('shares') 
                                        <span class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                            {{ $message }}
                                        </span> 
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- ===== 💳 Registration Details ===== -->
                            <div>
                                <h3 class="text-lg font-bold text-base-content mb-4 border-b border-base-300 pb-2">💳 Registration Details</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">💵 Registration Fee</label>
                                        <input type="number" step="0.01" wire:model="registration_fee" placeholder="0.00" class="input input-bordered w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">🗓️ Registration Date</label>
                                        <input type="date" wire:model="registration_date" class="input input-bordered w-full" />
                                    </div>
                                </div>
                            </div>

                            <!-- ===== 🏠 Address Information ===== -->
                            <div>
                                <h3 class="text-lg font-bold text-base-content mb-4 border-b border-base-300 pb-2">🏠 Address Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">📍 Present Address</label>
                                        <textarea wire:model="present_address" placeholder="Vill, Post, Thana, Dist" class="textarea textarea-bordered w-full"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">🏡 Permanent Address</label>
                                        <textarea wire:model="permanent_address" placeholder="Same as present" class="textarea textarea-bordered w-full"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== 👪 Nominee Information ===== -->
                            <div>
                                <h3 class="text-lg font-bold text-base-content mb-4 border-b border-base-300 pb-2">👪 Nominee Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">👤 Nominee Name</label>
                                        <input type="text" wire:model="nominee_name" class="input input-bordered w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">🔗 Relation</label>
                                        <input type="text" wire:model="nominee_relation" class="input input-bordered w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">📱 Nominee Mobile</label>
                                        <input type="text" wire:model="nominee_mobile" class="input input-bordered w-full" />
                                    </div>
                                </div>
                            </div>

                            <!-- ===== 🖼️ Upload Photo ===== -->
                            <div>
                                <h3 class="text-lg font-bold text-base-content mb-4 border-b border-base-300 pb-2">🖼️ Upload Photo</h3>
                                <input type="file" wire:model="photo" class="file-input file-input-bordered w-full max-w-xs" />
                                <p class="text-xs text-base-content/50 mt-2">5MB per file • JPG, PNG</p>
                            </div>

                            <!-- ===== Submit Button ===== -->
                            <div class="pt-4">
                                <button type="button" wire:click="review" class="w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all">
                                    Review & Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ===== Review & Confirm Modal (Nested) ===== -->
                @if($showModal)
                    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4" wire:click="closeModal">
                        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-2xl w-full p-8 relative max-h-[90vh] overflow-y-auto" wire:click.stop>
                            <button wire:click="closeModal" class="absolute top-4 right-4 text-base-content/40 hover:text-base-content">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>

                            <h2 class="text-2xl font-bold text-base-content mb-6 text-center">📋 Review Member Details</h2>
                            
                            <div class="space-y-3 text-sm text-base-content/80">
                                
                                <!-- Personal Info -->
                                <h3 class="font-bold text-base-content border-b border-base-300 pb-1">👤 Personal Information</h3>
                                
                                @if($photo)
                                    <div class="flex justify-center my-4">
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Uploaded Photo" class="w-24 h-24 rounded-full object-cover shadow-md">
                                    </div>
                                @endif

                                <div class="grid grid-cols-2 gap-2">
                                    <div><span class="font-semibold">Account No:</span> <span class="text-indigo-400 font-bold">{{ $account_no }}</span></div>
                                    <div><span class="font-semibold">Name (Eng):</span> <span>{{ $name_english }}</span></div>
                                    <div><span class="font-semibold">Name (Ban):</span> <span>{{ $name_bangla ?: 'N/A' }}</span></div>
                                    <div><span class="font-semibold">Mobile:</span> <span>{{ $mobile }}</span></div>
                                    <div><span class="font-semibold">Email:</span> <span>{{ $email ?: 'N/A' }}</span></div>
                                    <div><span class="font-semibold">DOB:</span> <span>{{ $dob ?: 'N/A' }}</span></div>
                                    <div><span class="font-semibold">Gender:</span> <span>{{ $gender }}</span></div>
                                    <div><span class="font-semibold">NID:</span> <span>{{ $nid ?: 'N/A' }}</span></div>
                                </div>

                                <!-- Shares & Registration -->
                                <h3 class="font-bold text-base-content border-b border-base-300 pb-1 mt-4">💳 Registration Details</h3>
                                <div class="grid grid-cols-2 gap-2">
                                    <div><span class="font-semibold">Shares:</span> <span>{{ $shares }}</span></div>
                                    <div><span class="font-semibold">Total Amount:</span> <span class="text-green-500 font-bold">৳ {{ $calculatedAmount }}</span></div>
                                    <div><span class="font-semibold">Reg. Fee:</span> <span>৳ {{ $registration_fee }}</span></div>
                                    <div><span class="font-semibold">Reg. Date:</span> <span>{{ $registration_date }}</span></div>
                                </div>

                                <!-- Address -->
                                <h3 class="font-bold text-base-content border-b border-base-300 pb-1 mt-4">🏠 Address Information</h3>
                                <div class="grid grid-cols-1 gap-2">
                                    <div><span class="font-semibold">Present:</span> <span>{{ $present_address ?: 'N/A' }}</span></div>
                                    <div><span class="font-semibold">Permanent:</span> <span>{{ $permanent_address ?: 'N/A' }}</span></div>
                                </div>

                                <!-- Nominee -->
                                <h3 class="font-bold text-base-content border-b border-base-300 pb-1 mt-4">👪 Nominee Information</h3>
                                <div class="grid grid-cols-3 gap-2">
                                    <div><span class="font-semibold">Name:</span> <span>{{ $nominee_name ?: 'N/A' }}</span></div>
                                    <div><span class="font-semibold">Relation:</span> <span>{{ $nominee_relation ?: 'N/A' }}</span></div>
                                    <div><span class="font-semibold">Mobile:</span> <span>{{ $nominee_mobile ?: 'N/A' }}</span></div>
                                </div>

                                <!-- Login Info -->
                                <div class="bg-indigo-500/10 p-3 rounded-lg mt-4 text-xs text-indigo-400">
                                    <p class="font-bold">🔐 User Login Info (Auto Generated):</p>
                                    <p>Username: <span class="font-mono font-bold">{{ $mobile }}</span></p>
                                    <p>Password: <span class="font-mono font-bold">{{ substr($mobile, -6) }}</span></p>
                                    <p class="mt-1 text-indigo-400/60">Member can change the password later.</p>
                                </div>
                            </div>

                            <div class="flex gap-4 mt-8">
                                <button wire:click="closeModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200">Cancel</button>
                                <button wire:click="confirmSave" class="w-1/2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-xl shadow-md">✅ Confirm Save</button>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endif

</div>