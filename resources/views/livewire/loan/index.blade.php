<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
             class="fixed top-6 right-6 z-[100] bg-base-100 border border-green-500/30 text-green-600 px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3">
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <!-- ===== Gradient Header ===== -->
    <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-6 sm:p-8 rounded-t-2xl shadow-lg text-white">
        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Loan Management</h1>
                    <p class="text-sm text-blue-100 mt-1">সমিতির সদস্যদের লোন আবেদন ও ব্যবস্থাপনা</p>
                </div>
            </div>
            <button wire:click="openAddModal" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Apply for Loan
            </button>
        </div>
    </div>

    <!-- ===== Body Section ===== -->
    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">
        
        <!-- ✅ Loan Stats Cards -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-base-content/80 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                Loan Overview
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-6 gap-4">
                <div class="bg-gradient-to-br from-blue-500/10 to-blue-500/5 border border-blue-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-blue-600 font-bold uppercase">Applications</p>
                        <p class="text-xl font-extrabold text-blue-700">{{ $loanStats->total_applications }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-amber-500/10 to-amber-500/5 border border-amber-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-amber-100 p-3 rounded-full text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-amber-600 font-bold uppercase">Pending</p>
                        <p class="text-xl font-extrabold text-amber-700">{{ $loanStats->pending_requests }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-500/10 to-green-500/5 border border-green-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-green-600 font-bold uppercase">Active Loans</p>
                        <p class="text-xl font-extrabold text-green-700">{{ $loanStats->active_loans }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-indigo-500/10 to-indigo-500/5 border border-indigo-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-indigo-100 p-3 rounded-full text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-indigo-600 font-bold uppercase">Disbursed</p>
                        <p class="text-xl font-extrabold text-indigo-700">৳{{ number_format($loanStats->total_disbursed, 0) }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-emerald-100 p-3 rounded-full text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-emerald-600 font-bold uppercase">Loan Collected</p>
                        <p class="text-xl font-extrabold text-emerald-700">৳{{ number_format(\App\Models\LoanRepayment::sum('amount'), 0) }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-purple-500/10 to-purple-500/5 border border-purple-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-purple-100 p-3 rounded-full text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-purple-600 font-bold uppercase">Total Profit</p>
                        <p class="text-xl font-extrabold text-purple-700">৳{{ number_format($loanStats->total_profit, 0) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Tabs -->
        <div class="flex gap-2 mb-4 border-b border-base-300 pb-3">
            <button wire:click="setLoanTab('loans')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeLoanTab === 'loans' ? 'bg-indigo-600 text-white shadow-md' : 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border border-indigo-200' }}">
                📋 Loan Applications
            </button>
            <button wire:click="setLoanTab('repayments')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeLoanTab === 'repayments' ? 'bg-emerald-600 text-white shadow-md' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100 border border-emerald-200' }}">
                💰 Repayment History
            </button>
        </div>

        <div class="bg-base-100 rounded-xl shadow-sm border border-base-300 overflow-hidden">
            
            @if($activeLoanTab == 'loans')
            <!-- ===== DESKTOP VIEW ===== -->
            <div class="hidden md:block overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
                <table class="table w-full text-sm">
                    <thead>
                        <tr class="bg-indigo-600 text-white uppercase text-xs">
                            <th class="py-3 px-3 text-center">Active Date</th>
                            <th class="py-3 px-3 text-left">Member</th>
                            <th class="py-3 px-3 text-center">Loan Amount</th>
                            <th class="py-3 px-3 text-center">Loan Paid</th>
                            <th class="py-3 px-3 text-center">Loan Remaining</th>
                            <th class="py-3 px-3 text-center">Total Profit</th>
                            <th class="py-3 px-3 text-center">Status</th>
                            <th class="py-3 px-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loans as $loan)
                        @php $isPending = $loan->status == 'pending'; $isApproved = $loan->status == 'approved'; $isActive = in_array($loan->status, ['disbursed', 'active']); @endphp
                        <tr class="border-b border-base-200 transition-colors {{ $isPending ? 'hover:bg-amber-500/20' : ($isActive ? 'hover:bg-green-500/20' : 'hover:bg-base-200') }}">
                            <td class="py-3 px-3 text-center text-xs text-base-content/60">
                                {{ formatDateTime($loan->created_at) }}
                            </td>
                            <td class="py-3 px-3 text-left">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 border-2 border-white shadow-sm overflow-hidden flex-shrink-0">
                                        @if($loan->member->photo)
                                            <img src="{{ asset('storage/' . $loan->member->photo) }}" class="w-full h-full object-cover" alt="">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-indigo-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-base-content text-sm leading-tight">{{ $loan->member->name_english }}</p>
                                        <p class="text-[10px] text-indigo-500 font-bold">#{{ $loan->member->account_no }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3 text-center font-bold text-base-content">৳{{ number_format($loan->loan_amount, 0) }}</td>
                            <td class="py-3 px-3 text-center font-extrabold text-green-600">৳{{ number_format($loan->repayments->sum('amount'), 0) }}</td>
                            <td class="py-3 px-3 text-center font-bold text-red-500">৳{{ number_format(max(0, ($loan->loan_amount + $loan->profit_amount) - $loan->repayments->sum('amount')), 0) }}</td>
                            <td class="py-3 px-3 text-center font-extrabold text-purple-600">৳{{ number_format($loan->repayments->sum(function($r){ $d = is_array($r->transaction_details) ? $r->transaction_details : json_decode($r->transaction_details, true); return $d['profit'] ?? 0; }), 0) }}</td>
                            <td class="py-3 px-3 text-center">
                                @if($isPending) <span class="badge badge-warning badge-sm text-white font-bold">Pending</span>
                                @elseif($isApproved) <span class="badge badge-info badge-sm text-white font-bold">Approved</span>
                                @elseif($isActive) <span class="badge badge-success badge-sm text-white font-bold">{{ ucfirst($loan->status) }}</span>
                                @elseif($loan->status == 'repaid') <span class="badge badge-ghost badge-sm font-bold">Repaid</span>
                                @elseif($loan->status == 'rejected') <span class="badge badge-error badge-sm text-white font-bold">Rejected</span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button wire:click="openViewModal({{ $loan->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-500/10" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    </button>

                                    @if($loan->edit_history)
                                    <button wire:click="openEditHistoryModal({{ $loan->id }})" class="btn btn-ghost btn-xs text-purple-500 hover:bg-purple-500/10" title="Edit History">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </button>
                                    @endif

                                    @if($isPending)
                                        <button wire:click="openEditModal({{ $loan->id }})" class="btn btn-ghost btn-xs text-indigo-500 hover:bg-indigo-500/10" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                        </button>
                                        <button wire:click="openApproveModal({{ $loan->id }})" class="btn btn-xs bg-green-600 hover:bg-green-700 text-white border-none font-bold text-xs">Approve</button>
                                        <button wire:click="rejectLoan({{ $loan->id }})" wire:confirm="Are you sure to reject?" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-500/10">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    @elseif($isApproved)
                                        <button wire:click="openDisburseModal({{ $loan->id }})" class="btn btn-xs bg-indigo-600 hover:bg-indigo-700 text-white border-none font-bold text-xs">Disburse</button>
                                    @elseif($isActive)
                                        <button wire:click="openRepaymentModal({{ $loan->id }})" class="btn btn-ghost btn-xs text-emerald-500 hover:bg-emerald-500/10" title="Collect Installment">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center py-10 text-base-content/40">কোনো লোনের আবেদন পাওয়া যায়নি।</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @endif

            @if($activeLoanTab == 'loans')
            <!-- ===== MOBILE VIEW ===== -->
            <div class="md:hidden space-y-4 p-4">
                @forelse ($loans as $loan)
                @php $isPending = $loan->status == 'pending'; $isApproved = $loan->status == 'approved'; $isActive = in_array($loan->status, ['disbursed', 'active']); @endphp
                <div class="bg-base-100 rounded-xl shadow-md border {{ $isPending ? 'border-amber-300/50' : ($isActive ? 'border-green-300/50' : 'border-base-300') }} overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-3 text-white flex justify-between items-center">
                        <div>
                            <span class="font-bold text-sm">#{{ $loan->member->account_no }} - {{ $loan->member->name_english }}</span>
                            <p class="text-[10px] text-indigo-200">{{ formatDateTime($loan->created_at) }} | {{ str_replace('_', ' ', ucfirst($loan->repayment_type)) }}</p>
                        </div>
                        @if($isPending) <span class="bg-amber-400 px-2.5 py-1 rounded-lg text-xs font-bold">Pending</span>
                        @elseif($isApproved) <span class="bg-sky-400 px-2.5 py-1 rounded-lg text-xs font-bold">Approved</span>
                        @elseif($isActive) <span class="bg-green-500 px-2.5 py-1 rounded-lg text-xs font-bold">{{ ucfirst($loan->status) }}</span>
                        @elseif($loan->status == 'repaid') <span class="bg-gray-400 px-2.5 py-1 rounded-lg text-xs font-bold">Repaid</span>
                        @elseif($loan->status == 'rejected') <span class="bg-red-500 px-2.5 py-1 rounded-lg text-xs font-bold">Rejected</span>
                        @endif
                    </div>
                    <div class="p-4">
                        @if($loan->purpose)
                        <p class="text-[10px] text-base-content/50 mb-2 bg-base-200/50 px-2 py-1 rounded inline-block">{{ $loan->purpose }}</p>
                        @endif
                        <div class="grid grid-cols-3 gap-2 text-center mb-3">
                            <div class="bg-blue-500/10 rounded-lg p-2">
                                <p class="text-[9px] text-base-content/40 uppercase font-bold">Amount</p>
                                <p class="text-sm font-bold text-blue-600">৳{{ number_format($loan->loan_amount, 0) }}</p>
                            </div>
                            <div class="bg-indigo-500/10 rounded-lg p-2">
                                <p class="text-[9px] text-base-content/40 uppercase font-bold">Payable</p>
                                <p class="text-sm font-extrabold text-indigo-600">৳{{ number_format($loan->total_payable, 0) }}</p>
                            </div>
                            <div class="bg-emerald-500/10 rounded-lg p-2">
                                <p class="text-[9px] text-base-content/40 uppercase font-bold">Per Month</p>
                                <p class="text-sm font-bold text-emerald-600">৳{{ number_format($loan->installment_amount, 0) }}</p>
                            </div>
                        </div>
                        <div class="flex gap-1 items-center justify-end">
                            <button wire:click="openViewModal({{ $loan->id }})" class="btn btn-ghost btn-xs text-blue-500 gap-1 font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                View
                            </button>
                            @if($loan->edit_history)
                            <button wire:click="openEditHistoryModal({{ $loan->id }})" class="btn btn-ghost btn-xs text-purple-500 p-1" title="History">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </button>
                            @endif
                            @if($isPending)
                                <button wire:click="openEditModal({{ $loan->id }})" class="btn btn-ghost btn-xs text-indigo-500 p-1" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                </button>
                                <button wire:click="openApproveModal({{ $loan->id }})" class="btn btn-xs bg-green-600 text-white border-none font-bold text-xs">Approve</button>
                                <button wire:click="rejectLoan({{ $loan->id }})" wire:confirm="Are you sure to reject?" class="btn btn-ghost btn-xs text-red-500 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            @elseif($isApproved)
                                <button wire:click="openDisburseModal({{ $loan->id }})" class="btn btn-xs bg-indigo-600 text-white border-none font-bold text-xs">Disburse</button>
                            @elseif($isActive)
                                <button wire:click="openRepaymentModal({{ $loan->id }})" class="btn btn-xs bg-emerald-600 text-white border-none font-bold text-xs gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                                    Pay
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 text-base-content/40">কোনো লোনের আবেদন পাওয়া যায়নি।</div>
                @endforelse
            </div>
            @endif

            @if($activeLoanTab == 'repayments')
            <!-- ===== REPAYMENT HISTORY DESKTOP VIEW ===== -->
            <div class="hidden md:block overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
                <table class="table w-full text-sm">
                    <thead>
                        <tr class="bg-emerald-600 text-white uppercase text-xs">
                            <th class="py-3 px-3 text-left">Date</th>
                            <th class="py-3 px-3 text-left">Member</th>
                            <th class="py-3 px-3 text-center">Payment Method</th>
                            <th class="py-3 px-3 text-center">Collected By</th>
                            <th class="py-3 px-3 text-right">Profit</th>
                            <th class="py-3 px-3 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loanRepayments as $repayment)
                        <tr class="border-b border-base-200 hover:bg-emerald-500/20 transition-colors">
                            <td class="py-3 px-3 text-base-content/70 text-sm">{{ $repayment['date'] }}</td>
                            <td class="py-3 px-3 font-medium text-base-content text-sm">{{ $repayment['member'] }}</td>
                            <td class="py-3 px-3 text-center">
                                @php $methodBg = ['Cash' => 'bg-emerald-100 text-emerald-700', 'Bkash' => 'bg-pink-100 text-pink-700', 'Nagad' => 'bg-orange-100 text-orange-700', 'Rocket' => 'bg-purple-100 text-purple-700', 'Bank' => 'bg-blue-100 text-blue-700']; @endphp
                                <span class="badge badge-sm {{ $methodBg[$repayment['method']] ?? 'bg-base-200 text-base-content' }} text-[11px] font-bold border-0">{{ $repayment['method'] }}</span>
                            </td>
                            <td class="py-3 px-3 text-center text-base-content/70 text-sm">{{ $repayment['collector'] }}</td>
                            <td class="py-3 px-3 text-right font-bold text-amber-600 text-sm">
                                @if($repayment['profit'] > 0)
                                    ৳{{ number_format($repayment['profit'], 0) }}
                                @else
                                    <span class="text-base-content/20">—</span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-right font-bold text-emerald-600 text-sm">+ ৳{{ number_format($repayment['amount'], 0) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-8 text-base-content/40">No loan repayments found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- ===== REPAYMENT HISTORY MOBILE VIEW ===== -->
            <div class="md:hidden space-y-4 p-4">
                @forelse ($loanRepayments as $repayment)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-sm font-bold text-base-content">{{ $repayment['member'] }}</p>
                            <p class="text-xs text-base-content/50 mt-0.5">{{ $repayment['date'] }}</p>
                        </div>
                        <span class="text-sm font-extrabold text-emerald-600">+ ৳{{ number_format($repayment['amount'], 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs pt-2 border-t border-gray-100 mt-2">
                        <span class="flex items-center gap-1">
                            @php $methodBg = ['Cash' => 'bg-emerald-100 text-emerald-700', 'Bkash' => 'bg-pink-100 text-pink-700', 'Nagad' => 'bg-orange-100 text-orange-700', 'Rocket' => 'bg-purple-100 text-purple-700', 'Bank' => 'bg-blue-100 text-blue-700']; @endphp
                            <span class="badge badge-sm {{ $methodBg[$repayment['method']] ?? 'bg-base-200 text-base-content' }} text-[10px] font-bold border-0">{{ $repayment['method'] }}</span>
                            <span class="text-base-content/40">By: {{ $repayment['collector'] }}</span>
                        </span>
                        @if($repayment['profit'] > 0)
                            <span class="font-bold text-amber-600">Profit: ৳{{ number_format($repayment['profit'], 0) }}</span>
                        @else
                            <span class="text-base-content/20">Profit: —</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-12 text-base-content/40">No loan repayments found.</div>
                @endforelse
            </div>
            @endif

    <!-- ===== Apply Loan Modal (Vibrant & Unique Design) ===== -->
    @if($addModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-start sm:items-center justify-center z-50 p-2 sm:p-4 overflow-y-auto" wire:click="closeAddModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-3xl w-full relative my-4 sm:my-0 max-h-[95vh] overflow-y-auto border border-teal-500/20" wire:click.stop>
            
            <!-- Header (Glassmorphism) -->
            <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-5 rounded-t-2xl text-white flex justify-between items-center">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-10 -mb-10 blur-2xl"></div>
                
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-xl font-extrabold tracking-tight">
                            {{ $editingLoanId ? '✏️ Update Loan' : '🚀 New Loan Application' }}
                        </h2>
                        <p class="text-sm text-blue-100 mt-0.5">Fill in the details below carefully</p>
                    </div>
                </div>
                <button wire:click="closeAddModal" class="relative z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm p-2 rounded-xl border border-white/20 transition-all"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <form wire:submit.prevent="saveLoanApplication" class="p-5 space-y-4">
                
                <!-- Section 1: Member & Status -->
                <div class="bg-base-200 p-4 rounded-xl border border-base-300 space-y-3">
                    <h3 class="text-sm font-bold text-base-content/70 uppercase flex items-center gap-2">
                        <div class="bg-indigo-100 p-1.5 rounded-full text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                        </div>
                        Member Info
                    </h3>
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Select Member *</label>
                        <select wire:model.live="selectedMemberId" class="select select-bordered w-full select-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Select a Member</option>
                            @foreach($allMembers as $m)<option value="{{ $m->id }}" {{ $m->can_apply_loan ? '' : 'disabled' }} >#{{ $m->account_no }} - {{ $m->name_english }} {{ !$m->can_apply_loan ? '🔒' : '' }}</option>@endforeach
                        </select>
                    </div>

                    @if($selectedMemberId)
                        @if(!$memberLoanUnlocked)
                            <div class="bg-red-500/10 border-l-4 border-red-500 text-red-600 dark:text-red-400 p-3 rounded-lg text-sm flex items-center gap-2">⛔ এই মেম্বারের লোন সুবিধা লক করা আছে!</div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @if($memberDueFineWarning) <div class="bg-amber-500/10 border-l-4 border-amber-500 text-amber-600 dark:text-amber-400 p-3 rounded-lg text-xs">⚠️ বকেয়া বা ফাইন রয়েছে!</div> @endif
                                @if($hasActiveLoanWarning) <div class="bg-blue-500/10 border-l-4 border-blue-500 text-blue-600 dark:text-blue-400 p-3 rounded-lg text-xs">ℹ️ অ্যাক্টিভ লোন রয়েছে!</div> @endif
                            </div>
                        @endif
                    @endif
                </div>

                @if($selectedMemberId && $memberLoanUnlocked)
                <!-- Section 2: Guarantor -->
                <div class="bg-base-200 p-4 rounded-xl border border-base-300 space-y-3">
                    <h3 class="text-sm font-bold text-base-content/70 uppercase flex items-center gap-2">
                        <div class="bg-green-100 p-1.5 rounded-full text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        </div>
                        Guarantor Details
                    </h3>
                    
                    <div class="flex gap-3 mb-2">
                        <label class="flex items-center gap-2 cursor-pointer bg-teal-500/10 px-4 py-2 rounded-lg border border-teal-500/20">
                            <input type="radio" wire:model.live="guarantorType" value="member" class="radio radio-primary radio-sm" />
                            <span class="text-sm font-medium">Member</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer bg-blue-500/10 px-4 py-2 rounded-lg border border-blue-500/20">
                            <input type="radio" wire:model.live="guarantorType" value="admin" class="radio radio-primary radio-sm" />
                            <span class="text-sm font-medium">Admin</span>
                        </label>
                    </div>

                    @if($guarantorType == 'member')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Guarantor 1 *</label>
                            <select wire:model.live="guarantor1Id" class="select select-bordered w-full select-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select</option>
                                @foreach($allMembers as $m)<option value="{{ $m->id }}" {{ $m->id == $selectedMemberId ? 'disabled' : '' }}>#{{ $m->account_no }} - {{ $m->name_english }}</option>@endforeach
                            </select>
                            @if($guarantor1Warning)
                                <div class="bg-amber-500/10 text-amber-600 dark:text-amber-400 p-2 rounded-lg text-xs mt-2 flex justify-between items-center">
                                    {{ $guarantor1Warning }}
                                    <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" wire:model.live="guarantor1Override" class="checkbox checkbox-xs checkbox-warning" /> <span class="font-bold">Override</span></label>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Guarantor 2 *</label>
                            <select wire:model.live="guarantor2Id" class="select select-bordered w-full select-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select</option>
                                @foreach($allMembers as $m)<option value="{{ $m->id }}" {{ $m->id == $selectedMemberId ? 'disabled' : '' }}>#{{ $m->account_no }} - {{ $m->name_english }}</option>@endforeach
                            </select>
                            @if($guarantor2Warning)
                                <div class="bg-amber-500/10 text-amber-600 dark:text-amber-400 p-2 rounded-lg text-xs mt-2 flex justify-between items-center">
                                    {{ $guarantor2Warning }}
                                    <label class="flex items-center gap-1 cursor-pointer"><input type="checkbox" wire:model.live="guarantor2Override" class="checkbox checkbox-xs checkbox-warning" /> <span class="font-bold">Override</span></label>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($guarantorType == 'admin')
                    <div class="bg-red-500/15 backdrop-blur-sm border border-red-500/30 p-3 rounded-lg text-sm text-red-800 dark:text-red-400 flex items-center gap-2 font-extrabold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        <span class="font-bold">Admin Guarantor:</span> {{ auth()->user()->name }} (You are taking responsibility)
                    </div>
                    @if($adminGuarantorWarning) 
                        <div class="bg-amber-500/10 border border-amber-500/20 text-amber-700 dark:text-amber-300 p-3 rounded-lg text-xs mt-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                            {{ $adminGuarantorWarning }}
                        </div> 
                    @endif
                    @endif
                </div>

                <!-- Section 3: Loan Calculator (Vibrant Gradient Cards) -->
                <div class="bg-base-200 p-4 rounded-xl border border-base-300 space-y-3">
                    <h3 class="text-sm font-bold text-base-content/70 uppercase flex items-center gap-2">
                        <div class="bg-blue-100 p-1.5 rounded-full text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008H15.75v-.008zm0 2.25h.008v.008H15.75V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z" /></svg>
                        </div>
                        Loan Amount
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Loan Amount (৳) *</label>
                            <input type="number" wire:model.live.debounce.500ms="loanAmount" class="input input-bordered w-full input-sm focus:ring-2 focus:ring-blue-500" />
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-bold mt-1">Limit: ৳{{ number_format($shareLimit, 0) }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Profit (৳) *</label>
                            <input type="number" wire:model.live.debounce.500ms="profitAmount" class="input input-bordered w-full input-sm focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </div>

                    @if($selectedMemberId && $loanAmount > 0)
                    <!-- ✅ Risk Calculator Display (Vibrant Cards) -->
                    <div class="space-y-3">
                        <div class="grid grid-cols-3 gap-3">
                            <!-- Card 1: আগের লোন -->
                            <div class="bg-gradient-to-br from-orange-500/10 to-orange-500/5 border border-orange-500/20 p-3 rounded-xl shadow-sm text-center">
                                <p class="text-xs text-orange-600 font-bold uppercase">আগের লোন</p>
                                <p class="text-xl font-extrabold text-orange-700 mt-1">{{ $existingLoanPercentage }}%</p>
                            </div>
                            <!-- Card 2: নতুন লোন -->
                            <div class="bg-gradient-to-br from-blue-500/10 to-blue-500/5 border border-blue-500/20 p-3 rounded-xl shadow-sm text-center">
                                <p class="text-xs text-blue-600 font-bold uppercase">নতুন লোন</p>
                                <p class="text-xl font-extrabold text-blue-700 mt-1">{{ $newLoanPercentage }}%</p>
                            </div>
                            <!-- Card 3: মোট ঝুঁকি (Dynamic Color) -->
                            <div class="bg-gradient-to-br {{ $totalLoanPercentage > 80 ? 'from-red-500/10 to-red-500/5 border-red-500/20' : 'from-emerald-500/10 to-emerald-500/5 border-emerald-500/20' }} border p-3 rounded-xl shadow-sm text-center">
                                <p class="text-xs {{ $totalLoanPercentage > 80 ? 'text-red-600' : 'text-emerald-600' }} font-bold uppercase">মোট ঝুঁকি</p>
                                <p class="text-xl font-extrabold {{ $totalLoanPercentage > 80 ? 'text-red-700' : 'text-emerald-700' }} mt-1">{{ $totalLoanPercentage }}%</p>
                            </div>
                        </div>
                        @if($loanRiskWarning) 
                        <div class="text-xs text-center py-2.5 rounded-lg font-bold {{ $totalLoanPercentage > 80 ? 'bg-red-500/15 backdrop-blur-sm border border-red-500/30 text-red-800 dark:text-red-400 font-extrabold' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' }}">{{ $loanRiskWarning }}</div> 
                        @endif
                    </div>
                    @endif

                    @if($showOver80Warning)
                    <div>
                        <label class="block text-xs font-bold text-red-500 uppercase mb-1">Reason for over 80% *</label>
                        <textarea wire:model="reasonForOver80" class="textarea textarea-bordered w-full textarea-sm border-red-300 focus:ring-red-500" rows="2"></textarea>
                    </div>
                    @endif
                </div>

                <!-- Section 4: Security & Details -->
                <div class="bg-base-200 p-4 rounded-xl border border-base-300 space-y-3">
                    <h3 class="text-sm font-bold text-base-content/70 uppercase flex items-center gap-2">
                        <div class="bg-orange-100 p-1.5 rounded-full text-orange-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" /></svg>
                        </div>
                        Terms & Details
                    </h3>
                    
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1.5">Security Cheque {{ $editingLoanId ? '' : '*' }}</label>
                        
                        {{-- ✅ এডিট মোডে আগের ছবি থাকলে এবং Replace এ ক্লিক না করলে --}}
                        @if($existingChequePhoto && !$showReplaceInput)
                            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-700 rounded-lg text-white shadow-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-100" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" /></svg>
                                    <div>
                                        <p class="text-sm font-bold text-white">✅ Cheque Uploaded</p>
                                        <a href="{{ asset('storage/' . $existingChequePhoto) }}" target="_blank" class="text-xs text-teal-200 hover:text-white underline">View File</a>
                                    </div>
                                </div>
                                <button type="button" wire:click="$set('showReplaceInput', true)" class="btn btn-sm bg-white text-teal-700 hover:bg-teal-50 border-none font-bold shadow-md">Replace</button>
                            </div>
                        @else
                            {{-- ✅ নতুন ফাইল সিলেক্ট করার ইনপুট --}}
                            <div class="flex items-center gap-3">
                                <input type="file" wire:model="securityChequePhoto" class="file-input file-input-bordered file-input-sm w-full max-w-xs" />
                                
                                @if($securityChequePhoto)
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-medium text-green-600 dark:text-green-400 truncate max-w-[120px]">{{ $securityChequePhoto->getClientOriginalName() }}</span>
                                        <span class="badge badge-success badge-sm text-white">Ready</span>
                                    </div>
                                @endif
                            </div>
                            @error('securityChequePhoto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                            {{-- ✅ এডিট মোডে Replace ক্যানসেল করার অপশন --}}
                            @if($editingLoanId && $existingChequePhoto && $showReplaceInput)
                                <button type="button" wire:click="$set('showReplaceInput', false)" class="text-xs text-gray-500 hover:text-red-500 mt-1 underline">Cancel Replace</button>
                            @endif
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Repayment Type *</label>
                            <select wire:model.live="repaymentType" class="select select-bordered w-full select-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="1_month">1 Month</option>
                                <option value="2_months">2 Months</option>
                                <option value="3_months">3 Months</option>
                                <option value="4_months">4 Months</option>
                                <option value="5_months">5 Months</option>
                                <option value="6_months">6 Months</option>
                                <option value="7_months">7 Months</option>
                                <option value="8_months">8 Months</option>
                                <option value="9_months">9 Months</option>
                                <option value="10_months">10 Months</option>
                                <option value="11_months">11 Months</option>
                                <option value="12_months">12 Months</option>
                                <option value="one_time">One-time</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Purpose *</label>
                            <input type="text" wire:model="purpose" class="input input-bordered w-full input-sm" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase mb-1">Admin Note (Optional)</label>
                        <textarea wire:model="adminDescription" class="textarea textarea-bordered w-full textarea-sm" rows="2" placeholder="বিশেষ কোনো নোট..."></textarea>
                    </div>
                </div>

                <!-- Summary & Action Footer -->
                <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-4 rounded-xl text-white flex flex-col sm:flex-row justify-between items-center gap-4 shadow-lg">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/10 rounded-full -ml-8 -mb-8 blur-2xl"></div>
                    
                    <div class="relative z-10 text-center sm:text-left">
                        <p class="text-sm text-blue-100">Total Payable: <span class="font-bold text-white">৳ {{ number_format($totalPayable, 0) }}</span></p>
                        <p class="text-xs text-blue-200 mt-1">Monthly Installment</p>
                        <p class="text-3xl font-extrabold">৳ {{ number_format($installmentAmount, 0) }}</p>
                    </div>
                    <div class="relative z-10 flex gap-2 w-full sm:w-auto">
                        <button type="button" wire:click="closeAddModal" class="flex-1 sm:flex-none py-2.5 px-4 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl font-medium text-sm border border-white/30 transition-all">Cancel</button>
                        <button type="submit" class="flex-1 sm:flex-none py-2.5 px-6 bg-white hover:bg-base-100 text-blue-700 font-extrabold rounded-xl shadow-md text-sm transition-all">
                            {{ $editingLoanId ? 'Update' : 'Submit' }}
                        </button>
                    </div>
                </div>

                @endif
            </form>
        </div>
    </div>
    @endif

    <!-- ===== Approve Loan Modal (Redesigned) ===== -->
    @if($approveModal && $approveLoan)
    <div class="fixed inset-0 bg-black/60 flex items-start sm:items-center justify-center z-50 p-2 sm:p-4 overflow-y-auto" wire:click="closeApproveModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full relative my-4 sm:my-0 max-h-[90vh] overflow-y-auto" wire:click.stop>
            
            <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-5 rounded-t-2xl text-white flex justify-between items-center sticky top-0 z-10">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-10 -mb-10 blur-2xl"></div>
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                    </div>
                    <h2 class="text-lg font-bold tracking-tight">✅ Approve Loan Request</h2>
                </div>
                <button wire:click="closeApproveModal" class="relative z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm p-2 rounded-xl border border-white/20 transition-all"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <div class="p-6 space-y-4 text-sm">
                
                <!-- 1. Applicant Info with Photo -->
                <div class="bg-base-200 p-4 rounded-xl flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-indigo-100 overflow-hidden border-2 border-white shadow-md flex-shrink-0">
                        @if($approveLoan->member && $approveLoan->member->photo)
                            <img src="{{ asset('storage/' . $approveLoan->member->photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs text-base-content/50">Applicant</p>
                        <p class="font-bold text-base-content text-lg">#{{ $approveLoan->member->account_no }} - {{ $approveLoan->member->name_english }}</p>
                    </div>
                </div>

                @php 
                    $installments = 1;
                    if($approveLoan->repayment_type !== 'one_time') {
                        preg_match('/^(\d+)/', $approveLoan->repayment_type, $matches);
                        $installments = isset($matches[1]) ? (int) $matches[1] : 1;
                    }
                    $monthlyProfit = $installments > 0 ? $approveLoan->profit_amount / $installments : 0;
                @endphp
                <!-- 2. Amount Cards (Soft Gradient) -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Loan Amount Card -->
                    <div class="bg-gradient-to-br from-indigo-500/10 to-indigo-500/5 border border-indigo-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                        <div class="bg-indigo-100 p-3 rounded-full text-indigo-600 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-indigo-600 font-bold uppercase">Loan Amount</p>
                            <p class="text-xl font-extrabold text-indigo-700">৳{{ number_format($approveLoan->loan_amount, 0) }}</p>
                        </div>
                    </div>
                    <!-- Profit Amount Card -->
                    <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                        <div class="bg-emerald-100 p-3 rounded-full text-emerald-600 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>
                        </div>
                        <div>
                            <p class="text-xs text-emerald-600 font-bold uppercase">Profit Amount</p>
                            <p class="text-xl font-extrabold text-emerald-700">৳{{ number_format($approveLoan->profit_amount, 0) }}</p>
                            <p class="text-xs text-emerald-500 mt-0.5">(৳{{ number_format($monthlyProfit, 0) }}/month)</p>
                        </div>
                    </div>
                </div>

                <!-- Loan Details List -->
                <div class="bg-base-200 p-4 rounded-xl space-y-3 text-xs">
                    <!-- 3. Repayment Type -->
                    <div class="flex justify-between items-center pb-2 border-b border-base-300">
                        <span class="text-base-content/50 font-semibold">Repayment Type</span>
                        <span class="font-bold text-base-content badge badge-primary badge-sm text-white">{{ str_replace('_', ' ', ucfirst($approveLoan->repayment_type)) }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-base-300">
                        <span class="text-base-content/50 font-semibold">Total Payable</span>
                        <span class="font-bold text-base-content">৳{{ number_format($approveLoan->total_payable, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-base-content/50 font-semibold">Monthly Installment</span>
                        <span class="font-bold text-green-600 text-base">৳{{ number_format($approveLoan->installment_amount, 0) }}</span>
                    </div>
                </div>

                <!-- 4. Purpose -->
                @if($approveLoan->purpose)
                <div class="bg-base-200 p-4 rounded-xl">
                    <span class="text-base-content/50 block text-xs font-bold mb-1">Purpose (কারণ)</span>
                    <span class="font-medium text-base-content">{{ $approveLoan->purpose }}</span>
                </div>
                @endif

                <!-- 5. Admin Note -->
                @if($approveLoan->admin_description)
                <div class="bg-blue-500/10 border border-blue-500/20 p-3 rounded-lg">
                    <span class="text-blue-600 dark:text-blue-400 font-bold block text-xs mb-1">📝 Admin Note</span>
                    <span class="text-blue-800 dark:text-blue-300 text-sm">{{ $approveLoan->admin_description }}</span>
                </div>
                @endif

                <!-- 6. Guarantor Details -->
                @if($approveLoan->guarantor_type == 'admin' && $approveLoan->adminGuarantor)
                <div class="bg-red-500/15 backdrop-blur-sm border border-red-500/30 p-3 rounded-lg text-sm text-red-800 dark:text-red-400 flex items-center gap-2 font-extrabold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                    <strong>Admin Guarantor:</strong> {{ $approveLoan->adminGuarantor->name }}
                </div>
                @elseif($approveLoan->guarantor_1_id || $approveLoan->guarantor_2_id)
                <div class="bg-purple-500/10 border border-purple-500/20 p-3 rounded-lg text-sm text-purple-700 dark:text-purple-300 space-y-1">
                    <strong class="block mb-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg> 
                        Member Guarantors
                    </strong>
                    @if($approveLoan->guarantor1) <p>1. {{ $approveLoan->guarantor1->name_english }} (#{{ $approveLoan->guarantor1->account_no }}) @if($approveLoan->guarantor_1_override) <span class="badge badge-warning badge-xs text-white">Override</span> @endif</p> @endif
                    @if($approveLoan->guarantor2) <p>2. {{ $approveLoan->guarantor2->name_english }} (#{{ $approveLoan->guarantor2->account_no }}) @if($approveLoan->guarantor_2_override) <span class="badge badge-warning badge-xs text-white">Override</span> @endif</p> @endif
                </div>
                @endif

                <!-- 7. Security Cheque (Vibrant Color, No Replace) -->
                @if($approveLoan->security_cheque)
                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-700 rounded-lg text-white shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-100" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" /></svg>
                        <div>
                            <p class="text-sm font-bold text-white">✅ Cheque Uploaded</p>
                            <a href="{{ asset('storage/' . $approveLoan->security_cheque) }}" target="_blank" class="text-xs text-teal-200 hover:text-white underline">View File</a>
                        </div>
                    </div>
                </div>
                @endif

                <div class="flex gap-3 pt-2">
                    <button wire:click="closeApproveModal" class="flex-1 py-2.5 border border-base-300 rounded-xl text-sm font-medium hover:bg-base-200">Cancel</button>
                    <button wire:click="confirmApprove" class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-2.5 rounded-xl shadow-md text-sm">Yes, Approve</button>
                </div>
            </div>
        </div>
    </div>
    @endif

     <!-- ===== Disburse Fund Modal ===== -->
    @if($disburseModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click="closeDisburseModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-emerald-500/20" wire:click.stop>
            
            <!-- Header (Like Loan Management Page) -->
            <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-5 sm:p-6 rounded-t-2xl text-white flex justify-between items-center shadow-lg">
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
                
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-extrabold tracking-tight">Disburse Loan Fund</h2>
                        <p class="text-xs text-blue-100 mt-0.5">Verify balance before confirming</p>
                    </div>
                </div>
                <button wire:click="closeDisburseModal" class="relative z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm p-2 rounded-xl border border-white/30 transition-all text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form wire:submit.prevent="confirmDisbursement" class="p-5 space-y-4">

                <!-- Payment Method (Radio Cards like Repayment) -->
                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Payment Method</label>
                    <div class="grid grid-cols-3 gap-1.5">
                        <label class="cursor-pointer">
                            <input type="radio" name="disburseMethod" wire:model.live="disburseMethod" value="Cash" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">💵</span>
                                <span class="text-[9px] font-bold text-base-content/60 peer-checked:text-emerald-700">Cash</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="disburseMethod" wire:model.live="disburseMethod" value="Bank" class="peer sr-only" checked />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">🏦</span>
                                <span class="text-[9px] font-bold text-base-content/60">Bank</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="disburseMethod" wire:model.live="disburseMethod" value="Mix" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">🔄</span>
                                <span class="text-[9px] font-bold text-base-content/60">Mix</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Balance Calculation Lines -->
                <div class="bg-base-200/60 border border-base-300 p-4 rounded-xl space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-base-content/60 font-medium flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center text-green-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg></span>
                            Available Balance
                        </span>
                        <span class="text-sm font-bold text-green-600 bg-green-500/10 px-3 py-1 rounded-md">৳ {{ number_format($currentBalance, 0) }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-base-content/60 font-medium flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-red-100 flex items-center justify-center text-red-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" /></svg></span>
                            Loan Amount
                        </span>
                        <span class="text-sm font-bold text-red-500 bg-red-500/10 px-3 py-1 rounded-md">- ৳ {{ number_format($disburseLoanAmount, 0) }}</span>
                    </div>
                    
                    <div class="border-t border-dashed border-base-300 my-1"></div>
                    
                    <div class="flex justify-between items-center bg-gradient-to-r from-indigo-500/5 to-purple-500/5 -mx-2 px-4 py-3 rounded-lg border border-indigo-500/10">
                        <span class="text-xs text-base-content/80 font-bold flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg></span>
                            After Disbursement
                        </span>
                        @php $afterBalance = $currentBalance - $disburseLoanAmount; @endphp
                        <span class="text-base font-extrabold {{ $afterBalance < 0 ? 'text-red-600' : 'text-emerald-600' }}">৳ {{ number_format($afterBalance, 0) }}</span>
                    </div>

                    @if($insufficientBalance)
                        <div class="bg-red-500/10 border border-red-500/20 text-red-600 text-xs font-bold p-2.5 rounded-lg text-center animate-pulse">
                            ⚠️ পর্যাপ্ত ব্যালেন্স নেই!
                        </div>
                    @endif
                </div>

                <!-- Disbursement Details -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider">Disbursement Details</label>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-base-content/40 uppercase mb-1">Repayment Start Date *</label>
                        <input type="date" wire:model="disburseRepaymentStartDate" class="input input-bordered w-full input-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" />
                    </div>

                    @if($disburseMethod == 'Bank')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-base-content/40 uppercase mb-1">Cheque Number *</label>
                                <div class="relative">
                                    <div class="absolute left-3 top-1/2 -translate-y-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                    </div>
                                    <input type="text" wire:model="chequeNumber" class="input input-bordered w-full input-sm pl-9 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="e.g., 123456" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-base-content/40 uppercase mb-1">Cheque Photo</label>
                                <input type="file" wire:model="disbursePhoto" class="file-input file-input-bordered w-full file-input-sm" />
                            </div>
                        </div>
                    @elseif($disburseMethod == 'Cash')
                        <div>
                            <label class="block text-[10px] font-bold text-base-content/40 uppercase mb-1">Description</label>
                            <textarea wire:model="disburseNote" class="textarea textarea-bordered w-full textarea-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" rows="2" placeholder="Cash handover details..."></textarea>
                        </div>
                    @elseif($disburseMethod == 'Mix')
                        <div>
                            <label class="block text-[10px] font-bold text-base-content/40 uppercase mb-1">Mix Payment Note *</label>
                            <textarea wire:model="disburseNote" class="textarea textarea-bordered w-full textarea-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" rows="3" placeholder="e.g., 5000 via Bank, 3000 via Cash..."></textarea>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons (Exact like Repayment) -->
                <div class="flex gap-3 pt-2">
                    <button type="button" wire:click="closeDisburseModal" class="flex-1 py-2.5 border border-base-300 rounded-xl text-sm font-medium hover:bg-base-200 transition-all">Cancel</button>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-2.5 rounded-xl shadow-lg shadow-green-500/30 text-sm transition-all flex items-center justify-center gap-2 {{ $insufficientBalance ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Confirm Disbursement
                    </button>
                </div>

            </form>
        </div>
    </div>
    @endif

     <!-- ===== Edit History Modal (Timeline Design) ===== -->
    @if($viewEditHistoryModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click="closeEditHistoryModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-700/50" wire:click.stop>
            
            <!-- Header (Dark Slate Theme) -->
            <div class="relative overflow-hidden bg-gradient-to-br from-slate-700 via-slate-800 to-slate-900 p-5 text-white flex justify-between items-center">
                <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-cyan-500/20 p-2.5 rounded-xl backdrop-blur-sm border border-cyan-400/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold tracking-tight">Edit Timeline</h2>
                        <p class="text-xs text-slate-400">All modification records</p>
                    </div>
                </div>
                <button wire:click="closeEditHistoryModal" class="relative z-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm p-2 rounded-xl border border-white/10 transition-all"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <div class="p-6 max-h-[70vh] overflow-y-auto bg-base-200/30">
                
                <!-- Timeline Container -->
                <div class="relative ml-4 border-l-2 border-indigo-500/30 space-y-6">
                    
                    @forelse ($editHistoryData as $history)
                    <!-- Timeline Dot -->
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-indigo-500 border-4 border-base-100 shadow-md"></div>
                    
                    <!-- Timeline Card -->
                    <div class="pl-6">
                        <div class="bg-base-100 p-4 rounded-xl shadow-sm border border-base-300/60 hover:shadow-md transition-shadow">
                            <!-- Top Row -->
                            <div class="flex items-center justify-between mb-3 pb-2 border-b border-dashed border-base-300">
                                <span class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm uppercase tracking-wider">{{ $history['action'] ?? 'Updated' }}</span>
                                <span class="text-[11px] font-medium text-base-content/50 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $history['date'] ?? 'N/A' }}
                                </span>
                            </div>
                            
                            <!-- User Info -->
                            <p class="text-xs text-base-content/70 mb-3 flex items-center gap-1.5">
                                <div class="w-4 h-4 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                </div>
                                Modified by: <span class="font-bold text-indigo-600">{{ $history['user'] ?? 'System' }}</span>
                            </p>
                            
                            @if(isset($history['changes']) && is_array($history['changes']))
                                <!-- Changes List -->
                                <div class="space-y-2">
                                    @foreach($history['changes'] as $field => $change)
                                    <div class="bg-base-200/60 p-2.5 rounded-lg border border-base-300/50">
                                        <p class="text-[10px] font-extrabold text-indigo-600 uppercase tracking-wider mb-1.5">{{ $field }}</p>
                                        <div class="flex items-center gap-2 text-xs flex-wrap">
                                            <span class="bg-red-500/10 text-red-600 line-through px-2 py-0.5 rounded-md font-medium">{{ $change['old'] ?? 'N/A' }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-base-content/30 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                            <span class="bg-emerald-500/10 text-emerald-700 font-bold px-2 py-0.5 rounded-md">{{ $change['new'] ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @elseif(isset($history['details']))
                                <div class="bg-slate-800/5 dark:bg-slate-300/10 p-3 rounded-lg text-xs text-base-content/70 border border-base-300/50 italic">
                                    "{{ $history['details'] }}"
                                </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    
                    <!-- Empty State (Dark Theme Match) -->
                    <div class="text-center py-16 pl-6">
                        <div class="w-16 h-16 bg-slate-200 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="font-bold text-base-content/50 text-sm">No History Found</p>
                        <p class="text-xs text-base-content/30 mt-1">This loan hasn't been modified yet.</p>
                    </div>
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Repayment Modal (Redesigned) ===== -->
    @if($repaymentModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click="closeRepaymentModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full overflow-hidden border border-emerald-500/20" wire:click.stop>
            
            <!-- Header (Dark Emerald Theme) -->
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-teal-700 to-slate-800 p-5 text-white flex justify-between items-center">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-400/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-teal-400/10 rounded-full -ml-10 -mb-10 blur-2xl"></div>
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-emerald-400/20 p-2.5 rounded-xl backdrop-blur-sm border border-emerald-300/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold tracking-tight">Collect Installment</h2>
                        <p class="text-xs text-emerald-200">Add repayment details</p>
                    </div>
                </div>
                <button wire:click="closeRepaymentModal" class="relative z-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm p-2 rounded-xl border border-white/10 transition-all"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <div class="p-5 space-y-4">
                
                <!-- Amount Selection Cards -->
                <div class="space-y-3">
                    <!-- Principal Card -->
                    <div class="border {{ $repayIsPrincipal ? 'border-blue-500/50 bg-blue-500/5' : 'border-base-300 bg-base-200/30' }} rounded-xl p-3 transition-all">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <div class="bg-blue-100 p-2 rounded-lg flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" wire:model.live="repayIsPrincipal" class="checkbox checkbox-sm checkbox-primary" />
                                    <span class="text-sm font-bold text-base-content">Repayment (মূল টাকা)</span>
                                </div>
                                <p class="text-[10px] text-base-content/40 ml-6">Loan principal amount</p>
                            </div>
                        </label>
                        @if($repayIsPrincipal)
                        <div class="mt-3 ml-10">
                            <input type="number" wire:model="repayPrincipalAmount" class="input input-bordered input-sm w-full bg-base-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter amount..." />
                        </div>
                        @endif
                    </div>

                    <!-- Profit Card -->
                    <div class="border {{ $repayIsProfit ? 'border-amber-500/50 bg-amber-500/5' : 'border-base-300 bg-base-200/30' }} rounded-xl p-3 transition-all">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <div class="bg-amber-100 p-2 rounded-lg flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" wire:model.live="repayIsProfit" class="checkbox checkbox-sm checkbox-warning" />
                                    <span class="text-sm font-bold text-base-content">Profit (মুনাফা)</span>
                                </div>
                                <p class="text-[10px] text-base-content/40 ml-6">Service charge / profit</p>
                            </div>
                        </label>
                        @if($repayIsProfit)
                        <div class="mt-3 ml-10">
                            <input type="number" wire:model="repayProfitAmount" class="input input-bordered input-sm w-full bg-base-100 focus:ring-2 focus:ring-amber-500 focus:border-amber-500" placeholder="Enter amount..." />
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Method (Custom Styled Select) -->
                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Payment Method</label>
                    <div class="grid grid-cols-5 gap-1.5">
                        <label class="cursor-pointer">
                            <input type="radio" name="repayMethod" wire:model="repayMethod" value="Cash" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">💵</span>
                                <span class="text-[9px] font-bold text-base-content/60 peer-checked:text-emerald-700">Cash</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="repayMethod" wire:model="repayMethod" value="Bkash" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">📱</span>
                                <span class="text-[9px] font-bold text-base-content/60">Bkash</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="repayMethod" wire:model="repayMethod" value="Nagad" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">📲</span>
                                <span class="text-[9px] font-bold text-base-content/60">Nagad</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="repayMethod" wire:model="repayMethod" value="Rocket" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">🚀</span>
                                <span class="text-[9px] font-bold text-base-content/60">Rocket</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="repayMethod" wire:model="repayMethod" value="Bank" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">🏦</span>
                                <span class="text-[9px] font-bold text-base-content/60">Bank</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Transaction Details</label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>
                        </div>
                        <input type="text" wire:model="repayTransactionDetails" class="input input-bordered input-sm w-full pl-10 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="TrxID / Cheque No (Optional)" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-2">
                    <button wire:click="closeRepaymentModal" class="flex-1 py-2.5 border border-base-300 rounded-xl text-sm font-medium hover:bg-base-200 transition-all">Cancel</button>
                    <button wire:click="saveRepayment" class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-2.5 rounded-xl shadow-lg shadow-emerald-500/20 text-sm transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Collect Payment
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== View Loan Details Modal (Light & Dark Friendly) ===== -->
    @if($viewModal && $viewLoan)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-start sm:items-center justify-center z-50 p-2 sm:p-4 overflow-y-auto" wire:click="closeViewModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-2xl w-full relative my-4 sm:my-0 max-h-[90vh] overflow-y-auto border border-base-300" wire:click.stop>
            
            <!-- Header (Glassmorphism) -->
            <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-5 rounded-t-2xl text-white flex justify-between items-center sticky top-0 z-10">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-10 -mb-10 blur-2xl"></div>
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h2 class="text-lg font-bold tracking-tight">Loan Details - #{{ $viewLoan->member->account_no }}</h2>
                </div>
                <button wire:click="closeViewModal" class="relative z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm p-2 rounded-xl border border-white/20 transition-all"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <div class="p-5 space-y-4 text-sm">
                
                <!-- Member Info & Photo -->
                <div class="bg-red-500/5 backdrop-blur-sm p-4 rounded-xl flex items-center gap-4 border border-blue-500/20 shadow-sm">
                    <div class="w-16 h-16 rounded-full bg-base-300 overflow-hidden border-2 border-base-100 shadow-md flex-shrink-0">
                        @if($viewLoan->member && $viewLoan->member->photo)
                            <img src="{{ asset('storage/' . $viewLoan->member->photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-base-content/40">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs text-base-content/60">Applicant</p>
                        <p class="font-bold text-base-content text-lg">{{ $viewLoan->member->name_english }}</p>
                        <p class="text-xs text-base-content/60">Acc: #{{ $viewLoan->member->account_no }} | Mobile: {{ $viewLoan->member->mobile }}</p>
                    </div>
                </div>

                @php
                    $actualPayable = $viewLoan->loan_amount + $viewLoan->profit_amount;
                    $totalPaid = $viewLoan->repayments->sum('amount');
                    $totalProfitCollected = $viewLoan->repayments->sum(function($r) {
                        $details = is_array($r->transaction_details) ? $r->transaction_details : json_decode($r->transaction_details, true);
                        return ($details['profit'] ?? 0);
                    });
                    $remaining = max(0, $actualPayable - $totalPaid);
                @endphp

                <!-- Financial Cards -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="bg-gradient-to-br from-blue-500/10 to-blue-500/5 border border-blue-500/20 p-3 rounded-xl shadow-sm text-center">
                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-widest">Total Payable</p>
                        <p class="text-xl font-extrabold text-blue-700">৳{{ number_format($viewLoan->total_payable, 0) }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/20 p-3 rounded-xl shadow-sm text-center">
                        <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-widest">Total Paid</p>
                        <p class="text-xl font-extrabold text-emerald-700">৳{{ number_format($totalPaid, 0) }}</p>
                    </div>
                    <div class="bg-gradient-to-br {{ $remaining > 0 ? 'from-red-500/10 to-red-500/5 border-red-500/20' : 'from-green-500/10 to-green-500/5 border-green-500/20' }} p-3 rounded-xl shadow-sm text-center">
                        <p class="text-[10px] {{ $remaining > 0 ? 'text-red-600' : 'text-green-600' }} font-bold uppercase tracking-widest">{{ $remaining > 0 ? 'Remaining' : 'Fully Paid' }}</p>
                        <p class="text-xl font-extrabold {{ $remaining > 0 ? 'text-red-700' : 'text-green-700' }}">৳{{ number_format($remaining, 0) }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500/10 to-purple-500/5 border border-purple-500/20 p-3 rounded-xl shadow-sm text-center">
                        <p class="text-[10px] text-purple-600 font-bold uppercase tracking-widest">Profit Collected</p>
                        <p class="text-xl font-extrabold text-purple-700">৳{{ number_format($totalProfitCollected, 0) }}</p>
                    </div>
                </div>

                <!-- Loan Details List -->
                <div class="bg-base-200 p-4 rounded-xl border border-base-300 shadow-sm space-y-2 text-xs">
                    @if($viewLoan->purpose)
                    <div class="flex justify-between border-b border-base-300 pb-2">
                        <span class="text-base-content/60 font-semibold">Purpose</span>
                        <span class="font-bold text-base-content text-right max-w-[70%]">{{ $viewLoan->purpose }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between border-b border-base-300 pb-2">
                        <span class="text-base-content/60 font-semibold">Repayment Type</span>
                        <span class="font-bold text-base-content">{{ str_replace('_', ' ', ucfirst($viewLoan->repayment_type)) }}</span>
                    </div>

                    <div class="flex justify-between border-b border-base-300 pb-2">
                        <span class="text-base-content/60 font-semibold">Monthly Installment</span>
                        <span class="font-bold text-indigo-700 dark:text-indigo-400 text-base">৳{{ number_format($viewLoan->installment_amount, 0) }}</span>
                    </div>
                    
                    @if($viewLoan->next_due_date)
                    <div class="flex justify-between border-b border-base-300 pb-2">
                        <span class="text-base-content/60 font-semibold">Next Collection Date</span>
                        <span class="font-bold text-red-600 dark:text-red-400">{{ formatDate($viewLoan->next_due_date) }}</span>
                    </div>
                    @endif

                    @if($viewLoan->admin_description)
                    <div class="flex justify-between pt-2">
                        <span class="text-base-content/60 font-semibold">Admin Note</span>
                        <span class="font-medium text-base-content/70 text-right max-w-[70%]">{{ $viewLoan->admin_description }}</span>
                    </div>
                    @endif
                </div>

                @if($viewLoan->admin_description)
                <div class="relative overflow-hidden bg-gradient-to-br from-indigo-500/10 to-purple-500/5 backdrop-blur-md border border-indigo-400/30 shadow-lg shadow-indigo-500/5 p-4 rounded-xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-500/10 rounded-full -mr-8 -mt-8 blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-purple-500/10 rounded-full -ml-6 -mb-6 blur-2xl"></div>
                    <div class="relative z-10 flex items-start gap-3">
                        <div class="bg-indigo-500/20 p-2 rounded-lg flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-indigo-400 uppercase tracking-wider mb-1">Admin Note</p>
                            <p class="text-sm text-base-content/80 leading-relaxed">{{ $viewLoan->admin_description }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Guarantor Info -->
                @if($viewLoan->guarantor_type == 'admin' && $viewLoan->adminGuarantor)
                <div class="bg-red-500/15 backdrop-blur-sm border border-red-500/30 p-3 rounded-lg text-xs text-red-800 dark:text-red-400 flex items-center gap-2 font-extrabold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                    <strong>Admin Guarantor:</strong> {{ $viewLoan->adminGuarantor->name }}
                </div>
                @elseif($viewLoan->guarantor1 || $viewLoan->guarantor2)
                <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 p-3 rounded-lg text-xs text-purple-800 dark:text-purple-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                    <strong>Guarantors:</strong> 
                    1) {{ $viewLoan->guarantor1->name_english ?? 'N/A' }} (#{{ $viewLoan->guarantor1->account_no ?? 'N/A' }}), 
                    2) {{ $viewLoan->guarantor2->name_english ?? 'N/A' }} (#{{ $viewLoan->guarantor2->account_no ?? 'N/A' }})
                </div>
                @endif

                                <!-- Repayment History -->
                @if($viewLoan->repayments->count() > 0)
                <div class="bg-base-200/60 border border-base-300 rounded-xl overflow-hidden">
                    <!-- Table Header -->
                    <div class="grid grid-cols-[75px_0.8fr_0.8fr_75px_1.5fr] gap-x-4 px-5 py-2.5 bg-base-300/60 text-[10px] font-bold text-base-content/40 uppercase tracking-widest border-b border-base-300">
                        <div>Date</div>
                        <div class="text-right">Amount</div>
                        <div class="text-right">Profit</div>
                        <div class="text-center">Method</div>
                        <div class="text-right hidden sm:block">Collected By</div>
                    </div>
                    <!-- Table Body -->
                    <div class="divide-y divide-base-300/70 max-h-48 overflow-y-auto">
                        @foreach($viewLoan->repayments as $repayment)
                        @php $txnDetails = is_array($repayment->transaction_details) ? $repayment->transaction_details : json_decode($repayment->transaction_details, true); $txnProfit = $txnDetails['profit'] ?? 0; @endphp
                        <div class="grid grid-cols-[75px_0.8fr_0.8fr_75px_1.5fr] gap-x-4 px-5 py-3 text-xs items-center hover:bg-base-200 transition-colors">
                            <div class="text-base-content/50 text-[11px] whitespace-nowrap font-medium">{{ formatDateTime($repayment->payment_date) }}</div>
                            <div class="text-green-600 font-extrabold text-[13px] text-right">৳{{ number_format($repayment->amount, 0) }}</div>
                            <div class="text-purple-600 font-extrabold text-[13px] text-right">৳{{ number_format($txnProfit, 0) }}</div>
                            <div class="flex justify-center">
                                <span class="text-[9px] bg-blue-500/10 text-blue-600 border border-blue-500/20 px-2.5 py-1 rounded-lg font-semibold">{{ $repayment->payment_method }}</span>
                            </div>
                            <div class="text-base-content/70 text-[11px] text-right hidden sm:block font-medium truncate" title="{{ $repayment->collector->name ?? 'N/A' }}">{{ $repayment->collector->name ?? 'N/A' }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    @endif

</div>