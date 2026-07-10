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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Accounts Management</h1>
                    <p class="text-sm text-blue-100 mt-1">ব্যাংক অ্যাকাউন্ট ও লেনদেনের তথ্য</p>
                </div>
            </div>
            <button wire:click="openAddMoneyModal" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add Money
            </button>
        </div>
    </div>

    <!-- ===== Body Section ===== -->
    <div class="bg-base-100 p-6 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">

        <!-- ===== Dutch Bangla Bank - Main Balance Card ===== -->
        <div class="relative bg-gradient-to-br from-slate-200 via-gray-100 to-slate-300 dark:from-slate-950 dark:via-gray-950 dark:to-black rounded-3xl mb-6 shadow-lg shadow-slate-300/30 dark:shadow-2xl dark:shadow-black/50 overflow-hidden p-6 sm:p-8 border border-slate-300/60 dark:border-slate-700/50">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-400/10 dark:bg-blue-500/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-400/10 dark:bg-indigo-500/10 rounded-full -ml-24 -mb-24 blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-r from-slate-300/30 via-transparent to-slate-400/20 dark:from-slate-700/20 dark:via-transparent dark:to-slate-800/20 rotate-45 pointer-events-none"></div>

            <div class="relative z-10">
                <!-- Top Row: DBBL (Left) | Bank Name + Balance (Center) | Chip (Right) -->
                <div class="flex justify-between items-start mb-8 sm:mb-12">
                    <!-- Left: DBBL Icon -->
                    <div class="w-10 h-10 bg-slate-300/60 dark:bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center border border-slate-400/40 dark:border-white/20 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-slate-600 dark:text-emerald-100"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0112 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
                    </div>

                    <!-- Center: Bank Name & Available Balance (Big) -->
                    <div class="absolute left-1/2 top-0 -translate-x-1/2 text-center">
                        <p class="text-slate-700 dark:text-yellow-400 font-extrabold text-sm sm:text-lg tracking-[0.25em] uppercase drop-shadow-lg mb-2">Dutch Bangla Bank PLC</p>
                        <p class="text-slate-400 dark:text-yellow-400/40 text-[10px] sm:text-xs uppercase tracking-[0.2em] font-semibold">Available Balance</p>
                    </div>

                    <!-- Right: Chip -->
                    <div class="flex-shrink-0">
                        <div class="w-10 h-7 bg-gradient-to-br from-yellow-300 to-yellow-600 rounded-md shadow-inner relative overflow-hidden">
                            <div class="absolute inset-0.5 border border-yellow-700/40 rounded-sm"></div>
                            <div class="absolute top-1/2 left-0 w-full h-px bg-yellow-700/30"></div>
                        </div>
                    </div>
                </div>

                <!-- ===== MIDDLE: Big Balance (Perfectly Centered) ===== -->
                <div class="flex-1 flex items-center justify-center py-4">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-800 dark:text-white tracking-tight drop-shadow-lg">
                        ৳{{ number_format($totalBankBalance, 0) }}
                    </h2>
                </div>

                <!-- ===== BOTTOM ROW: Inflow || Outflow (Centered) ===== -->
                <div class="flex justify-center">
                    <div class="inline-flex items-center bg-slate-200/60 dark:bg-white/10 backdrop-blur-sm border border-slate-300/50 dark:border-white/20 rounded-2xl overflow-hidden">
                        <!-- Total Inflow -->
                        <div class="px-5 sm:px-8 py-3 text-center">
                            <p class="text-emerald-700/60 dark:text-emerald-400/60 text-[10px] uppercase tracking-widest font-bold mb-0.5">Total Inflow</p>
                            <p class="text-lg sm:text-2xl font-extrabold text-emerald-700 dark:text-emerald-300">+ ৳{{ number_format($totalBankInflow, 0) }}</p>
                        </div>
                        <!-- Divider -->
                        <div class="w-px h-10 bg-slate-300/50 dark:bg-white/20"></div>
                        <!-- Total Outflow -->
                        <div class="px-5 sm:px-8 py-3 text-center">
                            <p class="text-red-600/60 dark:text-red-400/60 text-[10px] uppercase tracking-widest font-bold mb-0.5">Total Outflow</p>
                            <p class="text-lg sm:text-2xl font-extrabold text-red-600 dark:text-red-300">- ৳{{ number_format($totalBankOutflow, 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===== Monthly Balance Card ===== -->
        <div class="bg-purple-50 border border-purple-500/50 p-5 sm:p-6 rounded-2xl mb-6 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
            
            <div class="flex gap-3 text-center">
                <div class="bg-white/100 border border-green-500/80 px-4 py-2.5 rounded-xl backdrop-blur-sm">
                    <p class="text-[10px] text-emerald-600/70 font-bold uppercase tracking-wider">Monthly Inflow</p>
                    <p class="text-lg font-extrabold text-emerald-600">৳ {{ number_format($monthlyInflow, 0) }}</p>
                </div>
            </div>
        
            <div>
                <div class="bg-white/100 border border-purple-500/80 px-4 py-2.5 rounded-xl backdrop-blur-sm">
                    <p class="text-purple-600 text-xs font-bold uppercase tracking-[0.15em]">Monthly Balance</p>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-purple-700 mt-1">৳ {{ number_format($monthlyTotal, 0) }}</h2>
                </div>
            </div>
            <div class="flex gap-3 text-center">
                
                <div class="bg-white/100 border border-red-500/80 px-4 py-2.5 rounded-xl backdrop-blur-sm">
                    <p class="text-[10px] text-red-600/70 font-bold uppercase tracking-wider">Monthly Outflow</p>
                    <p class="text-lg font-extrabold text-red-500">৳ {{ number_format($monthlyOutflow, 0) }}</p>
                </div>
            </div>
        </div>
        <!-- ===== Date Filter ===== -->
        <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center gap-3 bg-sky-500/10 p-3 rounded-xl border border-sky-500/20">
            <h3 class="text-sm font-bold text-base-content/70 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                Payment Method Collections
            </h3>
            <div class="flex items-center gap-2 sm:ml-auto">
                <button wire:click="$set('selectedMonth', 'all')" class="btn btn-sm shadow-sm {{ $selectedMonth === 'all' ? 'bg-sky-600 hover:bg-sky-700 text-white border-sky-600' : 'bg-base-100 border border-base-300 text-base-content/70 hover:bg-base-200' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    All Time
                </button>
                <input type="month" wire:model.live="selectedMonth" class="input input-bordered input-sm shadow-sm bg-base-100 focus:border-sky-400 focus:ring-1 focus:ring-sky-400/30 w-52">
            </div>
        </div>
        <!-- ===== 5 Payment Method Cards ===== -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 mb-8">
            @foreach([
                'Cash'   => ['icon' => '💵', 'text' => 'text-emerald-600', 'amountText' => 'text-emerald-700', 'border' => 'border-emerald-500/20', 'iconBg' => 'bg-emerald-100', 'gradient' => 'from-emerald-500/10 to-emerald-500/5'],
                'Bkash'  => ['icon' => '📱', 'text' => 'text-pink-600', 'amountText' => 'text-pink-700', 'border' => 'border-pink-500/20', 'iconBg' => 'bg-pink-100', 'gradient' => 'from-pink-500/10 to-pink-500/5'],
                'Nagad'  => ['icon' => '📲', 'text' => 'text-orange-600', 'amountText' => 'text-orange-700', 'border' => 'border-orange-500/20', 'iconBg' => 'bg-orange-100', 'gradient' => 'from-orange-500/10 to-orange-500/5'],
                'Rocket' => ['icon' => '🚀', 'text' => 'text-purple-600', 'amountText' => 'text-purple-700', 'border' => 'border-purple-500/20', 'iconBg' => 'bg-purple-100', 'gradient' => 'from-purple-500/10 to-purple-500/5'],
                'Bank'   => ['icon' => '🏦', 'text' => 'text-blue-600', 'amountText' => 'text-blue-700', 'border' => 'border-blue-500/20', 'iconBg' => 'bg-blue-100', 'gradient' => 'from-blue-500/10 to-blue-500/5'],
            ] as $method => $config)
                @php
                    $stats = $paymentMethodStats[$method] ?? ['amount' => 0, 'transactions' => 0];
                @endphp
                <div class="bg-gradient-to-br {{ $config['gradient'] }} border {{ $config['border'] }} p-4 rounded-xl shadow-sm flex items-center gap-4">
                    <div class="{{ $config['iconBg'] }} p-3 rounded-full text-lg shadow-sm">
                        {{ $config['icon'] }}
                    </div>
                    <div>
                        <p class="text-xs {{ $config['text'] }} font-bold uppercase">{{ $method }}</p>
                        <p class="text-xl font-extrabold {{ $config['amountText'] }}">৳{{ number_format($stats['amount'], 0) }}</p>
                        <p class="text-base-content/40 text-[10px] mt-0.5 font-semibold">{{ $stats['transactions'] }} transaction{{ $stats['transactions'] != 1 ? 's' : '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- ===== Details Tabs ===== -->
        <div>
            <!-- Tab Buttons -->
            <div class="flex gap-2 mb-4 border-b border-base-300 pb-3">
                <button wire:click="setTab('transactions')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'transactions' ? 'bg-sky-600 text-white shadow-md' : 'bg-sky-50 text-sky-600 hover:bg-sky-100 border border-sky-200' }}">
                    <span class="{{ $activeTab === 'transactions' ? 'bg-white/20 p-1.5 rounded-full' : 'bg-sky-200/50 p-1.5 rounded-full' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $activeTab === 'transactions' ? 'text-white' : 'text-sky-700' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    Transaction Log
                </button>

            </div>
            <!-- Tab Content: Transaction Log -->
            @if($activeTab == 'transactions')
            <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
                <table class="table w-full text-sm">
                    <thead>
                        <tr class="bg-sky-600 text-white uppercase text-xs">
                            <th class="py-3 px-3 text-left font-bold">Date</th>
                            <th class="py-3 px-3 text-center font-bold">Source</th>
                            <th class="py-3 px-3 text-center font-bold">Type</th>
                            <th class="py-3 px-3 text-center font-bold">Category</th>
                            <th class="py-3 px-3 text-left font-bold">Details</th>
                            <th class="py-3 px-3 text-center font-bold">Method</th>
                            <th class="py-3 px-3 text-right font-bold">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($monthlyTransactions as $tx)
                        @php
                            $sourceMap = [
                                'Deposit' => 'De-Ma',
                                'Loan Repayment' => 'Lo-Ma',
                                'Loan Profit' => 'Lo-Ma',
                                'Loan Disbursement' => 'Lo-Ma',
                                'Registration Fee' => 'Me-Ma',
                                'Manual Profit' => 'Ac-Ma',
                                'Other Income' => 'Ac-Ma',
                            ];
                            $sourceName = $sourceMap[$tx['category']] ?? 'Ex-Ma';

                            $catTextColors = [
                                'Deposit' => 'text-emerald-600',
                                'Loan Repayment' => 'text-blue-600',
                                'Loan Profit' => 'text-amber-600',
                                'Loan Disbursement' => 'text-indigo-600',
                                'Registration Fee' => 'text-cyan-600',
                                'Manual Profit' => 'text-teal-600',
                                'Other Income' => 'text-teal-600',
                            ];
                            $catTextColor = $catTextColors[$tx['category']] ?? 'text-red-600';

                            $amountColor = match($tx['category']) {
                                'Loan Profit' => 'text-amber-600',
                                'Loan Repayment' => 'text-blue-600',
                                'Loan Disbursement' => 'text-indigo-600',
                                'Manual Profit' => 'text-teal-600',
                                'Other Income' => 'text-teal-600',
                                default => ($tx['type'] == 'in' ? 'text-emerald-600' : 'text-red-500'),
                            };
                        @endphp
                        <tr class="border-b border-base-200 hover:bg-sky-500/20 transition-colors">
                            <td class="py-3 px-3 text-base-content/70 text-sm">{{ $tx['date'] }}</td>
                            <td class="py-3 px-3 text-center">
                                <span class="text-xs font-bold tracking-wide text-base-content bg-base-200 px-2.5 py-1 rounded">{{ $sourceName }}</span>
                            </td>
                            <td class="py-3 px-3 text-center">
                                @if($tx['type'] == 'in')
                                    <span class="text-xs font-bold text-emerald-600">INFLOW</span>
                                @else
                                    <span class="text-xs font-bold text-red-600">OUTFLOW</span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-center">
                                <span class="text-xs font-bold {{ $catTextColor }}">{{ $tx['category'] }}</span>
                            </td>
                            <td class="py-3 px-5 text-base-content/70 text-sm">{{ $tx['details'] }}</td>
                            <td class="py-3 px-3 text-center">
                                @php $methodBg = ['Cash' => 'bg-emerald-100 text-emerald-700', 'Bkash' => 'bg-pink-100 text-pink-700', 'Nagad' => 'bg-orange-100 text-orange-700', 'Rocket' => 'bg-purple-100 text-purple-700', 'Bank' => 'bg-blue-100 text-blue-700']; @endphp
                                <span class="badge badge-sm {{ $methodBg[$tx['method']] ?? 'bg-base-200 text-base-content' }} text-[11px] font-bold border-0">{{ $tx['method'] }}</span>
                            </td>
                            <td class="py-3 px-3 text-right font-extrabold text-sm {{ $amountColor }}">
                                {{ $tx['type'] == 'in' ? '+' : '-' }} ৳{{ number_format($tx['amount'], 0) }}
                                @if(in_array($tx['category'], ['Manual Profit', 'Other Income']))
                                <button wire:click="openManualInflowModal({{ $tx['timestamp'] }})" class="ml-1 text-teal-500 hover:text-teal-700 inline-flex" title="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-8 text-base-content/40">No transactions found for this month.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif

        </div>

    </div>

     <!-- ===== Manual Inflow View Modal ===== -->
    @if($viewManualInflowModal && $viewManualInflowData)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click="closeManualInflowModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-sm w-full overflow-hidden border border-teal-500/20" wire:click.stop>
            
            <div class="relative overflow-hidden bg-gradient-to-br from-teal-600 via-emerald-700 to-slate-800 p-5 text-white flex justify-between items-center">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-400/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold tracking-tight">Transaction Details</h2>
                        <p class="text-xs text-teal-200">{{ $viewManualInflowData['category'] }}</p>
                    </div>
                </div>
                <button wire:click="closeManualInflowModal" class="relative z-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm p-2 rounded-xl border border-white/10 transition-all"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <div class="p-5 space-y-3 text-sm">
                <div class="bg-teal-500/10 border border-teal-500/20 p-4 rounded-xl text-center">
                    <p class="text-xs text-teal-600 font-bold uppercase">Amount</p>
                    <p class="text-2xl font-extrabold text-teal-700 mt-1">+ ৳{{ number_format($viewManualInflowData['amount'], 0) }}</p>
                </div>

                <div class="bg-base-200 p-4 rounded-xl space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b border-base-300">
                        <span class="text-base-content/50 font-semibold">Category</span>
                        <span class="font-bold text-teal-600">{{ $viewManualInflowData['category'] }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-base-300">
                        <span class="text-base-content/50 font-semibold">Payment Method</span>
                        <span class="font-bold text-base-content">{{ $viewManualInflowData['method'] }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-base-300">
                        <span class="text-base-content/50 font-semibold">Added By</span>
                        <span class="font-bold text-base-content">{{ $viewManualInflowData['user'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-base-content/50 font-semibold">Date & Time</span>
                        <span class="font-bold text-base-content text-xs">{{ $viewManualInflowData['date'] }}</span>
                    </div>
                </div>

                @if($viewManualInflowData['description'] && $viewManualInflowData['description'] !== 'N/A')
                <div class="bg-blue-500/10 border border-blue-500/20 p-3 rounded-lg">
                    <span class="text-blue-600 font-bold text-xs block mb-1">📝 Note</span>
                    <p class="text-sm text-base-content/80">{{ $viewManualInflowData['description'] }}</p>
                </div>
                @endif

                <button wire:click="closeManualInflowModal" class="w-full py-2.5 border border-base-300 rounded-xl text-sm font-medium hover:bg-base-200 transition-all">Close</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Add Money Modal ===== -->
    @if($addMoneyModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click="closeAddMoneyModal">
        <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full overflow-hidden border border-teal-500/20" wire:click.stop>
            
            <div class="relative overflow-hidden bg-gradient-to-br from-teal-600 via-emerald-700 to-slate-800 p-5 text-white flex justify-between items-center">
                <div class="absolute top-0 right-0 w-32 h-32 bg-teal-400/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-emerald-400/10 rounded-full -ml-10 -mb-10 blur-2xl"></div>
                <div class="relative z-10 flex items-center gap-3">
                    <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold tracking-tight">Add Money</h2>
                        <p class="text-xs text-teal-200">ম্যানুয়ালি টাকা যোগ করুন</p>
                    </div>
                </div>
                <button wire:click="closeAddMoneyModal" class="relative z-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm p-2 rounded-xl border border-white/10 transition-all"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>

            <div class="p-5 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Category *</label>
                    <select wire:model="addCategory" class="select select-bordered w-full select-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="Manual Profit">Manual Profit</option>
                        <option value="Other Income">Other Income</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Amount (৳) *</label>
                    <input type="number" wire:model="addAmount" class="input input-bordered w-full input-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Enter amount..." />
                    @error('addAmount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Payment Method</label>
                    <div class="grid grid-cols-5 gap-1.5">
                        <label class="cursor-pointer">
                            <input type="radio" name="addMethod" wire:model="addMethod" value="Cash" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-teal-500 peer-checked:bg-teal-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">💵</span>
                                <span class="text-[9px] font-bold text-base-content/60">Cash</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="addMethod" wire:model="addMethod" value="Bkash" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-teal-500 peer-checked:bg-teal-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">📱</span>
                                <span class="text-[9px] font-bold text-base-content/60">Bkash</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="addMethod" wire:model="addMethod" value="Nagad" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-teal-500 peer-checked:bg-teal-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">📲</span>
                                <span class="text-[9px] font-bold text-base-content/60">Nagad</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="addMethod" wire:model="addMethod" value="Rocket" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-teal-500 peer-checked:bg-teal-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">🚀</span>
                                <span class="text-[9px] font-bold text-base-content/60">Rocket</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="addMethod" wire:model="addMethod" value="Bank" class="peer sr-only" />
                            <div class="flex flex-col items-center gap-1 p-2.5 rounded-xl border-2 border-base-300 peer-checked:border-teal-500 peer-checked:bg-teal-500/10 transition-all hover:bg-base-200">
                                <span class="text-lg">🏦</span>
                                <span class="text-[9px] font-bold text-base-content/60">Bank</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Date & Time *</label>
                    <input type="datetime-local" wire:model="addDateTime" class="input input-bordered w-full input-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                    @error('addDateTime') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Note (Optional)</label>
                    <textarea wire:model="addDescription" class="textarea textarea-bordered w-full textarea-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500" rows="2" placeholder="বিবরণ লিখুন..."></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button wire:click="closeAddMoneyModal" class="flex-1 py-2.5 border border-base-300 rounded-xl text-sm font-medium hover:bg-base-200 transition-all">Cancel</button>
                    <button wire:click="saveAddMoney" class="flex-1 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white font-bold py-2.5 rounded-xl shadow-lg shadow-teal-500/20 text-sm transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Add Money
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>