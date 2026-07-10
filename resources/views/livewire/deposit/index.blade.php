<div>

    <!-- ===== Main Page Header ===== -->
    <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-6 sm:p-8 rounded-t-2xl shadow-lg text-white">
        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Deposit Management</h1>
                    <p class="text-sm text-blue-100 mt-1">মাসিক জমা ও সংগ্রহের তথ্য</p>
                </div>
            </div>
            <button wire:click="openAddDepositModal" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add Deposit
            </button>
        </div>
    </div>

    <!-- ===== Body Placeholder (Overall Stats & Recent Activity) ===== -->
    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">
        
        <!-- ✅ আইডিয়া ২: সামগ্রিক স্ট্যাটস (Overall Dashboard) -->
        <div class="mb-8">
            <h3 class="text-lg font-bold text-base-content/80 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                Overall Savings & Collection
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- ✅ Total Balance Card -->
                <div class="bg-gradient-to-br from-blue-500/10 to-blue-500/5 border border-blue-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-blue-600 font-bold uppercase">Total Balance</p>
                        <p class="text-xl font-extrabold text-blue-700">৳{{ number_format($totalBalance, 0) }}</p>
                    </div>
                </div>
                <!-- Total Savings -->
                <div class="bg-gradient-to-br from-green-500/10 to-green-500/5 border border-green-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-green-600 font-bold uppercase">Total Savings</p>
                        <p class="text-xl font-extrabold text-green-700">৳{{ number_format($overallStats->total_savings ?? 0, 0) }}</p>
                    </div>
                </div>
                <!-- Total Due -->
                <div class="bg-gradient-to-br from-red-500/10 to-red-500/5 border border-red-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-red-100 p-3 rounded-full text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-red-600 font-bold uppercase">Total Due</p>
                        <p class="text-xl font-extrabold text-red-700">৳{{ number_format($overallStats->total_due ?? 0, 0) }}</p>
                    </div>
                </div>
                <!-- Total Fine -->
                <div class="bg-gradient-to-br from-orange-500/10 to-orange-500/5 border border-orange-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-orange-100 p-3 rounded-full text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-orange-600 font-bold uppercase">Total Fine</p>
                        <p class="text-xl font-extrabold text-orange-700">৳{{ number_format($overallStats->total_fine ?? 0, 0) }}</p>
                    </div>
                </div>
                <!-- Total Other Pay -->
                <div class="bg-gradient-to-br from-purple-500/10 to-purple-500/5 border border-purple-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-purple-100 p-3 rounded-full text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-purple-600 font-bold uppercase">Total Other Pay</p>
                        <p class="text-xl font-extrabold text-purple-700">৳{{ number_format($overallStats->total_other ?? 0, 0) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ Tabs: Recent Activities & Due Month -->
        <div>
            <!-- Tab Buttons -->
            <div class="flex gap-2 mb-4 border-b border-base-300 pb-3">
                <button wire:click="switchTab('recent')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'recent' ? 'bg-blue-600 text-white shadow-md' : 'bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200' }}">
                    <span class="{{ $activeTab === 'recent' ? 'bg-white/20 p-1.5 rounded-full' : 'bg-blue-200/50 p-1.5 rounded-full' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $activeTab === 'recent' ? 'text-white' : 'text-blue-700' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    Recent Activities
                </button>
                <button wire:click="switchTab('due')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'due' ? 'bg-green-600 text-white shadow-md' : 'bg-green-50 text-green-600 hover:bg-green-100 border border-green-200' }}">
                    <span class="{{ $activeTab === 'due' ? 'bg-white/20 p-1.5 rounded-full' : 'bg-green-200/50 p-1.5 rounded-full' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $activeTab === 'due' ? 'text-white' : 'text-green-700' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </span>
                    Monthly Status
                </button>
                <button wire:click="switchTab('member-status')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'member-status' ? 'bg-purple-600 text-white shadow-md' : 'bg-purple-50 text-purple-600 hover:bg-purple-100 border border-purple-200' }}">
                    <span class="{{ $activeTab === 'member-status' ? 'bg-white/20 p-1.5 rounded-full' : 'bg-purple-200/50 p-1.5 rounded-full' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $activeTab === 'member-status' ? 'text-white' : 'text-purple-700' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </span>
                    Member Status
                </button>
                <!-- Requests Tab -->
                <button wire:click="switchTab('requests')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'requests' ? 'bg-amber-500 text-white shadow-md' : 'bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200' }}">
                    <span class="{{ $activeTab === 'requests' ? 'bg-white/20 p-1.5 rounded-full' : 'bg-amber-200/50 p-1.5 rounded-full' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $activeTab === 'requests' ? 'text-white' : 'text-amber-700' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    </span>
                    Requests
                    @if($pendingRequestsCount > 0)
                    <span class="ml-1 bg-red-500 text-white text-[10px] font-extrabold px-1.5 py-0.5 rounded-full">{{ $pendingRequestsCount }}</span>
                    @endif
                </button>
            </div>

            <!-- Tab Content: Recent Activities -->
            @if($activeTab === 'recent')
            <div>
                <!-- Desktop Table View -->
                <div class="hidden md:block bg-base-200/50 border border-base-300 rounded-xl overflow-x-auto max-h-[60vh] overflow-y-auto">
                    <table class="table w-full text-sm">
                        <thead>
                            <tr class="bg-blue-600 text-white uppercase text-xs">
                                <th class="py-3 px-3 text-center">Date & Time</th>
                                <th class="py-3 px-3 text-center">Month</th>
                                <th class="py-3 px-3 text-center">Acc#</th>
                                <th class="py-3 px-3 text-left">Name</th>
                                <th class="py-3 px-3 text-center">Share</th>
                                <th class="py-3 px-3 text-center">Deposit</th>
                                <th class="py-3 px-3 text-center">Due</th>
                                <th class="py-3 px-3 text-center">Fine(5%)</th>
                                <th class="py-3 px-3 text-center">Other Pay</th>
                                <th class="py-3 px-3 text-center">Pay Method</th>
                                <th class="py-3 px-3 text-center">By</th>
                                <th class="py-3 px-3 text-center">Comment</th>
                                <th class="py-3 px-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentActivities as $activity)
                            @php $isLate = $activity->updated_at->gt(\Carbon\Carbon::parse($activity->month_year . '-01')->endOfMonth()); @endphp
                            <tr class="border-b border-base-200 {{ $isLate ? 'bg-orange-500/10 hover:bg-orange-500/20' : 'bg-green-500/10 hover:bg-green-500/20' }}">
                                <td class="py-3 px-3 text-center text-xs text-base-content/70 whitespace-nowrap">{{ formatDateTime($activity->updated_at) }}</td>
                                <td class="py-3 px-3 text-center text-xs font-semibold text-indigo-600 whitespace-nowrap">{{ \Carbon\Carbon::parse($activity->month_year . '-01')->format('M Y') }}</td>
                                <td class="py-3 px-3 text-center font-bold text-{{ $isLate ? 'orange' : 'green' }}-600">#{{ $activity->member->account_no ?? 'N/A' }}</td>
                                <td class="py-3 px-3 text-left font-medium text-base-content truncate max-w-[150px]">{{ $activity->member->name_english ?? 'N/A' }}</td>
                                <td class="py-3 px-3 text-center"><span class="badge badge-ghost badge-sm">{{ $activity->member->shares ?? 0 }}</span></td>
                                <td class="py-3 px-3 text-center font-semibold text-{{ $isLate ? 'orange' : 'green' }}-600">৳{{ number_format($activity->deposit_amount, 0) }}</td>
                                <td class="py-3 px-3 text-center {{ $activity->due_amount > 0 ? 'text-red-500 font-bold' : 'text-base-content/50' }}">৳{{ number_format($activity->due_amount, 0) }}</td>
                                <td class="py-3 px-3 text-center">
                                    @if($activity->fine_amount > 0)
                                        <span class="text-orange-500 font-bold">৳{{ number_format($activity->fine_amount, 0) }}</span>
                                        <span class="text-[10px] text-orange-400 block">(+5%)</span>
                                    @else
                                        <span class="text-base-content/50">৳0</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-center {{ $activity->other_payment > 0 ? 'text-purple-600 font-bold' : 'text-base-content/50' }}">৳{{ number_format($activity->other_payment, 0) }}</td>
                                <td class="py-3 px-3 text-center text-base-content/70">{{ $activity->payment_method }}</td>
                                <td class="py-3 px-3 text-center text-xs text-base-content/60 truncate max-w-[100px]">{{ $activity->paid_by_info }}</td>
                                <td class="py-3 px-3 text-center">
                                    @if($activity->comment)
                                        <span class="tooltip tooltip-left" data-tip="{{ $activity->comment }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                                        </span>
                                    @else
                                        <span class="text-base-content/30">—</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <span class="{{ $isLate ? 'bg-orange-500' : 'bg-green-600' }} text-white px-3 py-1 rounded-lg text-xs font-bold">Paid</span>
                                        <button wire:click="goToDeposit({{ $activity->member->id }})" class="btn btn-ghost btn-xs {{ $isLate ? 'text-orange-500 hover:bg-orange-50' : 'text-green-500 hover:bg-green-50' }} p-0.5" title="View in Collection">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="13" class="text-center py-8 text-base-content/40">No recent activities found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden space-y-3 max-h-[60vh] overflow-y-auto pr-1">
                    @forelse ($recentActivities as $activity)
                    <div class="bg-green-500/10 border border-green-300 rounded-xl p-4 shadow-sm transition-shadow">
                        <div class="flex justify-between items-center mb-3 pb-2 border-b border-base-300">
                            <div>
                                <span class="text-xs font-bold text-green-600 bg-green-500/10 px-2 py-0.5 rounded">#{{ $activity->member->account_no ?? 'N/A' }}</span>
                                <h4 class="text-sm font-bold text-base-content mt-1">{{ $activity->member->name_english ?? 'N/A' }}</h4>
                                <p class="text-[10px] text-indigo-500 font-semibold mt-0.5">{{ \Carbon\Carbon::parse($activity->month_year . '-01')->format('F Y') }}</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center gap-1">
                                    <span class="{{ $isLate ? 'bg-orange-500' : 'bg-green-600' }} text-white px-3 py-1 rounded-lg text-xs font-bold">Paid</span>
                                    <button wire:click="goToDeposit({{ $activity->member->id }})" class="btn btn-ghost btn-xs {{ $isLate ? 'text-orange-500 hover:bg-orange-50' : 'text-green-500 hover:bg-green-50' }} p-0.5" title="View in Collection">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    </button>
                                </div>
                                <p class="text-[10px] text-base-content/40 mt-1">Share: {{ $activity->member->shares ?? 0 }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-2 text-center">
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Deposit</p>
                                <p class="text-sm font-bold text-green-600">৳{{ number_format($activity->deposit_amount, 0) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Due</p>
                                <p class="text-sm font-bold {{ $activity->due_amount > 0 ? 'text-red-500' : 'text-base-content/40' }}">৳{{ number_format($activity->due_amount, 0) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Fine</p>
                                <p class="text-sm font-bold {{ $activity->fine_amount > 0 ? 'text-orange-500' : 'text-base-content/40' }}">৳{{ number_format($activity->fine_amount, 0) }}</p>
                                @if($activity->fine_amount > 0)
                                    <p class="text-[9px] text-orange-400">(+5%)</p>
                                @endif
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Other Pay</p>
                                <p class="text-sm font-bold {{ $activity->other_payment > 0 ? 'text-purple-600' : 'text-base-content/40' }}">৳{{ number_format($activity->other_payment, 0) }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-dashed border-base-300 text-[10px] text-base-content/60">
                            <span><span class="font-bold">Method:</span> {{ $activity->payment_method }}</span>
                            <span><span class="font-bold">By:</span> {{ $activity->paid_by_info }}</span>
                        </div>
                        <div class="mt-2 pt-2 border-t border-dashed border-base-300 text-[10px] text-base-content/50 flex justify-between items-center">
                            <span><span class="font-bold">Date:</span> {{ formatDateTime($activity->updated_at) }}</span>
                        </div>
                        @if($activity->comment)
                            <div class="mt-2 pt-2 border-t border-dashed border-base-300 text-[10px] text-blue-500 bg-blue-500/10 p-1.5 rounded">
                                <span class="font-bold text-blue-600">Comment:</span> {{ $activity->comment }}
                            </div>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-10 text-base-content/40 text-sm bg-base-200/50 rounded-xl border border-base-300">No recent activities found.</div>
                    @endforelse
                </div>
            </div>
            @endif

            <!-- Tab Content: Due Month -->
            @if($activeTab === 'due')
            <div>
                <!-- Month Selector -->
                <div class="mb-4 flex flex-col sm:flex-row items-start sm:items-center gap-3 bg-green-500/10 p-3 rounded-xl border border-green-500/20">
                    <label class="text-sm font-bold text-base-content/70">Select Month:</label>
                    <select wire:model.live="dueMonth" class="select select-bordered select-sm w-full sm:w-64 shadow-sm bg-base-100 focus:border-green-400">
                        @foreach ($months as $month)
                            <option value="{{ $month }}" class="text-base-content">{{ $month }}</option>
                        @endforeach
                    </select>
                        <div class="bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold shadow-sm border border-green-300 hidden sm:block">
                            {{ $dueMonth }} Month
                        </div>
                    <div class="sm:ml-auto bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl shadow text-xs flex items-center gap-2 transition-colors cursor-default">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                        Due Members: {{ $dueMembers->where('status', 'draft')->count() }}
                    </div>
                </div>

                <!-- Desktop Table View (All Members Status Report Style) -->
                <div class="hidden md:block bg-white border border-gray-200 rounded-xl overflow-x-auto shadow-sm">
                    <table class="table w-full text-sm">
                        <thead>
                            <tr class="bg-green-600 text-white uppercase text-xs">
                                <th class="py-3 px-3 text-center">Date & Time</th>
                                <th class="py-3 px-3 text-center">Acc#</th>
                                <th class="py-3 px-3 text-left">Name</th>
                                <th class="py-3 px-3 text-center">Share</th>
                                <th class="py-3 px-3 text-center">Deposit</th>
                                <th class="py-3 px-3 text-center">Due</th>
                                <th class="py-3 px-3 text-center">Fine(5%)</th>
                                <th class="py-3 px-3 text-center">Other Pay</th>
                                <th class="py-3 px-3 text-center">Pay Method</th>
                                <th class="py-3 px-3 text-center">By</th>
                                <th class="py-3 px-3 text-center">Comment</th>
                                <th class="py-3 px-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dueMembers as $due)
                            @php $isUnpaid = $due->status !== 'paid'; $isLateDue = !$isUnpaid && $due->updated_at->gt(\Carbon\Carbon::parse($due->month_year . '-01')->endOfMonth()); @endphp
                            <tr class="border-b border-base-200 transition-colors {{ $isUnpaid ? 'hover:bg-red-500/5 bg-red-500/[0.02]' : ($isLateDue ? 'bg-orange-500/10 hover:bg-orange-500/20' : 'bg-green-500/10 hover:bg-green-500/20') }}">
                                <td class="py-3 px-3 text-center text-xs text-base-content/70 whitespace-nowrap">{{ $isUnpaid ? '—' : formatDateTime($due->updated_at) }}</td>
                                <td class="py-3 px-3 text-center font-bold text-{{ $isUnpaid ? 'green' : ($isLateDue ? 'orange' : 'green') }}-600">#{{ $due->member->account_no ?? 'N/A' }}</td>
                                <td class="py-3 px-3 text-left font-medium text-base-content truncate max-w-[150px]">{{ $due->member->name_english ?? 'N/A' }}</td>
                                <td class="py-3 px-3 text-center"><span class="badge badge-ghost badge-sm">{{ $due->member->shares ?? 0 }}</span></td>
                                <td class="py-3 px-3 text-center font-semibold text-{{ $isUnpaid ? 'green' : ($isLateDue ? 'orange' : 'green') }}-600">৳{{ number_format($due->deposit_amount, 0) }}</td>
                                <td class="py-3 px-3 text-center {{ $due->due_amount > 0 ? 'text-red-500 font-bold' : 'text-base-content/50' }}">৳{{ number_format($due->due_amount, 0) }}</td>
                                <td class="py-3 px-3 text-center">
                                    @if($due->fine_amount > 0)
                                        <span class="text-orange-500 font-bold">৳{{ number_format($due->fine_amount, 0) }}</span>
                                        <span class="text-[10px] text-orange-400 block">(+5%)</span>
                                    @else
                                        <span class="text-base-content/50">৳0</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-center {{ $due->other_payment > 0 ? 'text-purple-600 font-bold' : 'text-base-content/50' }}">৳{{ number_format($due->other_payment, 0) }}</td>
                                <td class="py-3 px-3 text-center text-base-content/70">{{ $due->payment_method }}</td>
                                <td class="py-3 px-3 text-center text-xs text-base-content/60 truncate max-w-[100px]">{{ $due->paid_by_info }}</td>
                                                                <td class="py-3 px-3 text-center">
                                    @if($due->comment)
                                        <span class="tooltip tooltip-left" data-tip="{{ $due->comment }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                                        </span>
                                    @else
                                        <span class="text-base-content/30">—</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-center">
                                    @if($isUnpaid)
                                        <button wire:click="goToDeposit({{ $due->member->id }})" class="group {{ $isLatePeriod ? 'bg-red-600 hover:bg-red-700' : 'bg-amber-500 hover:bg-amber-600' }} text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow transition-colors mx-auto" title="Click to Collect">
                                            <span class="group-hover:hidden">Unpaid</span>
                                            <span class="hidden group-hover:inline">Pay</span>
                                        </button>
                                    @else
                                        <div class="flex items-center justify-center gap-1">
                                            <span class="{{ $isLateDue ? 'bg-orange-500' : 'bg-green-600' }} text-white px-3 py-1 rounded-lg text-xs font-bold">Paid</span>
                                            <button wire:click="goToDeposit({{ $due->member->id }})" class="btn btn-ghost btn-xs text-{{ $isLateDue ? 'orange' : 'green' }}-500 hover:bg-{{ $isLateDue ? 'orange' : 'green' }}-50 p-0.5" title="View in Collection">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="12" class="text-center py-8 text-base-content/40">No data found for this month.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View (All Members Status Report Style) -->
                <div class="md:hidden space-y-3">
                    @forelse ($dueMembers as $due)
                    @php $isUnpaid = $due->status !== 'paid'; $isLateDueMob = !$isUnpaid && $due->updated_at->gt(\Carbon\Carbon::parse($due->month_year . '-01')->endOfMonth()); @endphp
                    <div class="bg-base-200/50 border {{ $isUnpaid ? 'border-red-300/50' : ($isLateDueMob ? 'border-orange-300 bg-orange-500/10' : 'border-green-300 bg-green-500/10') }} rounded-xl p-4 shadow-sm transition-shadow">
                        <div class="flex justify-between items-center mb-3 pb-2 border-b border-base-300">
                            <div>
                                <span class="text-xs font-bold text-{{ $isUnpaid ? 'green' : ($isLateDueMob ? 'orange' : 'green') }}-600 bg-{{ $isUnpaid ? 'green' : ($isLateDueMob ? 'orange' : 'green') }}-500/10 px-2 py-0.5 rounded">#{{ $due->member->account_no ?? 'N/A' }}</span>
                                <h4 class="text-sm font-bold text-base-content mt-1">{{ $due->member->name_english ?? 'N/A' }}</h4>
                            </div>
                            <div class="text-right">
                                                                @if($isUnpaid)
                                    <button wire:click="goToDeposit({{ $due->member->id }})" class="group {{ $isLatePeriod ? 'bg-red-600 hover:bg-red-700' : 'bg-amber-500 hover:bg-amber-600' }} text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow transition-colors" title="Click to Collect">
                                        <span class="group-hover:hidden">Unpaid</span>
                                        <span class="hidden group-hover:inline">Pay</span>
                                    </button>
                                @else
                                    <span class="{{ $isLateDueMob ? 'bg-orange-500' : 'bg-green-600' }} text-white px-3 py-1 rounded-lg text-xs font-bold">Paid</span>
                                @endif
                                <p class="text-[10px] text-base-content/40 mt-1">Share: {{ $due->member->shares ?? 0 }}</p>
                            </div>
                        </div>
                        
                        @if($isUnpaid)
                        <div class="grid grid-cols-4 gap-2 text-center">
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Deposit</p>
                                <p class="text-sm font-bold text-{{ $isUnpaid ? 'green' : ($isLateDueMob ? 'orange' : 'green') }}-600">৳{{ number_format($due->deposit_amount, 0) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Due</p>
                                <p class="text-sm font-bold {{ $due->due_amount > 0 ? 'text-red-500' : 'text-base-content/40' }}">৳{{ number_format($due->due_amount, 0) }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Fine</p>
                                <p class="text-sm font-bold {{ $due->fine_amount > 0 ? 'text-orange-500' : 'text-base-content/40' }}">৳{{ number_format($due->fine_amount, 0) }}</p>
                                @if($due->fine_amount > 0)
                                    <p class="text-[9px] text-orange-400">(+5%)</p>
                                @endif
                            </div>
                            <div>
                                <p class="text-[10px] text-base-content/50 uppercase font-bold">Other Pay</p>
                                <p class="text-sm font-bold {{ $due->other_payment > 0 ? 'text-purple-600' : 'text-base-content/40' }}">৳{{ number_format($due->other_payment, 0) }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-dashed border-base-300 text-[10px] text-base-content/60">
                            <span><span class="font-bold">Method:</span> {{ $due->payment_method }}</span>
                            <span><span class="font-bold">By:</span> {{ $due->paid_by_info }}</span>
                        </div>
                        @if($due->comment)
                            <div class="mt-2 pt-2 border-t border-dashed border-base-300 text-[10px] text-blue-500 bg-blue-500/10 p-1.5 rounded">
                                <span class="font-bold text-blue-600">Comment:</span> {{ $due->comment }}
                            </div>
                        @endif
                        @else
                        <div class="text-center text-{{ $isLateDueMob ? 'orange' : 'green' }}-600 text-sm font-semibold bg-{{ $isLateDueMob ? 'orange' : 'green' }}-500/10 rounded-lg py-2 mb-2">
                            ✅ Successfully Paid
                        </div>
                        <div class="text-[10px] text-base-content/50 flex justify-between items-center">
                            <span><span class="font-bold">Method:</span> {{ $due->payment_method }}</span>
                            <span><span class="font-bold">By:</span> {{ $due->paid_by_info }}</span>
                        </div>
                        <div class="mt-1 pt-1 border-t border-dashed border-base-300 text-[10px] text-base-content/50">
                            <span class="font-bold">Date:</span> {{ formatDateTime($due->updated_at) }}
                        </div>
                        @if($due->comment)
                            <div class="mt-2 pt-2 border-t border-dashed border-base-300 text-[10px] text-blue-500 bg-blue-500/10 p-1.5 rounded">
                                <span class="font-bold text-blue-600">Comment:</span> {{ $due->comment }}
                            </div>
                        @endif
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-10 text-base-content/40 text-sm bg-base-200/50 rounded-xl border border-base-300">No data found for this month.</div>
                    @endforelse
                </div>
            </div>
            @endif

            <!-- Tab Content: Member Deposit Status -->
            @if($activeTab === 'member-status')
            <div>
                <!-- Top Bar: Dropdown + Download -->
                <div class="mb-4 flex flex-col sm:flex-row items-start sm:items-center gap-3 bg-purple-500/10 p-3 rounded-xl border border-purple-500/20">
                    <label class="text-sm font-bold text-base-content/70">Select Member:</label>
                        <select wire:model.live="selectedStatusMemberId" class="select select-bordered select-sm w-full sm:w-64 shadow-sm bg-base-100 focus:border-purple-400">
                            <option value="">-- Choose Member --</option>
                            @foreach($allMembers as $m)
                                <option value="{{ $m->id }}">#{{ $m->account_no }} - {{ $m->name_english }}</option>
                            @endforeach
                        </select>
                        @php $selectedMember = $allMembers->firstWhere('id', $selectedStatusMemberId); @endphp
                        @if($selectedMember)
                            <div class="bg-purple-100 text-purple-700 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold shadow-sm border border-purple-300">
                                {{ $selectedMember->name_english }}
                            </div>
                        @endif
                        @if($selectedStatusMemberId && $memberDepositDetails->count() > 0)
                    <button wire:click="downloadMemberDepositReport" class="sm:ml-auto bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-xl shadow text-xs flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Download CSV
                    </button>
                    @endif
                </div>

                @if($selectedStatusMemberId && $memberDepositSummary)
                    <!-- 6 Summary Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-6 gap-3 mb-5">
                        <div class="bg-green-500/10 border border-green-500/20 p-3 rounded-xl flex items-center gap-3">
                            <div class="bg-green-100 p-2.5 rounded-full text-green-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div><p class="text-[10px] text-green-600 font-bold uppercase">Paid Months</p><p class="text-lg font-bold text-green-700">{{ $memberDepositSummary->total_paid_months }}</p></div>
                        </div>
                        <div class="bg-red-500/10 border border-red-500/20 p-3 rounded-xl flex items-center gap-3">
                            <div class="bg-red-100 p-2.5 rounded-full text-red-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div><p class="text-[10px] text-red-600 font-bold uppercase">Unpaid Months</p><p class="text-lg font-bold text-red-700">{{ $memberDepositSummary->total_unpaid_months }}</p></div>
                        </div>
                        <div class="bg-purple-500/10 border border-purple-500/20 p-3 rounded-xl flex items-center gap-3">
                            <div class="bg-purple-100 p-2.5 rounded-full text-purple-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div><p class="text-[10px] text-purple-600 font-bold uppercase">Total Collection</p><p class="text-lg font-bold text-purple-700">৳{{ number_format($memberDepositSummary->total_deposit + $memberDepositSummary->total_due + $memberDepositSummary->total_fine + $memberDepositSummary->total_other, 0) }}</p></div>
                        </div>
                        <div class="bg-orange-500/10 border border-orange-500/20 p-3 rounded-xl flex items-center gap-3">
                            <div class="bg-orange-100 p-2.5 rounded-full text-orange-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg></div>
                            <div><p class="text-[10px] text-orange-600 font-bold uppercase">Total Due Paid</p><p class="text-lg font-bold text-orange-700">৳{{ number_format($memberDepositSummary->total_due, 0) }}</p></div>
                        </div>
                        <div class="bg-amber-500/10 border border-amber-500/20 p-3 rounded-xl flex items-center gap-3">
                            <div class="bg-amber-100 p-2.5 rounded-full text-amber-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg></div>
                            <div><p class="text-[10px] text-amber-600 font-bold uppercase">Total Fine</p><p class="text-lg font-bold text-amber-700">৳{{ number_format($memberDepositSummary->total_fine, 0) }}</p></div>
                        </div>
                        <div class="bg-pink-500/10 border border-pink-500/20 p-3 rounded-xl flex items-center gap-3">
                            <div class="bg-pink-100 p-2.5 rounded-full text-pink-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" /></svg></div>
                            <div><p class="text-[10px] text-pink-600 font-bold uppercase">Total Other Pay</p><p class="text-lg font-bold text-pink-700">৳{{ number_format($memberDepositSummary->total_other, 0) }}</p></div>
                        </div>
                    </div>

                    <!-- ===== DESKTOP TABLE ===== -->
                    <div class="hidden md:block bg-white border border-gray-200 rounded-xl overflow-x-auto shadow-sm">
                        <table class="table w-full text-sm">
                            <thead>
                                <tr class="bg-purple-600 text-white uppercase text-xs">
                                    <th class="py-3 px-3 text-center">Date & Time</th>
                                    <th class="py-3 px-3 text-left">Month</th>
                                    <th class="py-3 px-3 text-center">Status</th>
                                    <th class="py-3 px-3 text-center">Deposit</th>
                                    <th class="py-3 px-3 text-center">Due</th>
                                    <th class="py-3 px-3 text-center">Fine</th>
                                    <th class="py-3 px-3 text-center">Other Pay</th>
                                    <th class="py-3 px-3 text-center">Total</th>
                                    <th class="py-3 px-3 text-center">Method</th>
                                    <th class="py-3 px-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($memberDepositDetails as $detail)
                                @php $isPaid = $detail->status === 'paid'; $isLateMember = $isPaid && $detail->updated_at->gt(\Carbon\Carbon::parse($detail->month_year . '-01')->endOfMonth()); $rowTotal = $detail->deposit_amount + $detail->due_amount + $detail->fine_amount + $detail->other_payment; @endphp
                                <tr class="border-b border-base-200 transition-colors {{ $isPaid ? ($isLateMember ? 'bg-orange-500/5 hover:bg-orange-500/10' : 'bg-green-500/5 hover:bg-green-500/10') : 'bg-red-500/5 hover:bg-red-500/10' }}">
                                    <td class="py-3 px-3 text-center text-xs text-base-content/70 whitespace-nowrap">{{ $isPaid ? formatDateTime($detail->updated_at) : '—' }}</td>
                                    <td class="py-3 px-3 text-left font-semibold text-base-content">{{ \Carbon\Carbon::parse($detail->month_year . '-01')->format('F Y') }}</td>
                                    <td class="py-3 px-3 text-center">
                                        @if($isPaid)
                                            <span class="badge {{ $isLateMember ? 'bg-orange-500 text-white border-orange-600' : 'badge-success text-white' }} badge-sm">Paid</span>
                                        @else
                                            <span class="badge badge-error badge-sm text-white">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3 text-center font-bold text-green-600">৳{{ number_format($detail->deposit_amount, 0) }}</td>
                                    <td class="py-3 px-3 text-center font-bold {{ $detail->due_amount > 0 ? 'text-red-500' : 'text-base-content/40' }}">৳{{ number_format($detail->due_amount, 0) }}</td>
                                    <td class="py-3 px-3 text-center font-bold {{ $detail->fine_amount > 0 ? 'text-orange-500' : 'text-base-content/40' }}">৳{{ number_format($detail->fine_amount, 0) }}</td>
                                    <td class="py-3 px-3 text-center font-bold {{ $detail->other_payment > 0 ? 'text-purple-600' : 'text-base-content/40' }}">৳{{ number_format($detail->other_payment, 0) }}</td>
                                    <td class="py-3 px-3 text-center font-extrabold text-indigo-600">৳{{ number_format($rowTotal, 0) }}</td>
                                    <td class="py-3 px-3 text-center text-xs text-base-content/70">{{ $detail->payment_method }}</td>
                                    <td class="py-3 px-3 text-center">
                                        @if($isPaid)
                                            <div class="flex items-center justify-center gap-1">
                                                <button wire:click="openReceiptModal({{ $detail->id }})" class="btn btn-ghost btn-xs text-green-600 hover:bg-green-500/10 gap-1 font-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18.25 7.28H5.75" /></svg>
                                                    Print
                                                </button>
                                                <button wire:click="goToDeposit({{ $detail->member_id }}, '{{ $detail->month_year }}')" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 p-0.5" title="View in Collection">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                </button>
                                            </div>
                                        @else
                                            <button wire:click="goToDeposit({{ $detail->member_id }}, '{{ $detail->month_year }}')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs font-bold shadow transition-colors">Pay Now</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <!-- ===== MOBILE CARDS ===== -->
                    <div class="md:hidden space-y-3">
                        @foreach($memberDepositDetails as $detail)
                        @php $isPaid = $detail->status === 'paid'; $isLateMob = $isPaid && $detail->updated_at->gt(\Carbon\Carbon::parse($detail->month_year . '-01')->endOfMonth()); $rowTotal = $detail->deposit_amount + $detail->due_amount + $detail->fine_amount + $detail->other_payment; @endphp
                        <div class="border {{ $isPaid ? ($isLateMob ? 'border-orange-300 bg-orange-500/5' : 'border-green-300 bg-green-500/5') : 'border-red-300 bg-red-500/5' }} rounded-xl p-4 shadow-sm">
                            <div class="flex justify-between items-center mb-3 pb-2 border-b border-base-300">
                                <div>
                                    <h4 class="text-sm font-bold text-base-content">{{ \Carbon\Carbon::parse($detail->month_year . '-01')->format('F Y') }}</h4>
                                    <p class="text-[10px] text-base-content/50 mt-0.5">{{ $detail->payment_method }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if($isPaid)
                                        <div class="flex items-center gap-1">
                                            <span class="{{ $isLateMob ? 'bg-orange-500' : 'bg-green-600' }} text-white px-2.5 py-1 rounded-lg text-xs font-bold">Paid</span>
                                            <button wire:click="openReceiptModal({{ $detail->id }})" class="btn btn-ghost btn-xs text-{{ $isLateMob ? 'orange' : 'green' }}-500 p-0.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18.25 7.28H5.75" /></svg>
                                            </button>
                                            <button wire:click="goToDeposit({{ $detail->member_id }}, '{{ $detail->month_year }}')" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 p-0.5" title="View in Collection">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            </button>
                                        </div>
                                    @else
                                        <button wire:click="goToDeposit({{ $detail->member_id }}, '{{ $detail->month_year }}')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow transition-colors">Pay Now</button>
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-2 text-center">
                                <div class="bg-green-500/10 rounded-lg p-1.5">
                                    <p class="text-[9px] text-base-content/40 uppercase font-bold">Deposit</p>
                                    <p class="text-xs font-bold text-green-600">৳{{ number_format($detail->deposit_amount, 0) }}</p>
                                </div>
                                <div class="bg-red-500/10 rounded-lg p-1.5">
                                    <p class="text-[9px] text-base-content/40 uppercase font-bold">Due</p>
                                    <p class="text-xs font-bold {{ $detail->due_amount > 0 ? 'text-red-500' : 'text-base-content/40' }}">৳{{ number_format($detail->due_amount, 0) }}</p>
                                </div>
                                <div class="bg-orange-500/10 rounded-lg p-1.5">
                                    <p class="text-[9px] text-base-content/40 uppercase font-bold">Fine</p>
                                    <p class="text-xs font-bold {{ $detail->fine_amount > 0 ? 'text-orange-500' : 'text-base-content/40' }}">৳{{ number_format($detail->fine_amount, 0) }}</p>
                                </div>
                                <div class="bg-indigo-500/10 rounded-lg p-1.5">
                                    <p class="text-[9px] text-base-content/40 uppercase font-bold">Total</p>
                                    <p class="text-xs font-extrabold text-indigo-600">৳{{ number_format($rowTotal, 0) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                @elseif($selectedStatusMemberId)
                    <div class="text-center py-10 text-base-content/40 text-sm bg-base-200/50 rounded-xl border border-base-300">No deposit records found for this member.</div>
                @else
                    <div class="text-center py-16 text-base-content/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <p class="text-sm font-semibold">Select a member to view their deposit history</p>
                    </div>
                @endif
            </div>
            @endif

            <!-- ===== Tab Content: Deposit Requests ===== -->
            @if($activeTab === 'requests')
            <div>
                <!-- Filter Bar + Stats -->
                <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                    <div class="flex flex-wrap gap-2">
                        <button wire:click="$set('requestsFilter', 'pending')"
                                class="flex items-center gap-1.5 px-4 py-2 text-xs font-bold rounded-xl border-2 transition {{ $requestsFilter==='pending' ? 'bg-amber-500 text-white border-amber-500 shadow-md shadow-amber-200' : 'bg-amber-50 text-amber-700 border-amber-200 hover:border-amber-400' }}">
                            ⏳ Pending
                            @if($pendingRequestsCount > 0)
                            <span class="{{ $requestsFilter==='pending' ? 'bg-white/30' : 'bg-amber-200' }} text-amber-900 text-[10px] font-extrabold px-1.5 py-0.5 rounded-full">{{ $pendingRequestsCount }}</span>
                            @endif
                        </button>
                        <button wire:click="$set('requestsFilter', 'approved')"
                                class="px-4 py-2 text-xs font-bold rounded-xl border-2 transition {{ $requestsFilter==='approved' ? 'bg-emerald-500 text-white border-emerald-500 shadow-md shadow-emerald-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:border-emerald-400' }}">
                            ✅ Approved
                        </button>
                        <button wire:click="$set('requestsFilter', 'rejected')"
                                class="px-4 py-2 text-xs font-bold rounded-xl border-2 transition {{ $requestsFilter==='rejected' ? 'bg-red-500 text-white border-red-500 shadow-md shadow-red-200' : 'bg-red-50 text-red-700 border-red-200 hover:border-red-400' }}">
                            ⛔ Rejected
                        </button>
                        <button wire:click="$set('requestsFilter', 'all')"
                                class="px-4 py-2 text-xs font-bold rounded-xl border-2 transition {{ $requestsFilter==='all' ? 'bg-gray-600 text-white border-gray-600' : 'bg-base-200 text-base-content/60 border-base-300 hover:border-base-content/30' }}">
                            📋 All
                        </button>
                    </div>
                    <p class="text-xs text-base-content/40 font-semibold">{{ count($depositRequests) }} records</p>
                </div>

                @if(count($depositRequests) === 0)
                <div class="text-center py-16 text-base-content/30 bg-base-200/50 rounded-2xl border border-base-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <p class="text-sm font-bold">No requests found.</p>
                </div>
                @else
                <!-- Desktop Table -->
                <div class="hidden md:block overflow-x-auto rounded-2xl border border-base-300 shadow-sm max-h-[65vh] overflow-y-auto">
                    <table class="table w-full text-sm">
                        <thead class="sticky top-0 z-10">
                            <tr class="bg-gradient-to-r from-amber-500 to-amber-400 text-white text-[11px] uppercase tracking-wide">
                                <th class="py-3.5 px-4 font-bold text-left">Member</th>
                                <th class="py-3.5 px-3 font-bold text-center">Month</th>
                                <th class="py-3.5 px-3 font-bold text-center">💰 Deposit</th>
                                <th class="py-3.5 px-3 font-bold text-center">📋 Due</th>
                                <th class="py-3.5 px-3 font-bold text-center">⚠️ Fine</th>
                                <th class="py-3.5 px-3 font-bold text-center">Total</th>
                                <th class="py-3.5 px-3 font-bold text-center">Method</th>
                                <th class="py-3.5 px-3 font-bold text-center">Proof</th>
                                <th class="py-3.5 px-3 font-bold text-center">Status</th>
                                <th class="py-3.5 px-3 font-bold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200">
                            @foreach($depositRequests as $req)
                            @php
                                $dAmt = (float)($req['deposit_amount'] ?? 0);
                                $uAmt = (float)($req['due_amount']     ?? 0);
                                $fAmt = (float)($req['fine_amount']    ?? 0);
                                $tot  = $dAmt + $uAmt + $fAmt ?: (float)($req['amount'] ?? 0);
                                $isPending  = $req['status'] === 'pending';
                                $statusBadge = match($req['status']) { 
                                    'pending' => 'bg-amber-100 text-amber-800 border border-amber-300',
                                    'approved' => 'bg-emerald-100 text-emerald-800 border border-emerald-300',
                                    'rejected' => 'bg-red-100 text-red-800 border border-red-300',
                                    default => 'badge-ghost' 
                                };
                                $rowBg = $isPending ? 'bg-amber-500/5 hover:bg-amber-500/10' : 'hover:bg-base-200/60';
                            @endphp
                            <tr class="transition-colors {{ $rowBg }}">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 border border-amber-200 overflow-hidden">
                                            @if(!empty($req['member']['photo']))
                                                <img src="{{ asset('storage/' . $req['member']['photo']) }}" class="w-full h-full object-cover" alt="">
                                            @else
                                                <span class="text-[11px] font-extrabold text-amber-700">{{ strtoupper(substr($req['member']['name_english'] ?? 'M', 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-[13px] text-base-content">{{ $req['member']['name_english'] ?? '—' }}</p>
                                            <p class="text-[10px] text-base-content/50 leading-relaxed">
                                                <span class="font-semibold">#Acc:</span> {{ $req['member']['account_no'] ?? '—' }}
                                                · <span class="font-semibold">Share:</span> {{ $req['member']['shares'] ?? '—' }}
                                            </p>
                                            <p class="text-[10px] text-base-content/40">
                                                <span class="font-semibold">Datetime:</span> {{ \Carbon\Carbon::parse($req['created_at'])->format('d M Y, h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <span class="bg-indigo-100 text-indigo-700 text-[11px] font-extrabold px-2.5 py-1 rounded-lg">{{ \Carbon\Carbon::parse($req['month_year'].'-01')->format('M Y') }}</span>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    @if($dAmt > 0) <span class="bg-emerald-50 text-emerald-700 font-extrabold text-[13px] px-2 py-1 rounded-lg border border-emerald-200">৳{{ number_format($dAmt, 0) }}</span>
                                    @else <span class="text-base-content/20 text-lg font-bold">—</span> @endif
                                </td>
                                <td class="py-3 px-3 text-center">
                                    @if($uAmt > 0) <span class="bg-red-50 text-red-700 font-extrabold text-[13px] px-2 py-1 rounded-lg border border-red-200">৳{{ number_format($uAmt, 0) }}</span>
                                    @else <span class="text-base-content/20 text-lg font-bold">—</span> @endif
                                </td>
                                <td class="py-3 px-3 text-center">
                                    @if($fAmt > 0) <span class="bg-orange-50 text-orange-700 font-extrabold text-[13px] px-2 py-1 rounded-lg border border-orange-200">৳{{ number_format($fAmt, 0) }}</span>
                                    @else <span class="text-base-content/20 text-lg font-bold">—</span> @endif
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <span class="font-extrabold text-[14px] text-base-content">৳{{ number_format($tot, 0) }}</span>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <div class="flex flex-col items-center gap-0.5">
                                        <span class="text-xs font-bold text-base-content">{{ $req['payment_method'] }}</span>
                                        @if($req['transaction_id']) <span class="font-mono text-[10px] text-base-content/40 bg-base-200 px-1.5 rounded">{{ Str::limit($req['transaction_id'], 12) }}</span> @endif
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    @if($req['screenshot'])
                                    <a href="{{ asset('storage/'.$req['screenshot']) }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-blue-600 hover:text-blue-800 font-bold bg-blue-50 px-2 py-1 rounded-lg border border-blue-200 hover:border-blue-400 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> View
                                    </a>
                                    @else <span class="text-base-content/20 text-xs">—</span> @endif
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <span class="inline-block {{ $statusBadge }} text-xs font-extrabold px-3 py-1.5 rounded-lg">{{ ucfirst($req['status']) }}</span>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    @if($isPending)
                                    <div class="flex flex-col gap-1.5 items-center">
                                        <button wire:click="viewDepositRequest({{ $req['id'] }})"
                                                class="btn btn-xs bg-blue-500 hover:bg-blue-600 text-white border-none font-bold gap-1 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            View
                                        </button>
                                        <button wire:click="markRequestDone({{ $req['id'] }})"
                                                wire:confirm="Mark this request as done? (No deposit changes will be made)"
                                                class="btn btn-xs bg-emerald-500 hover:bg-emerald-600 text-white border-none font-bold gap-1 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Done
                                        </button>
                                        <button wire:click="openRejectModal({{ $req['id'] }})"
                                                class="btn btn-xs bg-red-500 hover:bg-red-600 text-white border-none font-bold gap-1 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Reject
                                        </button>
                                    </div>
                                    @elseif($req['status'] === 'approved')
                                    <button wire:click="viewApprovedRequestDeposit({{ $req['id'] }})"
                                            class="btn btn-ghost btn-xs text-blue-600 hover:bg-blue-50 p-1.5 rounded-lg"
                                            title="View deposit status for this month">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                    @elseif($req['status'] === 'rejected' && !empty($req['admin_remark']))
                                    <button wire:click="openRejectReasonModal({{ $req['id'] }})"
                                            class="btn btn-ghost btn-xs text-red-600 hover:bg-red-50 p-1.5 rounded-lg"
                                            title="View rejection reason">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </button>
                                    @else
                                    <span class="text-base-content/20 text-xs">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="md:hidden space-y-3">
                    @foreach($depositRequests as $req)
                    @php
                        $dAmt = (float)($req['deposit_amount'] ?? 0);
                        $uAmt = (float)($req['due_amount']     ?? 0);
                        $fAmt = (float)($req['fine_amount']    ?? 0);
                        $tot  = $dAmt + $uAmt + $fAmt ?: (float)($req['amount'] ?? 0);
                        $cardBg = match($req['status']) { 'pending'=>'border-amber-200 bg-amber-50/50','approved'=>'border-emerald-200 bg-emerald-50/30','rejected'=>'border-red-200 bg-red-50/30',default=>'border-base-300 bg-base-100' };
                    @endphp
                    <div class="rounded-2xl border {{ $cardBg }} shadow-sm overflow-hidden">
                        <div class="px-4 py-3 flex items-center justify-between border-b border-base-200">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-full bg-amber-100 border border-amber-200 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    @if(!empty($req['member']['photo']))
                                        <img src="{{ asset('storage/' . $req['member']['photo']) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        <span class="text-[12px] font-extrabold text-amber-700">{{ strtoupper(substr($req['member']['name_english'] ?? 'M', 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-[13px] font-bold text-base-content">{{ $req['member']['name_english'] ?? '—' }}</p>
                                    <p class="text-[10px] text-base-content/50">
                                        <span class="font-semibold">#Acc:</span> {{ $req['member']['account_no'] ?? '—' }}
                                        · <span class="font-semibold">Share:</span> {{ $req['member']['shares'] ?? '—' }}
                                    </p>
                                    <p class="text-[10px] text-base-content/40">
                                        <span class="font-semibold">Datetime:</span> {{ \Carbon\Carbon::parse($req['created_at'])->format('d M Y, h:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-indigo-100 text-indigo-700 text-[10px] font-extrabold px-2 py-0.5 rounded-lg">{{ \Carbon\Carbon::parse($req['month_year'].'-01')->format('M Y') }}</span>
                                <span class="inline-block {{ match($req['status']) { 
                                    'pending' => 'bg-amber-100 text-amber-800 border border-amber-300',
                                    'approved' => 'bg-emerald-100 text-emerald-800 border border-emerald-300',
                                    'rejected' => 'bg-red-100 text-red-800 border border-red-300',
                                    default => 'badge-ghost' 
                                } }} text-xs font-extrabold px-3 py-1 rounded-lg">{{ ucfirst($req['status']) }}</span>
                            </div>
                        </div>
                        <div class="px-4 py-3 flex flex-wrap gap-2">
                            @if($dAmt > 0)<div class="flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 rounded-xl px-3 py-1.5"><span class="text-sm">💰</span><div><p class="text-[9px] text-emerald-600 font-bold">Deposit</p><p class="text-[13px] font-extrabold text-emerald-700">৳{{ number_format($dAmt, 0) }}</p></div></div>@endif
                            @if($uAmt > 0)<div class="flex items-center gap-1.5 bg-red-50 border border-red-200 rounded-xl px-3 py-1.5"><span class="text-sm">📋</span><div><p class="text-[9px] text-red-600 font-bold">Due</p><p class="text-[13px] font-extrabold text-red-700">৳{{ number_format($uAmt, 0) }}</p></div></div>@endif
                            @if($fAmt > 0)<div class="flex items-center gap-1.5 bg-orange-50 border border-orange-200 rounded-xl px-3 py-1.5"><span class="text-sm">⚠️</span><div><p class="text-[9px] text-orange-600 font-bold">Fine</p><p class="text-[13px] font-extrabold text-orange-700">৳{{ number_format($fAmt, 0) }}</p></div></div>@endif
                            <div class="ml-auto flex items-center"><div class="text-right"><p class="text-[9px] text-base-content/40 font-bold">TOTAL</p><p class="text-[16px] font-extrabold text-base-content">৳{{ number_format($tot, 0) }}</p></div></div>
                        </div>
                        <div class="px-4 py-2 bg-base-200/50 flex items-center justify-between border-t border-base-200">
                            <p class="text-[10px] text-base-content/40">{{ $req['payment_method'] }}@if($req['transaction_id']) · {{ Str::limit($req['transaction_id'], 14) }}@endif</p>
                            @if($req['screenshot'])<a href="{{ asset('storage/'.$req['screenshot']) }}" target="_blank" class="text-[10px] text-blue-600 font-bold">📎 Proof</a>@endif
                        </div>
                        @if($req['status'] === 'pending')
                        <div class="px-4 py-3 flex gap-2 border-t border-base-200">
                            <button wire:click="viewDepositRequest({{ $req['id'] }})" 
                                    class="flex-1 btn btn-sm bg-blue-500 hover:bg-blue-600 text-white border-none font-bold gap-1.5 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                View
                            </button>
                            <button wire:click="markRequestDone({{ $req['id'] }})"
                                    wire:confirm="Mark as done?"
                                    class="flex-1 btn btn-sm bg-emerald-500 hover:bg-emerald-600 text-white border-none font-bold gap-1.5 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                Done
                            </button>
                            <button wire:click="openRejectModal({{ $req['id'] }})" 
                                    class="flex-1 btn btn-sm bg-red-500 hover:bg-red-600 text-white border-none font-bold gap-1.5 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                Reject
                            </button>
                        </div>
                        @elseif($req['status'] === 'approved')
                        <div class="px-4 py-3 flex justify-end border-t border-base-200">
                            <button wire:click="viewApprovedRequestDeposit({{ $req['id'] }})"
                                    class="btn btn-sm bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 font-bold gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                View Deposit
                            </button>
                        </div>
                        @elseif($req['status'] === 'rejected' && !empty($req['admin_remark']))
                        <div class="px-4 py-3 flex justify-end border-t border-base-200">
                            <button wire:click="openRejectReasonModal({{ $req['id'] }})"
                                    class="btn btn-sm bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 font-bold gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Rejection Reason
                            </button>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Approve modal removed — replaced by viewDepositRequest + markRequestDone -->

                <!-- ===== Reject Modal ===== -->
                @if($rejectRequestModal)
                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                    <div class="bg-base-100 rounded-2xl shadow-2xl w-full max-w-sm border border-base-300">
                        <div class="bg-red-500 px-6 py-4 rounded-t-2xl flex items-center justify-between">
                            <h3 class="text-white font-extrabold text-lg">⛔ Reject Request</h3>
                            <button wire:click="closeRejectModal" class="text-white/70 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="text-xs font-bold text-base-content/60 uppercase tracking-wide block mb-1.5">Reason for rejection <span class="text-red-500">*</span></label>
                                <textarea wire:model="rejectRemark" rows="3"
                                          placeholder="Explain why you are rejecting this request..."
                                          class="textarea textarea-bordered w-full text-sm focus:outline-none focus:ring-2 focus:ring-red-400"></textarea>
                                @error('rejectRemark') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="flex gap-3">
                                <button wire:click="closeRejectModal" class="flex-1 btn btn-ghost border border-base-300">Cancel</button>
                                <button wire:click="confirmReject" wire:loading.attr="disabled" class="flex-1 btn btn-error text-white font-bold">
                                    <span wire:loading.remove wire:target="confirmReject">⛔ Confirm Reject</span>
                                    <span wire:loading wire:target="confirmReject">Processing...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- ===== View Reject Reason Modal ===== -->
                @if($showRejectReasonModal)
                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                    <div class="bg-base-100 rounded-2xl shadow-2xl w-full max-w-sm border border-base-300">
                        <div class="bg-red-500 px-6 py-4 rounded-t-2xl flex items-center justify-between">
                            <h3 class="text-white font-extrabold text-lg">⛔ Rejection Reason</h3>
                            <button wire:click="closeRejectReasonModal" class="text-white/70 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-base-content/80 leading-relaxed whitespace-pre-wrap">{{ $viewingRejectRemark }}</p>
                            <button wire:click="closeRejectReasonModal" class="btn btn-ghost border border-base-300 w-full mt-5 font-bold">Close</button>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            @endif
        </div>

    </div>

    <!-- ====================================================================== -->
    <!-- ===== ADD DEPOSIT POPUP (Main Modal) ===== -->
    <!-- ====================================================================== -->
    @if($addDepositModal)
    <div class="fixed inset-0 bg-black/60 flex items-start sm:items-center justify-center z-50 p-2 sm:p-4 overflow-y-auto" wire:click="closeAddDepositModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl w-full max-w-screen-2xl relative my-4 sm:my-0 max-h-[90vh] overflow-y-auto" wire:click.stop>
            
            <!-- Popup Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-5 sm:p-6 rounded-t-2xl text-white sticky top-0 z-10">
                <button wire:click="closeAddDepositModal" class="absolute top-4 right-4 text-white/70 hover:text-white z-10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <h2 class="text-xl sm:text-2xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                        Deposit Collection
                    </h2>

                </div>
            </div>

            <!-- Popup Body Content -->
            <div class="p-4 sm:p-6">

                {{-- ── Member Request Reminder Banner ── --}}
                @if($activeRequestInfo)
                <div class="mb-4 bg-amber-50 border-2 border-amber-300 rounded-2xl overflow-hidden shadow-sm">
                    <div class="bg-amber-400 px-4 py-2 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            <span class="text-white text-xs font-extrabold uppercase tracking-wide">Member Request — Add manually then mark done</span>
                        </div>
                        <button wire:click="$set('activeRequestInfo', null)" class="text-white/70 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="px-4 py-3 flex flex-wrap items-center gap-3">
                        {{-- Member + Month --}}
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-full bg-amber-200 flex items-center justify-center flex-shrink-0 border-2 border-amber-300">
                                <span class="text-[12px] font-extrabold text-amber-800">{{ strtoupper(substr($activeRequestInfo['member_name'], 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="text-[13px] font-extrabold text-gray-800">{{ $activeRequestInfo['member_name'] }}</p>
                                <p class="text-[10px] text-gray-500">#{{ $activeRequestInfo['account_no'] }} · {{ $activeRequestInfo['month_label'] }}</p>
                            </div>
                        </div>

                        <div class="h-8 w-px bg-amber-200 hidden sm:block"></div>

                        {{-- Amount breakdown --}}
                        @if($activeRequestInfo['deposit_amount'] > 0)
                        <div class="flex items-center gap-1.5 bg-emerald-100 rounded-xl px-3 py-1.5 border border-emerald-200">
                            <span>💰</span>
                            <div><p class="text-[9px] text-emerald-600 font-bold">Deposit</p><p class="text-[13px] font-extrabold text-emerald-700">৳{{ number_format($activeRequestInfo['deposit_amount'], 0) }}</p></div>
                        </div>
                        @endif
                        @if($activeRequestInfo['due_amount'] > 0)
                        <div class="flex items-center gap-1.5 bg-red-100 rounded-xl px-3 py-1.5 border border-red-200">
                            <span>📋</span>
                            <div><p class="text-[9px] text-red-600 font-bold">Due</p><p class="text-[13px] font-extrabold text-red-700">৳{{ number_format($activeRequestInfo['due_amount'], 0) }}</p></div>
                        </div>
                        @endif
                        @if($activeRequestInfo['fine_amount'] > 0)
                        <div class="flex items-center gap-1.5 bg-orange-100 rounded-xl px-3 py-1.5 border border-orange-200">
                            <span>⚠️</span>
                            <div><p class="text-[9px] text-orange-600 font-bold">Fine</p><p class="text-[13px] font-extrabold text-orange-700">৳{{ number_format($activeRequestInfo['fine_amount'], 0) }}</p></div>
                        </div>
                        @endif

                        {{-- Method + TxnID --}}
                        <div class="ml-auto text-right">
                            <p class="text-[11px] font-bold text-gray-600">{{ $activeRequestInfo['payment_method'] }}</p>
                            @if($activeRequestInfo['transaction_id'])
                            <p class="text-[10px] font-mono text-gray-400">{{ $activeRequestInfo['transaction_id'] }}</p>
                            @endif
                            @if($activeRequestInfo['screenshot'])
                            <a href="{{ asset('storage/'.$activeRequestInfo['screenshot']) }}" target="_blank" class="text-[10px] text-blue-600 font-bold hover:underline">📎 View Proof</a>
                            @endif
                        </div>
                    </div>
                    @if($activeRequestInfo['note'])
                    <div class="px-4 pb-2.5 text-[11px] text-gray-500 italic">Note: {{ $activeRequestInfo['note'] }}</div>
                    @endif
                    {{-- Mark done button --}}
                    <div class="px-4 pb-3">
                        <button wire:click="markRequestDone({{ $activeRequestInfo['id'] }})"
                                wire:confirm="Have you added the deposit manually? Mark this request as done?"
                                class="btn btn-sm btn-success text-white font-bold gap-2 w-full sm:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Mark Request as Done
                        </button>
                    </div>
                </div>
                @endif

                <!-- ✅ Success Message -->
                @if (session()->has('message'))
                    <div class="bg-green-500/10 border border-green-500/30 text-green-600 px-4 py-3 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                <!-- ✅ 6 Stat Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-3 mb-5">
                    <div class="bg-blue-500/10 p-3 rounded-xl border border-blue-500/20 flex items-center gap-3">
                        <div class="bg-blue-100 p-2 rounded-full text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg></div>
                        <div><p class="text-[10px] text-blue-500 font-bold uppercase">Total Member</p><p class="text-lg font-bold text-blue-700">{{ $totalMembers }}</p></div>
                    </div>
                    <div class="bg-green-500/10 p-3 rounded-xl border border-green-500/20 flex items-center gap-3">
                        <div class="bg-green-100 p-2 rounded-full text-green-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                        <div><p class="text-[10px] text-green-500 font-bold uppercase">Paid Member</p><p class="text-lg font-bold text-green-700">{{ $paidMembers }}</p></div>
                    </div>
                    <div class="bg-red-500/10 p-3 rounded-xl border border-red-500/20 flex items-center gap-3">
                        <div class="bg-red-100 p-2 rounded-full text-red-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                        <div><p class="text-[10px] text-red-500 font-bold uppercase">Due Member</p><p class="text-lg font-bold text-red-700">{{ $unpaidMembers }}</p></div>
                    </div>
                    <div class="bg-purple-500/10 p-3 rounded-xl border border-purple-500/20 flex items-center gap-3">
                        <div class="bg-purple-100 p-2 rounded-full text-purple-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                        <div><p class="text-[10px] text-purple-500 font-bold uppercase">Total Collection</p><p class="text-lg font-bold text-purple-700">৳{{ number_format($totalCollection, 0) }}</p></div>
                    </div>
                    <div class="bg-orange-500/10 p-3 rounded-xl border border-orange-500/20 flex items-center gap-3">
                        <div class="bg-orange-100 p-2 rounded-full text-orange-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg></div>
                        <div><p class="text-[10px] text-orange-500 font-bold uppercase">Due Collection</p><p class="text-lg font-bold text-orange-700">৳{{ number_format($totalDueCollection, 0) }}</p></div>
                    </div>
                    <div class="bg-amber-500/10 p-3 rounded-xl border border-amber-500/20 flex items-center gap-3">
                        <div class="bg-amber-100 p-2 rounded-full text-amber-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg></div>
                        <div><p class="text-[10px] text-amber-500 font-bold uppercase">Total Fine</p><p class="text-lg font-bold text-amber-700">৳{{ number_format($totalFine, 0) }}</p></div>
                    </div>
                </div>

                <!-- ===== Member Collection Card ===== -->
                <div class="bg-base-100 rounded-xl border border-base-300 shadow-sm overflow-hidden">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 bg-green-500/10 p-3 border-b border-green-500/20">
                        <div class="flex items-center gap-2 text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <label class="text-sm font-bold">Member Collection:</label>
                        </div>
                        <select wire:model.live="selectedMonth" class="select select-bordered select-sm w-full sm:w-64 shadow-sm bg-base-100 focus:border-green-400">
                            @foreach ($months as $month)
                                <option value="{{ $month }}" class="text-base-content">{{ $month }}</option>
                            @endforeach
                        </select>
                        <div class="sm:ml-auto bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-xs sm:text-sm font-bold shadow-sm border border-green-300 hidden sm:block">
                            {{ $selectedMonth }} Month
                        </div>
                    </div>
                    
                    <!-- ✅ স্ক্রল সিস্টেম: max-h-[60vh] দিয়ে মেম্বার লিস্টের উচ্চতা নির্দিষ্ট করা হয়েছে -->
                    <div class="p-2 sm:p-4 max-h-[60vh] overflow-y-auto overflow-x-hidden">
                        
                        <!-- ===== DESKTOP VIEW ===== -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="table w-full text-sm rounded-t-xl overflow-hidden">
                                <thead>
                                    <tr class="bg-green-600 text-white uppercase text-xs">
                                        <th class="py-3 px-3 text-center">Acc#</th>
                                        <th class="py-3 px-3 text-left">Name</th>
                                        <th class="py-3 px-3 text-center">Share</th>
                                        <th class="py-3 px-3 text-center">Deposit</th>
                                        <th class="py-3 px-3 text-center">Due</th>
                                        <th class="py-3 px-3 text-center">Fine(5%)</th>
                                        <th class="py-3 px-3 text-center">Other Pay</th>
                                        <th class="py-3 px-3 text-center">Pay Method</th>
                                        <th class="py-3 px-3 text-center">By</th>
                                        <th class="py-3 px-3 text-center">Comment</th>
                                        <th class="py-3 px-3 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($deposits as $deposit)
                                    @php $isPaidLate = $deposit->status === 'paid' && $deposit->updated_at->gt(\Carbon\Carbon::parse($deposit->month_year . '-01')->endOfMonth()); @endphp
                                    <tr id="desktop-row-{{ $deposit->member->id }}" class="border-b border-base-200 transition-all duration-300 {{ $deposit->status === 'draft' ? (($isLatePeriod || $isPastDuePeriod) ? 'bg-red-500/10 hover:bg-red-500/20' : 'hover:bg-base-200/50') : ($isPaidLate ? 'bg-orange-500/10 hover:bg-orange-500/20' : 'bg-green-500/10 hover:bg-green-500/20') }}">
                                        <td class="py-3 px-3 text-center font-bold text-green-600">{{ $deposit->member->account_no ?? 'N/A' }}</td>
                                        <td class="py-3 px-3 text-left text-base-content font-medium">{{ $deposit->member->name_english ?? 'N/A' }}</td>
                                        <td class="py-3 px-3 text-center"><span class="badge badge-ghost badge-sm">{{ $deposit->member->shares ?? 0 }}</span></td>
                                        
                                        <!-- ✅ Deposit Column -->
                                        <td class="py-3 px-3 text-center">
                                            @php $defaultDeposit = $deposit->member->shares * 10000; @endphp
                                            @if($deposit->status === 'draft')
                                                @if($editingDraftDepositId == $deposit->id)
                                                    <div class="flex items-center gap-1 justify-center">
                                                        <input type="number" wire:model="editingDraftDepositValue" class="input input-bordered input-xs w-20 text-center {{ $editingDraftDepositValue != $defaultDeposit ? 'input-error text-red-600 font-bold' : 'input-success text-green-600 font-bold' }}" />
                                                        <button wire:click="saveDraftDepositAmount({{ $deposit->id }})" class="btn btn-success btn-xs btn-circle" title="Save">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                        </button>
                                                        <button wire:click="cancelDraftDepositAmount" class="btn btn-ghost btn-xs btn-circle text-base-content/60" title="Cancel">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="flex items-center gap-1 justify-center">
                                                        <span class="{{ $deposit->deposit_amount != $defaultDeposit ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">৳{{ number_format($deposit->deposit_amount, 0) }}</span>
                                                        <button wire:click="editDraftDepositAmount({{ $deposit->id }}, {{ $deposit->deposit_amount }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 hover:text-blue-700" title="Change Deposit Amount">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                                        </button>
                                                    </div>
                                                @endif
                                            @else
                                                <span class="{{ $deposit->deposit_amount != $defaultDeposit ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">৳{{ number_format($deposit->deposit_amount, 0) }}</span>
                                            @endif
                                        </td>
                                        
                                        <!-- ✅ Due Column -->
                                        <td class="py-3 px-3 text-center">
                                            @if($deposit->status === 'draft')
                                                <input type="number" wire:change="updateDueAmount({{ $deposit->id }}, $event.target.value)" value="{{ $deposit->due_amount }}" class="input input-bordered input-xs w-20 text-center {{ $deposit->due_amount > 0 ? 'input-error text-red-600 font-bold' : '' }}" />
                                            @else
                                                <span class="{{ $deposit->due_amount > 0 ? 'text-red-600 font-bold' : 'text-base-content/60' }}">৳{{ number_format($deposit->due_amount, 0) }}</span>
                                            @endif
                                        </td>

                                        <!-- ✅ Fine Column (No Edit Button) -->
                                        <td class="py-3 px-3 text-center">
                                            @if($deposit->status === 'draft')
                                                <input type="number" wire:change="updateFineAmount({{ $deposit->id }}, $event.target.value)" value="{{ $deposit->fine_amount }}" class="input input-bordered input-xs w-20 text-center {{ ($isPastDuePeriod && $deposit->status === 'draft') ? 'border-2 border-red-500 bg-white' : ($deposit->fine_amount > 0 ? 'input-warning text-orange-600 font-bold' : '') }}" />
                                            @else
                                                <span class="{{ $deposit->fine_amount > 0 ? 'text-orange-600 font-bold' : 'text-base-content/60' }}">৳{{ number_format($deposit->fine_amount, 0) }}</span>
                                            @endif
                                        </td>

                                        <!-- ✅ Other Pay Column -->
                                        <td class="py-3 px-3 text-center">
                                            @if($deposit->status === 'draft')
                                                @if($editingOtherPaymentId == $deposit->id)
                                                    <div class="flex items-center gap-1 justify-center">
                                                        <input type="number" wire:model="editingOtherPaymentValue" class="input input-bordered input-xs w-20 text-center {{ $editingOtherPaymentValue > 0 ? 'input-error text-purple-600 font-bold' : '' }}" />
                                                        <button wire:click="saveOtherPayment({{ $deposit->id }})" class="btn btn-success btn-xs btn-circle" title="Save">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                        </button>
                                                        <button wire:click="cancelOtherPayment" class="btn btn-ghost btn-xs btn-circle text-base-content/60" title="Cancel">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="flex items-center gap-1 justify-center">
                                                        <span class="{{ $deposit->other_payment > 0 ? 'text-purple-600 font-bold' : 'text-base-content/60' }}">৳{{ number_format($deposit->other_payment, 0) }}</span>
                                                        <button wire:click="editOtherPayment({{ $deposit->id }}, {{ $deposit->other_payment }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 hover:text-blue-700" title="Change Other Payment">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                                        </button>
                                                    </div>
                                                @endif
                                            @else
                                                <span class="{{ $deposit->other_payment > 0 ? 'text-purple-600 font-bold' : 'text-base-content/60' }}">৳{{ number_format($deposit->other_payment, 0) }}</span>
                                            @endif
                                        </td>

                                        <!-- ✅ Payment Method Column -->
                                        <td class="py-3 px-3 text-center">
                                            @if($deposit->status === 'draft')
                                                <select wire:change="updatePaymentMethod({{ $deposit->id }}, $event.target.value)" class="select select-bordered select-xs">
                                                    @foreach($paymentOptions as $option)
                                                        <option value="{{ $option['value'] }}" {{ $deposit->payment_method == $option['value'] ? 'selected' : '' }}>{{ $option['label'] }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <span class="badge badge-sm badge-ghost">
                                                    {{ $deposit->payment_method }}
                                                </span>
                                            @endif
                                        </td>

                                        <!-- ✅ Paid By Column -->
                                        <td class="py-3 px-3 text-center"><span class="text-xs text-base-content/60 bg-base-200 px-2 py-1 rounded">{{ $deposit->paid_by_info }}</span></td>
                                        
                                        <!-- ✅ Comment & History Icons Column -->
                                        <td class="py-3 px-3 text-center">
                                            <div class="flex items-center justify-center gap-1">
                                                @if($deposit->status === 'draft')
                                                    <button wire:click="openCommentModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 hover:text-blue-700" title="Comment">
                                                        @if($deposit->comment) 
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                                                        @else 
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                        @endif
                                                    </button>
                                                @else
                                                    @if($deposit->comment || $deposit->comment_history)
                                                        <button wire:click="openCommentModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-blue-400 hover:bg-blue-50 hover:text-blue-600" title="View Comment">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-ghost btn-xs text-gray-300 cursor-not-allowed" disabled>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                                        </button>
                                                    @endif
                                                @endif
                                                
                                                @if($deposit->edit_history)
                                                    <button wire:click="openEditHistoryModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-purple-500 hover:bg-purple-50 hover:text-purple-700" title="Edit History">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- ✅ Action Column -->
                                        <td class="py-3 px-3 text-center">
                                            @if($deposit->status === 'draft')
                                                @if($editingPaidId == $deposit->id)
                                                    <div class="flex items-center gap-1 justify-center">
                                                        <button wire:click="saveEditedPaid({{ $deposit->id }})" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs font-bold shadow transition-colors">Save</button>
                                                        <button wire:click="cancelEditedPaid({{ $deposit->id }})" class="bg-gray-300 hover:bg-gray-400 text-base-content px-2 py-1 rounded-lg text-xs font-bold transition-colors">X</button>
                                                    </div>
                                                @else
                                                    <button wire:click="showPayConfirmModal({{ $deposit->id }})" class="{{ ($isPastDuePeriod && $deposit->status === 'draft') ? 'bg-red-600 hover:bg-red-700 animate-pulse' : (($isLatePeriod && $deposit->status === 'draft') ? 'bg-amber-500 hover:bg-amber-600' : 'bg-green-600 hover:bg-green-700') }} text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow transition-colors">Pay</button>
                                                @endif
                                            @else
                                                <div class="flex items-center gap-1 justify-center">
                                                    <button wire:click="openReceiptModal({{ $deposit->id }})" class="btn btn-xs btn-ghost text-green-600 hover:bg-green-500/10 gap-1 font-bold" title="Print Receipt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18.25 7.28H5.75" /></svg>
                                                        Print
                                                    </button>
                                                    
                                                    @if($deposit->deposit_amount > 0)
                                                    <button wire:click="showUnlockModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 hover:text-blue-700" title="Unlock/Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                                    </button>
                                                    <button wire:click="showDeleteModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50 hover:text-red-700" title="Clear Record">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                                    </button>
                                                    @else
                                                    <span class="text-xs text-red-400 font-semibold flex items-center gap-1" title="Auto-paid via due collection">🚩 Auto-paid</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="11" class="text-center py-8 text-base-content/40">No records found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- ===== MOBILE VIEW ===== -->
                        <div class="md:hidden space-y-4 mt-2">
                            
                            <div class="mb-4">
                                <select wire:model.live="selectedMemberId" class="select select-bordered select-sm w-full bg-base-100 border-indigo-200 focus:border-indigo-500 shadow-sm">
                                    <option value="">👥 All Members</option>
                                    @foreach($allMembers as $m)
                                        <option value="{{ $m->id }}">#{{ $m->account_no }} - {{ $m->name_english }} ({{ $m->shares }} Share)</option>
                                    @endforeach
                                </select>
                            </div>

                            @forelse ($deposits as $deposit)
                            @php $isPaidLateMob = $deposit->status === 'paid' && $deposit->updated_at->gt(\Carbon\Carbon::parse($deposit->month_year . '-01')->endOfMonth()); @endphp
                            <div id="mobile-row-{{ $deposit->member->id }}" class="bg-base-100 rounded-xl shadow-md border {{ $deposit->status === 'draft' ? (($isLatePeriod || $isPastDuePeriod) ? 'border-red-300 bg-red-500/10' : 'border-base-200 hover:shadow-lg') : ($isPaidLateMob ? 'border-orange-300 bg-orange-500/10 hover:shadow-lg' : 'border-green-300 bg-green-500/10 hover:shadow-lg') }} overflow-hidden flex flex-col transition-all duration-300 group">
                                
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-3 text-white flex justify-between items-center">
                                    <div>
                                        <span class="font-bold text-lg">#{{ $deposit->member->account_no ?? 'N/A' }}</span>
                                        <h4 class="font-semibold text-sm leading-tight truncate">{{ $deposit->member->name_english ?? 'N/A' }}</h4>
                                    </div>
                                    <span class="bg-base-100/20 px-2 py-1 rounded text-xs font-bold backdrop-blur-sm">{{ $deposit->member->shares ?? 0 }} Share</span>
                                </div>

                                <!-- ✅ 2x2 Grid for Amounts -->
                                <div class="p-4 grid grid-cols-2 gap-3 text-center border-b border-base-200">
                                    
                                    <!-- Deposit Column Mobile -->
                                    <div>
                                        @php $defaultDeposit = $deposit->member->shares * 10000; @endphp
                                        <p class="text-[10px] text-base-content/40 uppercase font-bold tracking-wider">Deposit</p>
                                        @if($deposit->status === 'draft')
                                            @if($editingDraftDepositId == $deposit->id)
                                                <div class="flex flex-col items-center gap-1 mt-1">
                                                    <input type="number" wire:model="editingDraftDepositValue" class="input input-bordered input-xs w-full text-center {{ $editingDraftDepositValue != $defaultDeposit ? 'input-error text-red-600 font-bold' : 'input-success text-green-600 font-bold' }}" />
                                                    <div class="flex gap-1">
                                                        <button wire:click="saveDraftDepositAmount({{ $deposit->id }})" class="btn btn-success btn-xs btn-circle" title="Save">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                        </button>
                                                        <button wire:click="cancelDraftDepositAmount" class="btn btn-ghost btn-xs btn-circle text-base-content/60" title="Cancel">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-1 justify-center mt-1">
                                                    <span class="text-sm font-bold {{ $deposit->deposit_amount != $defaultDeposit ? 'text-red-500' : 'text-green-500' }}">৳{{ number_format($deposit->deposit_amount, 0) }}</span>
                                                    <button wire:click="editDraftDepositAmount({{ $deposit->id }}, {{ $deposit->deposit_amount }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 p-0.5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                                    </button>
                                                </div>
                                            @endif
                                        @else
                                            <p class="text-sm font-bold mt-1 {{ $deposit->deposit_amount != $defaultDeposit ? 'text-red-500' : 'text-green-500' }}">৳{{ number_format($deposit->deposit_amount, 0) }}</p>
                                        @endif
                                    </div>

                                    <!-- Due Column Mobile -->
                                    <div>
                                        <p class="text-[10px] text-base-content/40 uppercase font-bold tracking-wider">Due</p>
                                        @if($deposit->status === 'draft')
                                            <input type="number" wire:change="updateDueAmount({{ $deposit->id }}, $event.target.value)" value="{{ $deposit->due_amount }}" class="input input-bordered input-xs w-full text-center mt-1 {{ $deposit->due_amount > 0 ? 'input-error' : '' }}" />
                                        @else
                                            <p class="text-sm font-bold mt-1 {{ $deposit->due_amount > 0 ? 'text-red-500' : 'text-base-content/60' }}">৳{{ number_format($deposit->due_amount, 0) }}</p>
                                        @endif
                                    </div>

                                    <!-- ✅ Fine Column Mobile (No Edit Button) -->
                                    <div>
                                        <p class="text-[10px] text-base-content/40 uppercase font-bold tracking-wider">Fine(5%)</p>
                                        @if($deposit->status === 'draft')
                                            <input type="number" wire:change="updateFineAmount({{ $deposit->id }}, $event.target.value)" value="{{ $deposit->fine_amount }}" class="input input-bordered input-xs w-full text-center mt-1 {{ ($isPastDuePeriod && $deposit->status === 'draft') ? 'border-2 border-red-500 bg-white' : ($deposit->fine_amount > 0 ? 'input-warning' : '') }}" />
                                        @else
                                            <p class="text-sm font-bold mt-1 {{ $deposit->fine_amount > 0 ? 'text-orange-500' : 'text-base-content/60' }}">৳{{ number_format($deposit->fine_amount, 0) }}</p>
                                        @endif
                                    </div>

                                    <!-- ✅ Other Pay Column Mobile -->
                                    <div>
                                        <p class="text-[10px] text-base-content/40 uppercase font-bold tracking-wider">Other Pay</p>
                                        @if($deposit->status === 'draft')
                                            @if($editingOtherPaymentId == $deposit->id)
                                                <div class="flex flex-col items-center gap-1 mt-1">
                                                    <input type="number" wire:model="editingOtherPaymentValue" class="input input-bordered input-xs w-full text-center {{ $editingOtherPaymentValue > 0 ? 'input-error text-purple-600 font-bold' : '' }}" />
                                                    <div class="flex gap-1">
                                                        <button wire:click="saveOtherPayment({{ $deposit->id }})" class="btn btn-success btn-xs btn-circle" title="Save">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                        </button>
                                                        <button wire:click="cancelOtherPayment" class="btn btn-ghost btn-xs btn-circle text-base-content/60" title="Cancel">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-1 justify-center mt-1">
                                                    <span class="text-sm font-bold {{ $deposit->other_payment > 0 ? 'text-purple-600' : 'text-base-content/60' }}">৳{{ number_format($deposit->other_payment, 0) }}</span>
                                                    <button wire:click="editOtherPayment({{ $deposit->id }}, {{ $deposit->other_payment }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 p-0.5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                                    </button>
                                                </div>
                                            @endif
                                        @else
                                            <p class="text-sm font-bold mt-1 {{ $deposit->other_payment > 0 ? 'text-purple-600' : 'text-base-content/60' }}">৳{{ number_format($deposit->other_payment, 0) }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- ✅ PRO Mobile Action & Icons -->
                                <div class="p-3 flex justify-between items-center mt-auto bg-base-200/50">
                                    <div class="flex items-center gap-1 text-xs">
                                        @if($deposit->status === 'draft')
                                            <select wire:change="updatePaymentMethod({{ $deposit->id }}, $event.target.value)" class="select select-bordered select-xs">
                                                @foreach($paymentOptions as $option)
                                                    <option value="{{ $option['value'] }}" {{ $deposit->payment_method == $option['value'] ? 'selected' : '' }}>{{ $option['label'] }}</option>
                                                @endforeach
                                            </select>
                                            <button wire:click="openCommentModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 p-1">
                                                @if($deposit->comment) 
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                                                @else 
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                @endif
                                            </button>
                                        @else
                                            <span class="bg-gray-200 text-base-content/80 px-2 py-0.5 rounded text-[10px] font-semibold">{{ $deposit->payment_method }}</span>
                                            @if($deposit->comment || $deposit->comment_history)
                                                <button wire:click="openCommentModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-blue-400 hover:bg-blue-50 p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                                                </button>
                                            @else
                                                <button class="btn btn-ghost btn-xs text-gray-300 cursor-not-allowed p-1" disabled>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                                </button>
                                            @endif
                                            @if($deposit->edit_history)
                                                <button wire:click="openEditHistoryModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-purple-500 hover:bg-purple-50 p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                    
                                    <div>
                                        @if($deposit->status === 'draft')
                                            @if($editingPaidId == $deposit->id)
                                                <div class="flex items-center gap-1">
                                                    <button wire:click="saveEditedPaid({{ $deposit->id }})" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow transition-colors">Save</button>
                                                    <button wire:click="cancelEditedPaid({{ $deposit->id }})" class="bg-gray-300 hover:bg-gray-400 text-base-content px-2 py-1.5 rounded-lg text-xs font-bold transition-colors">X</button>
                                                </div>
                                            @else
                                                <button wire:click="showPayConfirmModal({{ $deposit->id }})" class="{{ ($isPastDuePeriod && $deposit->status === 'draft') ? 'bg-red-600 hover:bg-red-700 animate-pulse' : (($isLatePeriod && $deposit->status === 'draft') ? 'bg-amber-500 hover:bg-amber-600' : 'bg-green-600 hover:bg-green-700') }} text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow transition-colors">Pay</button>
                                            @endif
                                        @else
                                            <div class="flex items-center gap-1 justify-center">
                                                <button wire:click="openReceiptModal({{ $deposit->id }})" class="btn btn-xs btn-ghost text-green-600 hover:bg-green-500/10 gap-1 font-bold" title="Print Receipt">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18.25 7.28H5.75" /></svg>
                                                    Print
                                                </button>
                                                
                                                @if($deposit->deposit_amount > 0)
                                                <button wire:click="showUnlockModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 hover:text-blue-700" title="Unlock/Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                                </button>
                                                <button wire:click="showDeleteModal({{ $deposit->id }})" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50 hover:text-red-700" title="Clear Record">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                                </button>
                                                @else
                                                <span class="text-xs text-red-400 font-semibold flex items-center gap-1" title="Auto-paid via due collection">🚩 Auto-paid</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-12 text-base-content/40 p-4">No records found for this month.</div>
                            @endforelse
                        </div>

                    </div>
                </div> 

            </div> 
        </div> 
    </div> 
    @endif

    <!-- ===== Comment Popup ===== -->
    @if($commentModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-[60] p-4" wire:click="closeCommentModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full p-8 relative" wire:click.stop>
            <button wire:click="closeCommentModal" class="absolute top-4 right-4 text-base-content/40 hover:text-base-content/70 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            
            <h3 class="text-lg font-bold text-base-content mb-4">💬 Comment</h3>
            
            @if($isPaidComment)
                <div class="bg-base-200 border border-base-200 rounded-lg p-3 text-sm text-base-content/80 min-h-[80px]">
                    {{ $commentText ?: 'No comment provided.' }}
                </div>
            @else
                <textarea wire:model="commentText" rows="3" class="textarea textarea-bordered w-full mb-3 focus:border-indigo-400" placeholder="Write details here..."></textarea>
                <div class="flex gap-3 mb-4">
                    <button wire:click="closeCommentModal" class="flex-1 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200">Cancel</button>
                    <button wire:click="saveComment" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-xl shadow-md">💾 Save</button>
                </div>
            @endif

            @if($commentHistory)
            <div class="border-t pt-4 mt-2">
                <h4 class="text-xs font-bold text-base-content/60 uppercase mb-3 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Comment History
                </h4>
                <div class="space-y-3 max-h-[200px] overflow-y-auto pr-1">
                    @foreach($commentHistory as $index => $ch)
                    <!-- ✅ ডার্ক মোড ফিক্স -->
                    <div class="bg-blue-500/10 border-l-4 border-blue-400 p-3 rounded-r-lg shadow-sm group relative">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-xs font-bold text-blue-400">{{ $ch['user'] }}</span>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] text-base-content/60">{{ $ch['date'] }}</span>
                                
                                @if(!$isPaidComment && (auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin'))
                                <button wire:click="deleteCommentHistoryItem({{ $commentDepositId }}, {{ $index }})" wire:confirm="Delete this comment?" class="text-red-400 hover:text-red-600 transition-colors" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                                @endif
                                
                            </div>
                        </div>
                        <p class="text-sm text-base-content">{{ $ch['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
    @endif

    <!-- ===== Pay Confirmation Popup ===== -->
    @if($payDepositModal && $payDepositData)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[70] p-4" wire:click="closePayConfirmModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full p-8 relative text-center" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-indigo-500/10 mb-4">
                <svg class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="text-lg font-bold text-base-content mb-4">Confirm Payment</h3>
            
            <div class="bg-base-200 border border-base-200 rounded-xl p-4 mb-6 text-left space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-base-content/60">Month:</span> <span class="font-semibold text-base-content">{{ $selectedMonth }}</span></div>
                <div class="flex justify-between"><span class="text-base-content/60">Acc# / Name:</span> <span class="font-semibold text-base-content">#{{ $payDepositData->member->account_no }} - {{ $payDepositData->member->name_english }}</span></div>
                <div class="flex justify-between"><span class="text-base-content/60">Share:</span> <span class="font-semibold text-base-content">{{ $payDepositData->member->shares }}</span></div>
                <hr class="my-2 border-dashed border-base-300">
                <div class="flex justify-between"><span class="text-base-content/60">Deposit:</span> <span class="font-bold text-indigo-600">৳{{ number_format($payDepositData->deposit_amount, 0) }}</span></div>
                <div class="flex justify-between"><span class="text-base-content/60">Due:</span> <span class="font-bold {{ $payDepositData->due_amount > 0 ? 'text-red-500' : 'text-base-content' }}">৳{{ number_format($payDepositData->due_amount, 0) }}</span></div>
                <div class="flex justify-between"><span class="text-base-content/60">Fine:</span> <span class="font-bold {{ $payDepositData->fine_amount > 0 ? 'text-orange-500' : 'text-base-content' }}">৳{{ number_format($payDepositData->fine_amount, 0) }}</span></div>
                
                <!-- ✅ Other Pay Amount -->
                @if($payDepositData->other_payment > 0)
                <div class="flex justify-between"><span class="text-base-content/60">Other Pay:</span> <span class="font-bold text-purple-600">৳{{ number_format($payDepositData->other_payment, 0) }}</span></div>
                @endif
                
                <hr class="my-2 border-dashed border-base-300">
                <!-- ✅ Total Payable -->
                <div class="flex justify-between"><span class="text-base-content/60 font-bold">Total Payable:</span> <span class="font-extrabold text-green-600 text-lg">৳{{ number_format($payDepositData->deposit_amount + $payDepositData->due_amount + $payDepositData->fine_amount + $payDepositData->other_payment, 0) }}</span></div>
                
                @if($payDepositData->comment)
                <div class="mt-2 pt-2 border-t border-base-200">
                    <span class="text-base-content/60 text-xs block">Comment:</span>
                    <p class="text-base-content/80 text-xs mt-1 bg-base-100 p-2 rounded border border-base-300">{{ $payDepositData->comment }}</p>
                </div>
                @endif
            </div>

            @if(!empty($autoPayMonths))
            <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-4 mb-4 text-left">
                <p class="text-xs font-bold text-blue-600 uppercase mb-2 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Due এর মাসগুলো select করুন:
                </p>
                <div class="space-y-2">
                    @php $selectedTotal = collect($autoPayMonths)->whereIn('id', $selectedAutoPayMonths)->sum('amount'); $dueAmount = $payDepositData->due_amount ?? 0; @endphp
                    @foreach($autoPayMonths as $month)
                    @php $isChecked = in_array($month['id'], $selectedAutoPayMonths); $isDisabled = !$isChecked && $selectedTotal >= $dueAmount; @endphp
                    <label class="flex items-center justify-between gap-3 {{ $isDisabled ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer hover:bg-blue-50' }} bg-base-100 border border-base-300 rounded-lg px-3 py-2 transition-colors">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" wire:model.live="selectedAutoPayMonths" value="{{ $month['id'] }}" class="checkbox checkbox-sm checkbox-primary" {{ $isDisabled ? 'disabled' : '' }} />
                            <span class="text-sm font-medium text-base-content">{{ $month['month_label'] }}</span>
                        </div>
                        <span class="text-sm font-bold {{ $month['amount'] > 0 ? 'text-blue-600' : 'text-base-content/40' }}">৳{{ number_format($month['amount'], 0) }}</span>
                    </label>
                    @endforeach
                </div>
                @php
                    $selectedTotal = collect($autoPayMonths)->whereIn('id', $selectedAutoPayMonths)->sum('amount');
                    $dueAmount = $payDepositData->due_amount ?? 0;
                @endphp
                <div class="mt-3 pt-3 border-t border-blue-300/30 flex justify-between items-center text-sm">
                    <span class="text-base-content/60">Selected Total:</span>
                    <span class="font-extrabold {{ $selectedTotal == $dueAmount ? 'text-green-600' : 'text-orange-500' }}">৳{{ number_format($selectedTotal, 0) }}</span>
                </div>
                @if(!empty($selectedAutoPayMonths) && $selectedTotal != $dueAmount)
                <div class="mt-1 text-xs text-orange-500 font-semibold">
                    ⚠️ Selected total (৳{{ number_format($selectedTotal, 0) }}) আর due amount (৳{{ number_format($dueAmount, 0) }}) মিলছে না।
                </div>
                @endif
            </div>
            @endif

            <div class="flex gap-4">
                <button wire:click="closePayConfirmModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200 font-medium">Cancel</button>
                <button wire:click="confirmPay" class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-xl shadow-md">Yes, Pay</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Unlock Warning Popup ===== -->
    @if($unlockDepositModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[70] p-4" wire:click="closeUnlockModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-500/10 mb-4">
                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
            </div>
            <h3 class="text-lg font-bold text-base-content mb-2">⚠️ Unlock Deposit?</h3>
            <p class="text-sm text-base-content/60 mb-6">Are you sure you want to unlock this deposit for editing?</p>
            <div class="flex gap-4">
                <button wire:click="closeUnlockModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200">Cancel</button>
                <button wire:click="confirmUnlock" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-xl shadow-md">Yes, Unlock</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ✅ ===== Delete Warning Popup ===== -->
    @if($deleteDepositModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[70] p-4" wire:click="closeDeleteModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-500/10 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            </div>
            <h3 class="text-lg font-bold text-base-content mb-2">⚠️ Clear Record?</h3>
            <p class="text-sm text-base-content/60 mb-4">This will reset amounts and set status to draft.</p>
            
            @if(auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin')
            <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-3 mb-4 text-left space-y-2">
                <p class="text-xs font-bold text-red-500 uppercase mb-1">Superadmin Options:</p>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" wire:model="clear_comment" class="checkbox checkbox-sm checkbox-error" />
                    <span class="text-sm text-base-content/80">Clear Comments</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" wire:model="clear_history" class="checkbox checkbox-sm checkbox-error" />
                    <span class="text-sm text-base-content/80">Clear Audit History</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" wire:model="deleteOtherReasons" class="checkbox checkbox-sm checkbox-error" />
                    <span class="text-sm text-base-content/80">Clear Other Pay Reasons</span>
                </label>
            </div>
            @endif

            <div class="flex gap-4">
                <button wire:click="closeDeleteModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200 font-medium">Cancel</button>
                <button wire:click="confirmDelete" class="w-1/2 bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-xl shadow-md">Yes, Clear</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Auto-Pay Adjust Modal ===== -->
    @if($showAutoPayAdjustModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[95] p-4" wire:click="closeAutoPayAdjustModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-6 relative" wire:click.stop>
            
            <!-- Header -->
            <div class="flex items-center gap-3 mb-5">
                <div class="bg-indigo-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-base-content">Auto-Pay মাস নির্বাচন করুন</h3>
                    <p class="text-xs text-base-content/60">Due পরিবর্তন হয়েছে — কোন মাসগুলো paid রাখবেন সিলেক্ট করুন</p>
                </div>
            </div>

            <!-- New Due Amount Info -->
            @php
                $adjustSelectedTotal = collect($autoPayAdjustMonths)
                    ->whereIn('id', $selectedAdjustMonths)
                    ->sum('amount');
            @endphp
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 mb-4 flex justify-between items-center">
                <span class="text-sm font-bold text-indigo-700">নতুন Due Amount:</span>
                <span class="text-lg font-extrabold text-indigo-700">৳{{ number_format($adjustNewDue, 0) }}</span>
            </div>

            <!-- Month Checkboxes -->
            <div class="space-y-2 max-h-64 overflow-y-auto mb-4">
                @foreach($autoPayAdjustMonths as $month)
                @php
                    $isChecked = in_array($month['id'], $selectedAdjustMonths);
                    $wouldExceed = !$isChecked && ($adjustSelectedTotal + $month['amount']) > $adjustNewDue;
                @endphp
                <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all
                    {{ $isChecked ? 'bg-green-50 border-green-300' : ($wouldExceed ? 'bg-base-200/50 border-base-300 opacity-60' : 'bg-base-100 border-base-300 hover:bg-base-200/50') }}">
                    <input type="checkbox"
                        wire:model.live="selectedAdjustMonths"
                        value="{{ $month['id'] }}"
                        {{ $wouldExceed ? 'disabled' : '' }}
                        class="checkbox checkbox-sm {{ $isChecked ? 'checkbox-success' : 'checkbox-primary' }}" />
                    <div class="flex-1">
                        <span class="text-sm font-bold text-base-content">{{ $month['month_label'] }}</span>
                        @if($month['is_auto_paid'])
                            <span class="ml-2 text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded font-bold">Auto-paid</span>
                        @else
                            <span class="ml-2 text-[10px] bg-orange-100 text-orange-700 px-1.5 py-0.5 rounded font-bold">Unpaid</span>
                        @endif
                    </div>
                    <span class="text-sm font-bold {{ $isChecked ? 'text-green-600' : 'text-base-content/50' }}">৳{{ number_format($month['amount'], 0) }}</span>
                </label>
                @endforeach
            </div>

            <!-- Selected Total -->
            <div class="flex justify-between items-center p-3 rounded-xl mb-4
                {{ $adjustSelectedTotal > $adjustNewDue ? 'bg-red-50 border border-red-300' : ($adjustSelectedTotal == $adjustNewDue ? 'bg-green-50 border border-green-300' : 'bg-orange-50 border border-orange-300') }}">
                <span class="text-sm font-bold text-base-content/70">Selected Total:</span>
                <span class="text-lg font-extrabold {{ $adjustSelectedTotal > $adjustNewDue ? 'text-red-600' : ($adjustSelectedTotal == $adjustNewDue ? 'text-green-600' : 'text-orange-600') }}">
                    ৳{{ number_format($adjustSelectedTotal, 0) }}
                    @if($adjustSelectedTotal > $adjustNewDue)
                        <span class="text-xs ml-1">⚠️ Due ছাড়িয়ে গেছে!</span>
                    @elseif($adjustSelectedTotal == $adjustNewDue)
                        <span class="text-xs ml-1">✅ মিলেছে</span>
                    @else
                        <span class="text-xs ml-1 text-orange-500">(৳{{ number_format($adjustNewDue - $adjustSelectedTotal, 0) }} বাকি)</span>
                    @endif
                </span>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button wire:click="closeAutoPayAdjustModal" class="w-1/2 py-2.5 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200 font-medium text-sm">বাতিল করুন</button>
                <button wire:click="confirmAutoPayAdjust"
                    {{ $adjustSelectedTotal > $adjustNewDue ? 'disabled' : '' }}
                    class="w-1/2 py-2.5 rounded-xl text-white font-bold text-sm shadow-md transition-colors
                    {{ $adjustSelectedTotal > $adjustNewDue ? 'bg-gray-400 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700' }}">
                    নিশ্চিত করুন →
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Change Log Confirmation Popup ===== -->
    @if($showChangeLogModal && $changeLogData)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[90] p-4" wire:click="closeChangeLogModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-8 relative" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-yellow-500/10 mb-4">
                <svg class="h-7 w-7 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            
            <h3 class="text-lg font-bold text-base-content mb-2 text-center">⚠️ Changes Detected!</h3>
            <p class="text-sm text-base-content/60 mb-6 text-center">You have modified some values. Do you want to save these changes?</p>

            <div class="bg-base-200 border border-base-200 rounded-xl p-4 mb-6 space-y-3 text-sm">
                @foreach($changeLogData['old'] as $field => $oldValue)
                    @php $newValue = $changeLogData['new'][$field]; @endphp
                    @if($oldValue != $newValue)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-dashed border-base-300 pb-2 last:border-0 last:pb-0">
                        <span class="font-semibold text-base-content/80 w-40 capitalize">{{ str_replace('_', ' ', $field) }}</span>
                        <div class="flex items-center gap-2 mt-1 sm:mt-0">
                            <!-- ✅ ডার্ক মোড ফিক্স -->
                            <span class="bg-red-500/10 text-red-400 px-2 py-0.5 rounded text-xs line-through">{{ $oldValue }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                            <span class="bg-green-500/10 text-green-400 px-2 py-0.5 rounded text-xs font-bold">{{ $newValue }}</span>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            @if($depositAmountChanged)
            <!-- ✅ ডার্ক মোড ফিক্স -->
            <div class="bg-red-500/10 border-l-4 border-red-500 p-4 rounded-lg mb-4 text-sm text-red-400 shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    Deposit Amount Changed!
                </div>
                <p>This member's share is <strong>{{ $changeLogData['share'] }}</strong> and default deposit is <strong>৳{{ number_format($changeLogData['share'] * 10000, 0) }}</strong>. You are changing it to <strong>৳{{ number_format($changeLogData['new']['deposit_amount'], 0) }}</strong>. Please provide a reason below.</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-base-content/80 mb-1">Reason for changing deposit amount *</label>
                <textarea wire:model="changeLogComment" class="textarea textarea-bordered w-full focus:border-red-400 focus:ring-red-200" rows="3" placeholder="Write reason here..."></textarea>
                @error('changeLogComment') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            @endif

            <div class="flex gap-4">
                <button wire:click="closeChangeLogModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200 font-medium">Back to Edit</button>
                <button wire:click="confirmChangeLogSave" class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-xl shadow-md">Yes, Save</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ✅ ===== Draft Deposit Change Reason Popup ===== -->
    @if($showDraftChangeReasonModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[90] p-4" wire:click="closeDraftChangeReasonModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full p-8 relative text-center" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-yellow-500/10 mb-4">
                <svg class="h-7 w-7 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            
            <h3 class="text-lg font-bold text-base-content mb-2">⚠️ Deposit Amount Changed!</h3>
            <p class="text-sm text-base-content/60 mb-6">You are changing the default deposit amount. Please provide a reason below.</p>

            <div class="mb-4">
                <label class="block text-sm font-bold text-base-content/80 mb-1 text-left">Reason for changing amount *</label>
                <textarea wire:model="draftChangeReason" class="textarea textarea-bordered w-full focus:border-yellow-400" rows="3" placeholder="Write reason here..."></textarea>
                @error('draftChangeReason') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button wire:click="closeDraftChangeReasonModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200 font-medium">Cancel Edit</button>
                <button wire:click="confirmDraftChangeSave" class="w-1/2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 rounded-xl shadow-md">Yes, Save</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ✅ ===== Audit & Edit History Popup ===== -->
    @if($showEditHistoryModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[70] p-4" wire:click="closeEditHistoryModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-8 relative max-h-[85vh] overflow-y-auto" wire:click.stop>
            <button wire:click="closeEditHistoryModal" class="absolute top-4 right-4 text-base-content/40 hover:text-base-content/70 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            
            <h3 class="text-lg font-bold text-base-content mb-4 flex items-center gap-2">📜 Audit & Edit History</h3>
            
            @if($editHistoryData)
                <div class="space-y-4">
                    @foreach(array_reverse($editHistoryData) as $index => $log)
                    <div class="bg-base-200 border border-base-200 rounded-xl p-4 text-sm group relative">
                        
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-indigo-400 inline-flex items-center gap-1">
                                    @if(isset($log['is_superadmin']) && $log['is_superadmin'])
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 4L12 3l3.5 6L21 5l-2 11H5zm0 2h14v2H5v-2z"/></svg>
                                    @endif
                                    {{ $log['user'] }}
                                </span>
                                
                                @if(isset($log['action']))
                                    @if($log['action'] == 'Paid')
                                        <span class="badge badge-sm badge-success text-white">Paid</span>
                                    @elseif($log['action'] == 'Cleared')
                                        <span class="badge badge-sm badge-error text-white">Cleared</span>
                                    @elseif($log['action'] == 'Edited Draft')
                                        <span class="badge badge-sm badge-warning text-white">Edited Draft</span>
                                    @elseif($log['action'] == 'Edited')
                                        <span class="badge badge-sm badge-warning text-white">Edited</span>
                                    @endif
                                @else
                                    <span class="badge badge-sm badge-warning text-white">Edited</span>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] text-base-content/60">{{ $log['date'] }}</span>
                                
                                @if(auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin')
                                <button wire:click="deleteEditHistoryItem({{ $index }})" wire:confirm="Are you sure to delete this history log?" class="text-red-400 hover:text-red-600 transition-colors" title="Delete Log">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                                @endif
                            </div>
                        </div>

                        @if(isset($log['details']))
                            <p class="text-base-content/80 text-xs bg-base-100 p-2 rounded border border-base-200 shadow-sm">{{ $log['details'] }}</p>
                        @endif

                        @if(isset($log['old_values']))
                            <div class="space-y-2 mt-2">
                                @foreach($log['old_values'] as $field => $oldValue)
                                    @php 
                                        $newValue = $log['new_values'][$field] ?? ''; 
                                        $currencyFields = ['deposit_amount', 'due_amount', 'fine_amount', 'other_payment'];
                                        $isCurrency = in_array($field, $currencyFields);
                                        
                                        $displayOld = $isCurrency ? '৳' . number_format((float)$oldValue, 0) : $oldValue;
                                        $displayNew = $isCurrency ? '৳' . number_format((float)$newValue, 0) : $newValue;
                                    @endphp
                                    @if($oldValue != $newValue)
                                    <div class="flex justify-between items-center gap-2">
                                        <span class="capitalize text-base-content/70 text-xs font-semibold">{{ str_replace('_', ' ', $field) }}:</span>
                                        <div class="flex items-center gap-2">
                                            <span class="bg-red-500/10 text-red-400 px-2 py-0.5 rounded text-xs line-through border border-red-500/20">{{ $displayOld }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                            <span class="bg-green-500/10 text-green-400 px-2 py-0.5 rounded text-xs font-bold border border-green-500/20">{{ $displayNew }}</span>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if(isset($log['reason']))
                            <div class="mt-2 pt-2 border-t border-dashed border-base-300 text-xs text-yellow-400 bg-yellow-500/10 p-2 rounded">
                                <span class="font-bold">⚠️ Reason:</span> {{ $log['reason'] }}
                            </div>
                        @endif

                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-base-content/60 py-6">No history available.</p>
            @endif
        </div>
    </div>
    @endif


     <!-- ===== ✅ PAYMENT RECEIPT MODAL ===== -->
    @if($receiptModal && $receiptData)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[80] p-4" wire:click="closeReceiptModal">
        <div class="bg-white text-gray-800 rounded-2xl shadow-2xl max-w-md w-full relative max-h-[90vh] overflow-y-auto" wire:click.stop>
            
            <style>
                /* প্রিন্ট এবং PDF ডাউনলোডে এই সেকশনগুলো হাইড থাকবে */
                @media print {
                    .no-print-download { display: none !important; }
                }
            </style>

            <div id="receipt-capture-area" class="p-8">
                
                <!-- Logo & Success Message -->
                <div class="text-center mb-6 border-b border-dashed border-gray-300 pb-5">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 mx-auto mb-3"> 
                    <h3 class="text-xl font-bold text-emerald-600 flex items-center justify-center gap-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Payment Successful
                    </h3>
                </div>

                <!-- Member Information -->
                <div class="mb-4">
                    <h4 class="text-xs font-bold text-gray-500 uppercase mb-2 bg-gray-100 px-2 py-1 rounded flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Member Information
                    </h4>
                    <div class="space-y-1 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                Name:
                            </span> 
                            <span class="font-semibold text-gray-800">{{ $receiptData->member->name_english ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" /></svg>
                                Acc#:
                            </span> 
                            <span class="font-semibold text-gray-800">#{{ $receiptData->member->account_no ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                Mobile Number:
                            </span> 
                            <span class="font-semibold text-gray-800">{{ $receiptData->member->mobile ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="mb-4">
                    <h4 class="text-xs font-bold text-gray-500 uppercase mb-2 bg-gray-100 px-2 py-1 rounded flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        Payment Information
                    </h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                Payment Method:
                            </span> 
                            <span class="font-semibold text-gray-800 flex items-center gap-1.5">
                                @if($receiptData->payment_method == 'Cash')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                @elseif(in_array($receiptData->payment_method, ['Bkash', 'Nagad', 'Rocket']))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                @elseif($receiptData->payment_method == 'Bank')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                @endif
                                {{ $receiptData->payment_method }}
                            </span>
                        </div>
                        
                        <!-- ✅ Payment Received By তে Admin হলে Crown Icon -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                Payment Received By:
                            </span> 
                            <span class="font-semibold text-gray-800 inline-flex items-center gap-1">
                                @if(str_contains(strtolower($receiptData->paid_by_info), 'admin'))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 4L12 3l3.5 6L21 5l-2 11H5zm0 2h14v2H5v-2z"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                @endif
                                {{ $receiptData->paid_by_info }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                                Transaction ID:
                            </span> 
                            <span class="font-extrabold text-purple-700 tracking-wide text-xs">{{ $receiptData->transaction_id ?? 'N/A' }}</span>
                        </div>
                        
                        <hr class="my-2 border-dashed border-gray-200">
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Deposit:
                            </span> 
                            <span class="font-bold text-green-600">৳{{ number_format($receiptData->deposit_amount, 0) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Due:
                            </span> 
                            <span class="font-bold {{ $receiptData->due_amount > 0 ? 'text-red-600' : 'text-gray-800' }}">৳{{ number_format($receiptData->due_amount, 0) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                Fine:
                            </span> 
                            <span class="font-bold {{ $receiptData->fine_amount > 0 ? 'text-red-600' : 'text-gray-800' }}">৳{{ number_format($receiptData->fine_amount, 0) }}</span>
                        </div>
                        
                        <!-- ✅ Other Pay Icon পরিবর্তন করা হয়েছে (Purple Tag Icon) -->
                        @if($receiptData->other_payment > 0)
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" /></svg>
                                Others Pay:
                            </span> 
                            <span class="font-bold text-purple-600">৳{{ number_format($receiptData->other_payment, 0) }}</span>
                        </div>
                        @endif
                        
                        <div class="flex justify-between items-center mt-2 pt-2 border-t-2 border-dashed border-gray-300">
                            <span class="font-extrabold text-gray-800 text-base flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                Total Amount:
                            </span> 
                            <span class="font-extrabold text-green-600 text-xl">৳{{ number_format($receiptData->deposit_amount + $receiptData->due_amount + $receiptData->fine_amount + $receiptData->other_payment, 0) }}</span>
                        </div>
                    </div>
                </div>

                <!-- ✅ Other Pay Reason (Print & Download এ হাইড থাকবে) -->
                @if($receiptData->other_payment > 0 && !empty($receiptData->other_reason_history))
                <div class="border-t border-gray-200 pt-4 mb-4 no-print-download">
                    <h4 class="text-xs font-bold text-gray-500 uppercase mb-2 bg-gray-100 px-2 py-1 rounded flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Other Pay Reasons
                    </h4>
                    <div class="space-y-3 max-h-[20vh] overflow-y-auto pr-1 text-gray-800">
                        @foreach(array_reverse($receiptData->other_reason_history) as $index => $rh)
                        <div class="bg-purple-50 border-l-4 border-purple-400 p-3 rounded-r-lg shadow-sm group relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs font-bold text-purple-500 inline-flex items-center gap-1">
                                    @if(isset($rh['is_superadmin']) && $rh['is_superadmin'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 4L12 3l3.5 6L21 5l-2 11H5zm0 2h14v2H5v-2z"/></svg>
                                    @endif
                                    {{ $rh['user'] }}
                                </span>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] text-gray-400">{{ $rh['date'] }}</span>
                                    @if(auth()->user()->username === 'admin' || auth()->user()->username === 'superadmin')
                                    <button wire:click="deleteOtherReasonHistoryItem({{ $receiptData->id }}, {{ $index }})" wire:confirm="Delete this reason?" class="text-red-400 hover:text-red-600 transition-colors" title="Delete Reason">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                    @endif
                                </div>
                            </div>
                            <p class="text-sm text-purple-700">{{ $rh['text'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- ✅ Audit & Edit History (Print & Download এ হাইড থাকবে) -->
                @if(!empty($receiptData->edit_history))
                <div class="border-t border-gray-200 pt-4 no-print-download" x-data="{ showHistory: false }">
                    <button @click="showHistory = !showHistory" type="button" class="w-full flex justify-between items-center text-sm font-bold text-gray-600 focus:outline-none group">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Audit & Edit History ({{ count($receiptData->edit_history) }})
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transform transition-transform duration-300" :class="showHistory ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>

                    <div x-show="showHistory" x-transition.duration.200ms class="mt-3 space-y-3 max-h-[20vh] overflow-y-auto pr-1 text-gray-800">
                        @foreach(array_reverse($receiptData->edit_history) as $index => $log)
                        <div class="bg-gray-50 rounded-lg p-3 text-xs border border-gray-200">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-indigo-500 inline-flex items-center gap-1">
                                @if(isset($log['is_superadmin']) && $log['is_superadmin'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M5 16L3 5l5.5 4L12 3l3.5 6L21 5l-2 11H5zm0 2h14v2H5v-2z"/></svg>
                                @endif
                                {{ $log['user'] }}
                            </span>
                                <span class="badge badge-sm {{ $log['action'] == 'Paid' ? 'badge-success' : 'badge-warning' }} text-white">{{ $log['action'] }}</span>
                            </div>
                            <p class="text-gray-400 mb-1">{{ $log['date'] }}</p>
                            
                            @if(isset($log['old_values']))
                                <div class="space-y-1 mt-2 bg-white p-2 rounded border border-gray-100">
                                    @foreach($log['old_values'] as $field => $oldValue)
                                        @php 
                                            $newValue = $log['new_values'][$field] ?? ''; 
                                            $currencyFields = ['deposit_amount', 'due_amount', 'fine_amount', 'other_payment'];
                                            $isCurrency = in_array($field, $currencyFields);
                                            
                                            $displayOld = $isCurrency ? '৳' . number_format((float)$oldValue, 0) : $oldValue;
                                            $displayNew = $isCurrency ? '৳' . number_format((float)$newValue, 0) : $newValue;
                                        @endphp
                                        @if($oldValue != $newValue)
                                        <div class="flex items-center gap-2">
                                            <span class="capitalize font-semibold text-gray-500">{{ str_replace('_', ' ', $field) }}:</span>
                                            <span class="bg-red-50 text-red-400 px-1.5 py-0.5 rounded line-through">{{ $displayOld }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                            <span class="bg-green-50 text-green-500 px-1.5 py-0.5 rounded font-bold">{{ $displayNew }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            @elseif(isset($log['details']))
                                <p class="text-gray-500 mt-1 bg-white p-2 rounded border border-gray-100">{{ $log['details'] }}</p>
                            @endif

                            @if(isset($log['reason']))
                            <p class="mt-2 pt-2 border-t border-dashed border-gray-200 text-amber-500 font-semibold">⚠️ Reason: {{ $log['reason'] }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                                <!-- ✅ Auto Generated Disclaimer (Print এ শো করবে) -->
                <div class="border-t border-dashed border-gray-300 mt-6 pt-4 text-center">
                    <p class="text-[10px] text-gray-400 italic leading-tight">
                        This receipt is auto-generated, it may contain errors. If there is any error, please inform the admin.
                    </p>
                </div>

            </div> <!-- End receipt-capture-area -->

            <!-- ✅ 2 Buttons (Close, Print) এবং এগুলো প্রিন্টে হাইড থাকবে -->
            <div class="flex gap-4 px-8 pb-8 no-print-download">
                <button wire:click="closeReceiptModal" class="w-1/2 py-2 border border-gray-300 rounded-xl text-gray-600 hover:bg-gray-100 font-medium transition-colors text-sm">Close</button>
                
                <!-- Print Button -->
                <button onclick="window.print()" class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-xl shadow-md transition-colors flex items-center justify-center gap-1 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Print
                </button>
            </div>

        </div>
    </div>
    @endif

        <!-- ===== Fine Waiver Modal ===== -->
    @if($showFineWaiverModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[90] p-4" wire:click="closeFineWaiverModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full p-8 relative text-center" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-orange-500/10 mb-4">
                <svg class="h-7 w-7 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            
            <h3 class="text-lg font-bold text-base-content mb-2">⚠️ Waive Fine?</h3>
            <p class="text-sm text-base-content/60 mb-6">You are setting the fine to ৳0. Please provide a valid reason for waiving the fine.</p>

            <div class="mb-4">
                <label class="block text-sm font-bold text-base-content/80 mb-1 text-left">Reason for Waiver *</label>
                <textarea wire:model="waiverReason" class="textarea textarea-bordered w-full focus:border-orange-400" rows="3" placeholder="Write reason here..."></textarea>
                @error('waiverReason') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button wire:click="closeFineWaiverModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200 font-medium">Cancel</button>
                <button wire:click="confirmFineWaiver" class="w-1/2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-xl shadow-md">Yes, Waive</button>
            </div>
        </div>
    </div>
    @endif


    <!-- ===== Other Payment Reason Modal ===== -->
    @if($showOtherPaymentReasonModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[90] p-4" wire:click="closeOtherPaymentReasonModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full p-8 relative text-center" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-purple-500/10 mb-4">
                <svg class="h-7 w-7 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            
            <!-- ✅ টাইটেল পরিবর্তন করা হয়েছে -->
            <h3 class="text-lg font-bold text-base-content mb-2">⚠️ Other Pay Reason</h3>
            <p class="text-sm text-base-content/60 mb-6">You are adding an extra payment. Please provide a reason below.</p>

            <div class="mb-4">
                <label class="block text-sm font-bold text-base-content/80 mb-1 text-left">Reason for this payment *</label>
                <textarea wire:model="otherPaymentReason" class="textarea textarea-bordered w-full focus:border-purple-400" rows="3" placeholder="Write reason here..."></textarea>
                @error('otherPaymentReason') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button wire:click="closeOtherPaymentReasonModal" class="w-1/2 py-2 border border-base-300 rounded-xl text-base-content/80 hover:bg-base-200 font-medium">Cancel Edit</button>
                <!-- ✅ বাটন কালার ঠিক করা হয়েছে (Indigo) -->
                <button wire:click="confirmOtherPaymentSave" class="w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-xl shadow-md">Yes, Save</button>
            </div>
        </div>
    </div>
    @endif


</div>



<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('scroll-to-member', (data) => {
            const memberId = data.memberId;
            let targetRow = document.getElementById(`desktop-row-${memberId}`);
            let isMobile = false;
            
            if (!targetRow) {
                targetRow = document.getElementById(`mobile-row-${memberId}`);
                isMobile = true;
            }

            if (targetRow) {
                // মডাল ওপেন হতে সামান্য সময় নেয় তাই ৩০০ মিলিসেকেন্ড ডিলে
                setTimeout(() => {
                    targetRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);

                // ✅ লাল বর্ডার ও শ্যাডো দিয়ে হাইলাইট করা
                setTimeout(() => {
                    // ✅ পুরো বর্ডারে (উপর, নিচ, ডান, বাম) লাল গ্লো শ্যাডো যোগ করা
                    targetRow.style.boxShadow = 'inset 0 0 15px 0 rgba(239, 68, 68, 0.6)';
                    targetRow.style.zIndex = '10';

                    // ৩ সেকেন্ড পর শ্যাডো সরিয়ে নেওয়া
                    setTimeout(() => {
                        targetRow.style.boxShadow = 'none';
                        targetRow.style.zIndex = '';
                    }, 3000);
                }, 600);
            }
        });
    });
</script>