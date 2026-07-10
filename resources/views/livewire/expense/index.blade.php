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
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Expense Management</h1>
                    <p class="text-sm text-blue-100 mt-1">সমিতির সকল খরচের হিসাব ও স্ট্যাটাস</p>
                </div>
            </div>
            <button wire:click="openAddModal" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add Expense
            </button>
        </div>
    </div>

    <!-- ===== Body Placeholder (Overall Stats & Table) ===== -->
    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">
        
        <!-- ✅ Overall Expense Stats -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-base-content/80 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    Overall Expenses & Outflows
                </h3>
                
                <!-- Filter Dropdown -->
                <select wire:model.live="selectedMonth" class="select select-bordered select-sm shadow-sm w-48">
                    <option value="">All Time</option>
                    @foreach($availableMonths as $month)
                        <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-7 gap-4">
                <!-- Total Expense Card -->
                <div class="bg-gradient-to-br from-red-500/10 to-red-500/5 border border-red-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-red-100 p-3 rounded-full text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-red-600 font-bold uppercase">Total Expense</p>
                        <p class="text-xl font-extrabold text-red-700">৳{{ number_format($totalExpense, 0) }}</p>
                    </div>
                </div>

                <!-- Monthly Expense Card -->
                <div class="bg-gradient-to-br from-orange-500/10 to-orange-500/5 border border-orange-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="bg-orange-100 p-3 rounded-full text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-orange-600 font-bold uppercase">{{ $selectedMonth ? \Carbon\Carbon::parse($selectedMonth . '-01')->format('M Y') : 'All Time' }}</p>
                        <p class="text-xl font-extrabold text-orange-700">৳{{ number_format($monthlyExpense, 0) }}</p>
                    </div>
                </div>

                <!-- Payment Method Cards -->
                @foreach([
                    'Cash' => ['icon' => '💵', 'bg' => 'from-emerald-500/10 to-emerald-500/5', 'border' => 'border-emerald-500/20', 'iconBg' => 'bg-emerald-100', 'iconColor' => 'text-emerald-600', 'textColor' => 'text-emerald-700'],
                    'Bkash' => ['icon' => '📱', 'bg' => 'from-pink-500/10 to-pink-500/5', 'border' => 'border-pink-500/20', 'iconBg' => 'bg-pink-100', 'iconColor' => 'text-pink-600', 'textColor' => 'text-pink-700'],
                    'Nagad' => ['icon' => '📲', 'bg' => 'from-orange-500/10 to-orange-500/5', 'border' => 'border-orange-500/20', 'iconBg' => 'bg-orange-100', 'iconColor' => 'text-orange-600', 'textColor' => 'text-orange-700'],
                    'Rocket' => ['icon' => '🚀', 'bg' => 'from-purple-500/10 to-purple-500/5', 'border' => 'border-purple-500/20', 'iconBg' => 'bg-purple-100', 'iconColor' => 'text-purple-600', 'textColor' => 'text-purple-700'],
                    'Bank' => ['icon' => '🏦', 'bg' => 'from-blue-500/10 to-blue-500/5', 'border' => 'border-blue-500/20', 'iconBg' => 'bg-blue-100', 'iconColor' => 'text-blue-600', 'textColor' => 'text-blue-700'],
                ] as $method => $config)
                    @php $stats = $paymentMethodStats[$method] ?? ['amount' => 0, 'transactions' => 0]; @endphp
                    <div class="bg-gradient-to-br {{ $config['bg'] }} border {{ $config['border'] }} p-4 rounded-xl shadow-sm flex items-center gap-4">
                        <div class="{{ $config['iconBg'] }} p-3 rounded-full {{ $config['iconColor'] }} text-xl">
                            {{ $config['icon'] }}
                        </div>
                        <div>
                            <p class="text-xs {{ $config['iconColor'] }} font-bold uppercase">{{ $method }}</p>
                            <p class="text-xl font-extrabold {{ $config['textColor'] }}">৳{{ number_format($stats['amount'], 0) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ✅ Expense Table Section -->
        <div>
            <h3 class="text-lg font-bold text-base-content/80 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                Expense Records
            </h3>
            <div class="bg-base-200/50 border border-base-300 rounded-xl overflow-hidden">
                
                <!-- ===== DESKTOP VIEW ===== -->
                <div class="hidden md:block overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
                    <table class="table w-full text-sm">
                        <thead>
                            <tr class="bg-red-600 text-white uppercase text-xs">
                                <th class="py-3 px-3 text-center">Entry Date</th>
                                <th class="py-3 px-3 text-center">Expense Date</th>
                                <th class="py-3 px-3 text-center">Subject</th>
                                <th class="py-3 px-3 text-center">Description</th>
                                <th class="py-3 px-3 text-center">Payment Method</th>
                                <th class="py-3 px-3 text-center">Through (মাধ্যম)</th>
                                <th class="py-3 px-3 text-center">Amount</th>
                                <th class="py-3 px-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense)
                            <tr class="border-b border-base-200 hover:bg-red-500/20 transition-colors {{ $expense->category == 'Loan Disbursement' ? 'bg-indigo-500/5' : '' }}">
                                    <!-- Entry Date -->
                                <td class="py-3 px-4 text-center text-base-content/60">{{ formatDateTime($expense->created_at) }}</td>

                                <!-- Expense Date (এখানে ক্যালেন্ডার থেকে সিলেক্ট করা তারিখ শো করবে) -->
                                <td class="py-3 px-4 text-center">
                                    @if($expense->expense_date)
                                        <span class="badge badge-ghost badge-sm font-bold">{{ formatDateTime($expense->expense_date) }}</span>
                                    @else
                                        <span class="text-base-content/40">—</span>
                                    @endif
                                </td>

                                <td class="py-3 px-4 text-center">
                                    @if($expense->category == 'Loan Disbursement')
                                        <span class="badge badge-primary badge-sm text-white gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Loan Given</span>
                                    @else
                                        <span class="font-semibold text-base-content">{{ $expense->category }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center text-base-content/50 text-xs">{{ $expense->description ?: '—' }}</td>
                                <td class="py-3 px-4 text-center">
                                    @php
                                        $mIcons = ['Cash' => '💵', 'Bkash' => '📱', 'Nagad' => '📲', 'Rocket' => '🚀', 'Bank' => '🏦'];
                                        $mBadge = ['Cash' => 'bg-emerald-100 text-emerald-700', 'Bkash' => 'bg-pink-100 text-pink-700', 'Nagad' => 'bg-orange-100 text-orange-700', 'Rocket' => 'bg-purple-100 text-purple-700', 'Bank' => 'bg-blue-100 text-blue-700'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 {{ $mBadge[$expense->payment_method] ?? 'bg-base-200 text-base-content' }} text-xs font-semibold px-2.5 py-1 rounded-lg">
                                        {{ $mIcons[$expense->payment_method] ?? '' }} {{ $expense->payment_method }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($expense->medium_type == 'Member' && $expense->member)
                                        <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 text-xs font-bold px-2.5 py-1 rounded-lg">
                                            👤 #{{ $expense->member->account_no }} {{ $expense->member->name_english }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-lg">
                                            সরাসরি (Direct)
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center font-bold text-sm {{ $expense->category == 'Loan Disbursement' ? 'text-indigo-600' : 'text-red-600' }}">৳ {{ number_format($expense->amount, 0) }}</td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex items-center justify-center gap-0.5">
                                        @if($expense->category != 'Loan Disbursement')
                                        <button wire:click="openEditModal({{ $expense->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50 hover:text-blue-700" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                        </button>
                                        @endif

                                        @if($expense->edit_history)
                                        <button wire:click="openHistoryModal({{ $expense->id }})" class="btn btn-ghost btn-xs text-amber-500 hover:bg-amber-50 hover:text-amber-700" title="Edit History">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </button>
                                        @endif

                                        <button wire:click="confirmDelete({{ $expense->id }})" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50 hover:text-red-700" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-base-content/40">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-base-content/20"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                                        <p>{{ $selectedMonth ? 'এই মাসে কোনো খরচ হয়নি' : 'কোনো খরচের তথ্য নেই' }}</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- ===== MOBILE VIEW ===== -->
                <div class="md:hidden space-y-4 p-4">
                    @forelse ($expenses as $expense)
                    <div class="bg-base-100 rounded-xl shadow-md border border-base-200 overflow-hidden flex flex-col hover:shadow-lg transition-shadow group">
                        
                        <div class="bg-gradient-to-r from-rose-500 to-orange-500 p-3 text-white flex justify-between items-center">
                            <div>
                                @if($expense->category == 'Loan Disbursement')
                                    <span class="font-bold text-sm">💰 Loan Given</span>
                                @else
                                    <h4 class="font-semibold text-sm leading-tight truncate">{{ $expense->category }}</h4>
                                @endif
                                <p class="text-[10px] text-white/80 mt-0.5">
                                    Entry: {{ formatDateTime($expense->created_at) }} • 
                                    <span class="font-bold">Date: {{ formatDateTime($expense->expense_date) }}</span>
                                </p>
                            </div>
                            <span class="font-extrabold text-base">৳{{ number_format($expense->amount, 0) }}</span>
                        </div>

                        <div class="p-4 grid grid-cols-2 gap-3 text-xs border-b border-base-200">
                            <div>
                                <p class="text-base-content/40 uppercase font-bold tracking-wider">Payment</p>
                                @php $mIcons = ['Cash' => '💵', 'Bkash' => '📱', 'Nagad' => '📲', 'Rocket' => '🚀', 'Bank' => '🏦']; @endphp
                                <p class="font-semibold text-base-content mt-1">{{ $mIcons[$expense->payment_method] ?? '' }} {{ $expense->payment_method }}</p>
                            </div>
                            <div>
                                <p class="text-base-content/40 uppercase font-bold tracking-wider">Through</p>
                                @if($expense->medium_type == 'Member' && $expense->member)
                                    <p class="font-semibold text-amber-600 mt-1">👤 #{{ $expense->member->account_no }}</p>
                                @else
                                    <p class="font-semibold text-base-content/70 mt-1">সরাসরি</p>
                                @endif
                            </div>
                        </div>

                        @if($expense->description)
                        <div class="px-4 py-2 bg-base-50 text-xs text-base-content/60 italic border-b border-base-200">
                            "{{ $expense->description }}"
                        </div>
                        @endif

                        <div class="p-2 flex justify-end gap-0.5 bg-base-50">
                            @if($expense->category != 'Loan Disbursement')
                            <button wire:click="openEditModal({{ $expense->id }})" class="btn btn-ghost btn-xs text-blue-500 hover:bg-blue-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                            </button>
                            @endif
                            @if($expense->edit_history)
                            <button wire:click="openHistoryModal({{ $expense->id }})" class="btn btn-ghost btn-xs text-amber-500 hover:bg-amber-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </button>
                            @endif
                            <button wire:click="confirmDelete({{ $expense->id }})" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-base-content/40">
                        <p>{{ $selectedMonth ? 'এই মাসে কোনো খরচ হয়নি' : 'কোনো খরচের তথ্য নেই' }}</p>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>

    <!-- ====================================================================== -->
    <!-- ===== ADD / EDIT EXPENSE MODAL ===== -->
    <!-- ====================================================================== -->
    @if($addModal || $editModal)
    <div class="fixed inset-0 bg-black/60 flex items-start sm:items-center justify-center z-50 p-2 sm:p-4 overflow-y-auto" wire:click="{{ $editModal ? 'closeEditModal' : 'closeAddModal' }}">
        <div class="bg-base-100 rounded-2xl shadow-2xl w-full max-w-lg relative my-4 sm:my-0 max-h-[90vh] overflow-y-auto" wire:click.stop>
            
            <!-- Popup Header -->
            <div class="bg-gradient-to-r from-rose-600 to-orange-500 p-5 sm:p-6 rounded-t-2xl text-white sticky top-0 z-10">
                <button wire:click="{{ $editModal ? 'closeEditModal' : 'closeAddModal' }}" class="absolute top-4 right-4 text-white/70 hover:text-white z-10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                <h2 class="text-xl sm:text-2xl font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                    {{ $editId ? 'Edit Expense' : 'New Expense' }}
                </h2>
                <p class="text-white/70 text-sm mt-1">{{ $editId ? 'খরচের তথ্য আপডেট করুন' : 'নতুন খরচের তথ্য যোগ করুন' }}</p>
            </div>

            <!-- Popup Body Content -->
            <div class="p-6 space-y-4">

                <!-- Expense Date (Full Calendar) -->
                <div>
                    <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Expense Date *</label>
                    <input type="date" wire:model="expense_date" class="input input-bordered w-full input-sm" />
                    @error('expense_date') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Subject & Amount -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Subject *</label>
                        <input type="text" wire:model="category" class="input input-bordered w-full input-sm" placeholder="e.g., Electricity" />
                        @error('category') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Amount (৳) *</label>
                        <input type="number" wire:model="amount" placeholder="0" class="input input-bordered w-full input-sm text-lg font-bold" />
                        @error('amount') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Description</label>
                    <textarea wire:model="description" placeholder="Optional details..." class="textarea textarea-bordered w-full textarea-sm" rows="2"></textarea>
                </div>

                <!-- Payment Method -->
                <div class="{{ $payment_method == 'Bank' ? 'grid grid-cols-2 gap-3' : '' }}">
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Payment Method *</label>
                        <select wire:model.live="payment_method" class="select select-bordered w-full select-sm">
                            @foreach($paymentOptions as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($payment_method == 'Bank')
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Bank Name</label>
                        <input type="text" wire:model="bank_name" class="input input-bordered w-full input-sm" placeholder="e.g., Dutch-Bangla Bank" />
                    </div>
                    @endif
                </div>

                <!-- Through (মাধ্যম) -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Through (মাধ্যম) *</label>
                        <select wire:model.live="medium_type" class="select select-bordered w-full select-sm">
                            <option value="Direct">সরাসরি (Direct)</option>
                            <option value="Member">Member এর মাধ্যমে</option>
                        </select>
                    </div>
                    
                    @if($medium_type == 'Member')
                    <div>
                        <label class="block text-xs font-semibold text-base-content/50 uppercase tracking-wider mb-1.5">Select Member *</label>
                        <select wire:model="member_id" class="select select-bordered w-full select-sm">
                            <option value="">Select Member</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">#{{ $member->account_no }} {{ $member->name_english }}</option>
                            @endforeach
                        </select>
                        @error('member_id') <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    @endif
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-base-200 flex gap-3 sticky bottom-0 bg-base-100">
                <button wire:click="{{ $editModal ? 'closeEditModal' : 'closeAddModal' }}" class="flex-1 py-2.5 border border-base-300 rounded-xl text-sm font-medium hover:bg-base-200 transition-colors">Cancel</button>
                <button wire:click="saveExpense" class="flex-1 bg-gradient-to-r from-rose-600 to-orange-500 hover:from-rose-700 hover:to-orange-600 text-white font-bold py-2.5 rounded-xl shadow-md text-sm transition-all">{{ $editId ? 'Update' : 'Save Expense' }}</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Delete Confirmation Modal ===== -->
    @if($deleteModal)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-[60] p-4" wire:click="closeDeleteModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-xs w-full overflow-hidden" wire:click.stop>
            <div class="p-6 text-center">
                <div class="mx-auto w-14 h-14 rounded-full bg-red-500/10 flex items-center justify-center mb-4">
                    <svg class="h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-base-content">Delete Expense?</h3>
                <p class="text-sm text-base-content/50 mt-1">This action cannot be undone.</p>
            </div>
            <div class="flex border-t border-base-200">
                <button wire:click="closeDeleteModal" class="flex-1 py-3 text-sm font-medium hover:bg-base-200 transition-colors">Cancel</button>
                <button wire:click="deleteExpense" class="flex-1 py-3 bg-red-500 hover:bg-red-600 text-white font-bold text-sm transition-colors">Delete</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Edit History Modal (Audit Log Design) ===== -->
    @if($historyModal)
    <div class="fixed inset-0 bg-black/60 flex items-start sm:items-center justify-center z-[60] p-2 sm:p-4 overflow-y-auto" wire:click="closeHistoryModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl w-full max-w-xl relative my-4 sm:my-0 max-h-[90vh] overflow-y-auto" wire:click.stop>
            
            <!-- Audit History Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-5 text-white sticky top-0 z-10 rounded-t-2xl">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold">Audit History</h2>
                            <p class="text-white/70 text-xs">এডিট ও পরিবর্তনের তথ্য</p>
                        </div>
                    </div>
                    <button wire:click="closeHistoryModal" class="text-white/70 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>

            <!-- Audit History Body -->
            <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                @foreach($historyData as $index => $history)
                    @php $user = \App\Models\User::find($history['updated_by']); @endphp
                    
                    <div class="bg-base-200/50 border border-base-300 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                        
                        <!-- Who & When -->
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-indigo-500 text-white rounded-full w-8">
                                        <span class="text-xs font-bold">{{ $user ? substr($user->name, 0, 1) : '?' }}</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-base-content">{{ $user ? $user->name : 'Unknown' }}</p>
                                    <p class="text-[10px] text-base-content/50 mt-0.5">{{ formatDateTime($history['updated_at']) }}</p>
                                </div>
                            </div>
                            <span class="badge badge-primary badge-sm text-white font-bold">Update #{{ $loop->iteration }}</span>
                        </div>

                        <!-- What Changed (Table Format) -->
                        <div class="bg-base-100 rounded-lg border border-base-200 overflow-hidden">
                            <table class="table table-sm w-full text-xs">
                                <thead>
                                    <tr class="bg-base-200 text-base-content/60 uppercase tracking-wider border-b border-base-300">
                                        <th class="py-2 px-3">Field</th>
                                        <th class="py-2 px-3">Old Value</th>
                                        <th class="py-2 px-3">New Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history['old_data'] as $key => $value)
                                        @php 
                                            $oldVal = $value;
                                            $newVal = $history['new_data'][$key] ?? null;
                                            
                                            // Format Old Value
                                            if($key == 'member_id' && $oldVal) {
                                                $m = \App\Models\Member::find($oldVal);
                                                $oldVal = $m ? '#'.$m->account_no.' '.$m->name_english : 'N/A';
                                            } elseif($key == 'expense_date' && $oldVal) {
                                                $oldVal = \formatDate($oldVal);
                                            } elseif($key == 'expense_month' && $oldVal) {
                                                $oldVal = \Carbon\Carbon::parse($oldVal . '-01')->format('01 M Y');
                                            } elseif($key == 'amount' && $oldVal) {
                                                $oldVal = '৳'.number_format($oldVal, 0);
                                            }

                                            // Format New Value
                                            if($key == 'member_id' && $newVal) {
                                                $mNew = \App\Models\Member::find($newVal);
                                                $newVal = $mNew ? '#'.$mNew->account_no.' '.$mNew->name_english : 'N/A';
                                            } elseif($key == 'expense_date' && $newVal) {
                                                $newVal = \formatDate($newVal);
                                            } elseif($key == 'expense_month' && $newVal) {
                                                $newVal = \Carbon\Carbon::parse($newVal . '-01')->format('01 M Y');
                                            } elseif($key == 'amount' && $newVal) {
                                                $newVal = '৳'.number_format($newVal, 0);
                                            }
                                        @endphp
                                        
                                        @if($oldVal != $newVal)
                                        <tr class="border-b border-base-200/50 last:border-0">
                                            <td class="py-2 px-3 font-semibold text-base-content/70 uppercase text-[10px] tracking-widest">{{ $key }}</td>
                                            <td class="py-2 px-3 text-red-500 line-through bg-red-500/5 font-medium">{{ $oldVal ?? 'N/A' }}</td>
                                            <td class="py-2 px-3 text-green-600 bg-green-500/5 font-medium">{{ $newVal ?? 'N/A' }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</div>