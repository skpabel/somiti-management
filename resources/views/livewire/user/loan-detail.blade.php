<div class="min-h-screen bg-gray-50 pb-24 font-sans">

    <x-mobile.user-header />

    <!-- Page Header -->
    <div class="bg-white px-4 py-3.5 flex items-center gap-3 border-b border-gray-100 sticky top-0 z-10">
        <a href="{{ url('mobile-loan') }}"
           class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-600 active:scale-90 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19 8 12l7-7"/>
            </svg>
        </a>
        <div class="flex-1">
            <h2 class="text-[15px] font-extrabold text-gray-900">{{ __lang('ঋণের বিস্তারিত', 'Loan Details') }}</h2>
            <p class="text-[11px] text-gray-400">Loan #{{ $loan->id }}</p>
        </div>
    </div>

    <div class="px-4 pt-4 space-y-4">

        <!-- My Loans Style Card -->
        <div class="rounded-2xl overflow-hidden shadow-sm" style="border: 2px solid #fb923c;">
            {{-- Header --}}
            <div class="px-4 py-3.5 flex items-center justify-between"
                 style="background: linear-gradient(135deg, #fff7ed, #ffedd5);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                         style="background:#fed7aa;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#ea580c" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 3H8L2 7h20L16 3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v4M10 14h4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[13px] font-extrabold text-gray-800">
                            {{ $loan->purpose ?? __lang('সক্রিয় ঋণ', 'Active Loan') }}
                        </p>
                        @if($loan->disbursement_date)
                        <p class="text-[10px] text-gray-400">{{ __lang('বিতরণ:', 'Disbursed:') }} {{ \Carbon\Carbon::parse($loan->disbursement_date)->format('d M Y') }}</p>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[16px] font-extrabold" style="color:#ea580c;">
                        ৳{{ number_format($loan->loan_amount, 0) }}
                    </p>
                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-lg"
                          style="background:#fed7aa; color:#9a3412;">
                        {{ $paidPercent }}% {{ __lang('পরিশোধিত', 'paid') }}
                    </span>
                </div>
            </div>

            {{-- Stats --}}
            <div class="bg-white px-4 py-3 grid grid-cols-3 gap-2">
                <div class="text-center">
                    <p class="text-[9px] text-gray-400 font-bold uppercase">{{ __lang('কিস্তি', 'INSTALLMENT') }}</p>
                    <p class="text-[13px] font-extrabold" style="color:#ea580c;">
                        ৳{{ number_format($loan->installment_amount, 0) }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-[9px] text-gray-400 font-bold uppercase">{{ __lang('পরিশোধিত', 'PAID') }}</p>
                    <p class="text-[13px] font-extrabold" style="color:#16a34a;">
                        ৳{{ number_format($totalPaid, 0) }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-[9px] text-gray-400 font-bold uppercase">{{ __lang('বাকি', 'REMAINING') }}</p>
                    <p class="text-[13px] font-extrabold" style="color:#dc2626;">
                        ৳{{ number_format($remaining, 0) }}
                    </p>
                </div>
            </div>

            {{-- Progress bar --}}
            <div class="px-4 pb-3 bg-white">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] text-gray-400">{{ __lang('পরিশোধের অগ্রগতি', 'Repayment progress') }}</span>
                    <span class="text-[10px] font-bold" style="color:#ea580c;">{{ $paidPercent }}%</span>
                </div>
                <div class="w-full rounded-full h-2" style="background:#f1f5f9;">
                    <div class="h-2 rounded-full transition-all"
                         style="width:{{ $paidPercent }}%; background: linear-gradient(90deg,#fb923c,#ea580c);"></div>
                </div>
                <div class="flex justify-between mt-1">
                    <span class="text-[9px] text-gray-400">0%</span>
                    <span class="text-[9px] font-bold" style="color:#ea580c;">{{ $paidPercent }}%</span>
                    <span class="text-[9px] text-gray-400">100%</span>
                </div>
            </div>
        </div>

        <!-- Enhanced Loan Info Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-orange-50 to-amber-50 px-4 py-3 border-b border-orange-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-[12px] font-bold text-gray-700">{{ __lang('ঋণের তথ্য', 'Loan Information') }}</p>
                </div>
            </div>
            <!-- Enhanced Info Items -->
            <div class="divide-y divide-gray-50">
                <div class="px-4 py-3 flex justify-between items-center">
                    <p class="text-[12px] text-gray-500">{{ __lang('ঋণের পরিমাণ', 'Loan Amount') }}</p>
                    <p class="text-[12px] font-bold text-gray-800">৳{{ number_format($loan->loan_amount, 0) }}</p>
                </div>
                <div class="px-4 py-3 flex justify-between items-center">
                    <p class="text-[12px] text-gray-500">{{ __lang('মুনাফার পরিমাণ', 'Profit Amount') }}</p>
                    @if($loan->profit_amount > 0)
                    <p class="text-[12px] font-bold text-emerald-600">৳{{ number_format($totalProfitPaid, 0) }} <span class="text-gray-400 font-normal text-[11px]">/ ৳{{ number_format((float)$loan->profit_amount, 0) }}</span></p>
                    @else
                    <p class="text-[12px] font-bold text-emerald-600">৳{{ number_format($totalProfitPaid, 0) }}</p>
                    @endif
                </div>
                <div class="px-4 py-3 flex justify-between items-center">
                    <p class="text-[12px] text-gray-500">{{ __lang('মোট পরিশোধযোগ্য', 'Total Payable') }}</p>
                    <p class="text-[12px] font-bold text-gray-800">৳{{ number_format($loan->total_payable, 0) }}</p>
                </div>
                <div class="px-4 py-3 flex justify-between items-center">
                    <p class="text-[12px] text-gray-500">{{ __lang('পরিশোধের ধরন', 'Repayment Type') }}</p>
                    <p class="text-[12px] font-bold text-gray-800">{{ ucfirst(str_replace('_', ' ', $loan->repayment_type)) }}</p>
                </div>
                @if($loan->disbursement_date)
                <div class="px-4 py-3 flex justify-between items-center">
                    <p class="text-[12px] text-gray-500">{{ __lang('বিতরণের তারিখ', 'Disbursement Date') }}</p>
                    <p class="text-[12px] font-bold text-gray-800">{{ \Carbon\Carbon::parse($loan->disbursement_date)->format('d M Y') }}</p>
                </div>
                @endif
                @if($loan->repayment_start_date)
                <div class="px-4 py-3 flex justify-between items-center">
                    <p class="text-[12px] text-gray-500">{{ __lang('পরিশোধ শুরু', 'Repayment Start') }}</p>
                    <p class="text-[12px] font-bold text-gray-800">{{ \Carbon\Carbon::parse($loan->repayment_start_date)->format('d M Y') }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Enhanced Repayment History -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- History Header -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-4 py-3 border-b border-green-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[12px] font-bold text-gray-800">{{ __lang('পরিশোধের ইতিহাস', 'Repayment History') }}</p>
                            <span class="text-[10px] text-gray-400">{{ $repayments->count() }} {{ __lang('টি পেমেন্ট', 'payments') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($repayments->isEmpty())
            <!-- Empty State -->
            <div class="px-5 py-10 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-[14px] font-semibold text-gray-500 mb-1">{{ __lang('এখনও কোনো পরিশোধ নেই', 'No repayments yet') }}</p>
                <p class="text-[12px] text-gray-400">{{ __lang('পরিশোধের ইতিহাস এখানে দেখাবে', 'Repayment history will appear here') }}</p>
            </div>
            @else
            <!-- Repayment List -->
            <div class="divide-y divide-gray-50">
                @foreach($repayments as $index => $repayment)
                @php
                    $txnDetails = is_array($repayment->transaction_details) ? $repayment->transaction_details : json_decode($repayment->transaction_details, true);
                    $txnProfit = $txnDetails['profit'] ?? 0;
                    $isRecent = $index < 3; // Mark first 3 as recent
                @endphp
                <div class="px-5 py-4 hover:bg-gray-50/50 transition-colors {{ $isRecent ? 'bg-green-50/30' : '' }}">
                    <div class="flex items-center gap-4">
                        <!-- Payment Icon -->
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center flex-shrink-0 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                            </svg>
                            @if($isRecent)
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-orange-400 rounded-full flex items-center justify-center">
                                <span class="text-white text-[8px] font-bold">!</span>
                            </div>
                            @endif
                        </div>

                        <!-- Payment Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <p class="text-[14px] font-bold text-gray-800">{{ \Carbon\Carbon::parse($repayment->payment_date)->format('d M Y') }}</p>
                                @if($isRecent)
                                <span class="px-2 py-0.5 bg-orange-100 text-orange-600 text-[9px] font-bold rounded-full">{{ __lang('সাম্প্রতিক', 'Recent') }}</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[11px] text-gray-500">{{ $repayment->payment_method }}</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span class="text-[11px] text-gray-400">{{ \Carbon\Carbon::parse($repayment->payment_date)->format('h:i A') }}</span>
                            </div>
                        </div>
                        <!-- Payment Amount -->
                        <div class="text-right">
                            @if($repayment->amount > 0)
                            <p class="text-[15px] font-bold text-green-600 mb-0.5">+৳{{ number_format($repayment->amount, 0) }}</p>
                            @endif
                            @if($txnProfit > 0)
                            <p class="text-[11px] font-semibold text-purple-500">{{ __lang('মুনাফা:', 'Profit:') }} ৳{{ number_format($txnProfit, 0) }}</p>
                            @endif
                            @if($repayment->amount == 0 && $txnProfit == 0)
                            <p class="text-[15px] font-bold text-green-600">৳0</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

    <x-mobile.footer active="loan" />

</div>