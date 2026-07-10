<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-600 px-4 py-3 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Member Requests</h1>
                    <p class="text-sm text-blue-100 mt-1">মেম্বারদের পেন্ডিং রিকোয়েস্ট এখানে দেখা যাবে</p>
                </div>
            </div>
            <div class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                🔔 Total Pending: {{ $requests->count() }}
            </div>
        </div>
    </div>

    <!-- ===== Body Section ===== -->
    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">
        
        @if($requests->count() > 0)
            <!-- ===== DESKTOP VIEW ===== -->
            <div class="hidden md:block overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200 text-base-content/70 text-sm">
                            <th>Date</th>
                            <th>Member</th>
                            <th>Request Type</th>
                            <th>Details / Reason</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $req)
                        <tr class="border-b border-base-200 hover:bg-base-200/50 transition-colors">
                            <td class="text-base-content/80 text-sm">{{ formatDateTime($req->created_at) }}</td>
                            <td class="font-semibold text-base-content">
                                @if($req->type === 'new_registration')
                                    <span class="text-indigo-500">{{ $req->data['name'] ?? 'N/A' }}</span>
                                    <p class="text-[10px] text-base-content/50">{{ $req->data['mobile'] ?? '' }}</p>
                                @else
                                    #{{ $req->member->account_no }} - {{ $req->member->name_english }}
                                @endif
                            </td>
                            <td>
                                @if($req->type === 'loan_unlock')
                                    <span class="badge badge-warning badge-sm text-white">Loan Unlock</span>
                                @elseif($req->type === 'profile_edit')
                                    <span class="badge badge-info badge-sm text-white">Profile Edit</span>
                                @elseif($req->type === 'new_registration')
                                    <span class="badge badge-success badge-sm text-white">New Registration</span>
                                @endif
                            </td>
                            <td class="text-xs text-base-content/60">
                                @if($req->type === 'new_registration')
                                    Email: <span class="font-bold text-indigo-500">{{ $req->data['email'] ?? 'N/A' }}</span>
                                @elseif($req->type === 'profile_edit')
                                    Section: <span class="font-bold text-indigo-500">{{ ucfirst(str_replace('_', ' ', $req->data['section'] ?? 'N/A')) }}</span> <br>
                                    Reason: {{ $req->data['message'] ?? 'N/A' }}
                                @else
                                    Requested to unlock loan access.
                                @endif
                            </td>
                            <td class="text-center">
                                @if($req->status === 'pending')
                                <div class="flex items-center justify-center gap-2">
                                    @if($req->type === 'new_registration')
                                        <button wire:click="openAddMemberModal({{ $req->id }})" class="btn btn-sm bg-indigo-600 hover:bg-indigo-700 text-white border-none shadow-sm">
                                            Add Member
                                        </button>
                                    @else
                                        <button wire:click="approveRequest({{ $req->id }})" wire:confirm="আপনি কি এই রিকোয়েস্টটি অ্যাপ্রুভ করতে চান?" class="btn btn-sm bg-green-600 hover:bg-green-700 text-white border-none shadow-sm">
                                            Approve
                                        </button>
                                    @endif
                                    <button wire:click="openRejectModal({{ $req->id }})" class="btn btn-ghost btn-sm text-red-500 hover:bg-red-500/10">
                                        Reject
                                    </button>
                                </div>
                                @else
                                    <div class="text-center">
                                        @if($req->status === 'approved')
                                            <span class="badge badge-success badge-sm text-white font-bold">✅ Approved</span>
                                        @elseif($req->status === 'rejected')
                                            <span class="badge badge-error badge-sm text-white font-bold">⛔ Rejected</span>
                                        @endif
                                        <p class="text-[10px] text-base-content/40 mt-1">{{ formatDateTime($req->updated_at) }}</p>
                                        @if($req->admin_remark)
                                            <p class="text-[10px] text-base-content/50 mt-0.5">{{-- {{ $req->admin_remark }} --}}</p>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- ===== MOBILE VIEW ===== -->
            <div class="md:hidden space-y-4">
                @foreach($requests as $req)
                <div class="bg-base-100 rounded-xl shadow-md border border-base-300 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-400 to-red-500 p-3 text-white flex justify-between items-center">
                        <div>
                            @if($req->type === 'new_registration')
                                <span class="font-bold text-sm">{{ $req->data['name'] ?? 'N/A' }}</span>
                                <p class="text-[10px] text-orange-100">{{ $req->data['mobile'] ?? 'N/A' }} | {{ formatDateTime($req->created_at) }}</p>
                            @else
                                <span class="font-bold text-sm">#{{ $req->member->account_no }} - {{ $req->member->name_english }}</span>
                                <p class="text-[10px] text-orange-100">{{ formatDateTime($req->created_at) }}</p>
                            @endif
                        </div>
                        @if($req->type === 'loan_unlock')
                            <span class="bg-white/20 px-2 py-1 rounded text-xs font-bold">Loan Unlock</span>
                        @elseif($req->type === 'profile_edit')
                            <span class="bg-white/20 px-2 py-1 rounded text-xs font-bold">Profile Edit</span>
                        @elseif($req->type === 'new_registration')
                            <span class="bg-white/20 px-2 py-1 rounded text-xs font-bold">New Registration</span>
                        @endif
                    </div>
                    <div class="p-4">
                        @if($req->type === 'new_registration')
                            <p class="text-sm text-base-content bg-base-200 p-2 rounded">Email: <span class="font-bold text-indigo-500">{{ $req->data['email'] ?? 'N/A' }}</span></p>
                        @elseif($req->type === 'profile_edit')
                            <p class="text-xs text-base-content/60 mb-1">Section: <span class="font-bold text-indigo-500">{{ ucfirst(str_replace('_', ' ', $req->data['section'] ?? 'N/A')) }}</span></p>
                            <p class="text-sm text-base-content bg-base-200 p-2 rounded">"{{ $req->data['message'] ?? 'N/A' }}"</p>
                        @else
                            <p class="text-sm text-base-content/80">Requested to unlock loan access.</p>
                        @endif
                        
                        @if($req->status === 'pending')
                        <div class="flex gap-2 mt-4">
                            @if($req->type === 'new_registration')
                                <button wire:click="openAddMemberModal({{ $req->id }})" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-lg text-sm shadow-md">➕ Add Member</button>
                            @else
                                <button wire:click="approveRequest({{ $req->id }})" wire:confirm="অ্যাপ্রুভ করতে চান?" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg text-sm shadow-md">✅ Approve</button>
                            @endif
                            <button wire:click="openRejectModal({{ $req->id }})" class="flex-1 border border-red-300 text-red-500 font-bold py-2 rounded-lg text-sm hover:bg-red-50">⛔ Reject</button>
                        </div>
                        @else
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-dashed border-base-300">
                            <div>
                                @if($req->status === 'approved')
                                    <span class="badge badge-success badge-sm text-white font-bold">✅ Approved</span>
                                @elseif($req->status === 'rejected')
                                    <span class="badge badge-error badge-sm text-white font-bold">⛔ Rejected</span>
                                @endif
                            </div>
                            <span class="text-[10px] text-base-content/40">{{ formatDateTime($req->updated_at) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-base-content/40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                কোনো পেন্ডিং রিকোয়েস্ট নেই!
            </div>
        @endif
    </div>

    <!-- ===== Reject Reason Popup Modal ===== -->
    @if($rejectModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[100] p-4" wire:click="closeRejectModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full p-8 relative" wire:click.stop>
            <div class="text-center mb-6">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-3">
                    <svg class="h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Reject Request?</h3>
                <p class="text-xs text-gray-500 mt-1">দয়া করে রিজেক্ট করার কারণ উল্লেখ করুন।</p>
            </div>

            <div class="mb-4">
                <textarea wire:model="rejectRemark" class="textarea textarea-bordered w-full" rows="3" placeholder="Write reason here..."></textarea>
                @error('rejectRemark') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button wire:click="closeRejectModal" class="flex-1 py-2 border border-gray-300 rounded-xl text-gray-600 font-medium hover:bg-gray-50 text-sm">Cancel</button>
                <button wire:click="confirmReject" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-xl shadow-md text-sm">Confirm Reject</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Add Member Modal (For New Registration Requests) ===== -->
    @if($addMemberModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[100] p-4" wire:click="closeAddMemberModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-0 relative max-h-[90vh] overflow-y-auto" wire:click.stop>
            
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-5 rounded-t-2xl text-white flex justify-between items-center">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z" /></svg>
                    Approve & Add Member
                </h2>
                <button wire:click="closeAddMemberModal" class="text-white/70 hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <div class="p-6 space-y-4">
                <div class="bg-indigo-500/10 p-3 rounded-xl text-xs text-indigo-600 border border-indigo-500/20">
                    <p class="font-bold">⚠️ Note:</p>
                    <p>Fill in the required details (Account No & Shares) to create the member account. Username & Password will be created automatically using the mobile number.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-base-content/70 mb-1">Name (English)</label>
                        <input type="text" wire:model="m_name" class="input input-bordered w-full bg-base-200" disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-base-content/70 mb-1">Mobile Number</label>
                        <input type="text" wire:model="m_mobile" class="input input-bordered w-full bg-base-200" disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-base-content/70 mb-1">Email Address</label>
                        <input type="text" wire:model="m_email" class="input input-bordered w-full bg-base-200" disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-base-content/70 mb-1">Account No *</label>
                        <input type="number" wire:model="m_account_no" class="input input-bordered w-full focus:ring-2 focus:ring-indigo-500" />
                        @error('m_account_no') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-base-content/70 mb-1">Number of Shares *</label>
                        <select wire:model.live="m_shares" class="select select-bordered w-full focus:ring-2 focus:ring-indigo-500">
                            <option value="0.5">0.5 Share (৳ 5,000)</option>
                            <option value="1">1 Share (৳ 10,000)</option>
                            <option value="2">2 Shares (৳ 20,000)</option>
                            <option value="3">3 Shares (৳ 30,000)</option>
                            <option value="4">4 Shares (৳ 40,000)</option>
                            <option value="5">5 Shares (৳ 50,000)</option>
                        </select>
                        @error('m_shares') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Share Amount Preview -->
                <div class="bg-base-200 p-3 rounded-lg flex justify-between items-center text-sm">
                    <span class="text-base-content/60">Total Share Amount:</span>
                    <span class="text-indigo-600 font-bold text-lg">৳ {{ $m_calculatedAmount }}</span>
                </div>

                <div class="flex gap-3 pt-2">
                    <button wire:click="closeAddMemberModal" class="flex-1 py-2.5 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200 text-sm">Cancel</button>
                    <button wire:click="saveNewMember" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-xl shadow-md text-sm">Create Member</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>