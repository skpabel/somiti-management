<div class="min-h-screen bg-mobile-primary pb-24 font-sans" :class="$wire.theme === 'dark' ? 'dark' : ''">
    
    <!-- ✅ রিইউজেবল ইউজার হেডার কম্পোনেন্ট -->
    <x-mobile.user-header />

    <!-- ===== Welcome Card ===== -->
    <div class="px-4 mt-3">
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            
            <p class="text-green-100 text-xs font-bold">{{ __lang('আবার স্বাগতম!', 'Welcome back!') }}</p>
            <h2 class="text-xl font-extrabold mt-1 leading-tight">{{ $member->name_english ?? 'User' }}</h2>
            <div class="mt-3 flex items-center gap-2 flex-wrap">
                <span class="bg-white rounded-full px-3 py-1 flex items-center gap-1.5">
                    <x-heroicon-o-identification class="w-3.5 h-3.5 text-emerald-500" />
                    <span class="text-gray-400 text-xs font-bold">Acc :</span>
                    <span class="text-emerald-600 text-xs font-bold">{{ $member->account_no ?? 'N/A' }}</span>
                </span>
                <span class="bg-white rounded-full px-3 py-1 flex items-center gap-1.5">
                    <x-heroicon-o-chart-bar class="w-3.5 h-3.5 text-emerald-500" />
                    <span class="text-gray-400 text-xs font-bold">Share :</span>
                    <span class="text-emerald-600 text-xs font-bold">{{ number_format($member->shares ?? 0, 2) }}</span>
                </span>
                <span class="bg-white rounded-full px-3 py-1 flex items-center gap-1.5">
                    <x-heroicon-o-banknotes class="w-3.5 h-3.5 text-red-500" />
                    <span class="text-gray-400 text-xs font-bold">Loan :</span>
                    <span class="text-red-500 text-xs font-bold">{{ count($activeLoans) }}</span>
                </span>
            </div>
            
            <!-- White Info Card -->
            <div class="bg-white rounded-xl p-3 mt-4 flex items-center shadow-sm relative z-10">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                    </svg>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold">{{ __lang('মোট জমা', 'Total Deposit') }}</p>
                        <p class="text-sm font-extrabold text-gray-800">৳{{ number_format($totalPaidDeposit, 0) }}</p>
                    </div>
                </div>
                <div class="mx-4 w-px h-8 bg-gray-200"></div>
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                    </svg>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold">{{ __lang('গ্রহণযোগ্য মুনাফা', 'Acceptable Profit') }}</p>
                        <p class="text-sm font-extrabold text-gray-800">৳{{ number_format($acceptableProfit, 0) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $totalPaid = $totalPaidDeposit;
        $totalDue = $totalDueAmount;
        $totalAll = $totalPaid + $totalDue;
        $paidPercent = $totalAll > 0 ? round(($totalPaid / $totalAll) * 100) : 0;
        $duePercent = $totalAll > 0 ? round(($totalDue / $totalAll) * 100) : 0;
    @endphp

    <!-- ===== Deposit Status Card ===== -->
    @if($depositStatus)
    <div class="px-4 mt-4">

        @if($depositStatus['state'] === 'paid')
        <div class="bg-white border border-emerald-100 rounded-2xl px-4 py-3.5 shadow-sm">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-emerald-600">{{ $depositStatus['message'] }}</p>
                    <p class="text-[11px] text-gray-400 mt-0.5">{{ $depositStatus['sub'] }}</p>
                </div>
            </div>
            @if($depositStatus['next_amount'] !== null)
            <div class="mt-3 bg-blue-50 border border-blue-100 rounded-xl px-4 py-2.5 flex items-center justify-between">
                <div>
                    <p class="text-[11px] text-blue-500 font-semibold">{{ __lang('পরবর্তী কিস্তি শীঘ্রই', 'Next installment soon') }}</p>
                    <p class="text-[10px] text-gray-400">{{ $depositStatus['next_month'] }}</p>
                </div>
                <p class="text-[15px] font-extrabold text-blue-600">৳{{ number_format($depositStatus['next_amount'], 0) }}</p>
            </div>
            @endif
        </div>

        @elseif($depositStatus['state'] === 'due')
        <div class="bg-orange-50 border border-orange-200 rounded-2xl px-4 py-3.5 shadow-sm">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-orange-600">{{ $depositStatus['message'] }}</p>
                    <p class="text-[11px] text-gray-500 mt-0.5">{{ $depositStatus['sub'] }}</p>
                </div>
                @if($depositStatus['amount'] > 0)
                <p class="text-[13px] font-extrabold text-orange-600">৳{{ number_format($depositStatus['amount'], 0) }}</p>
                @endif
            </div>
            <a href="{{ url('mobile-deposit-request') }}" class="mt-3 flex items-center justify-center gap-2 w-full bg-orange-500 hover:bg-orange-600 text-white text-[12px] font-bold py-2.5 rounded-xl transition">
                {{ __lang('জমার আবেদন দিন →', 'Submit Deposit Request →') }}
            </a>
        </div>

        @elseif($depositStatus['state'] === 'overdue')
        <div class="bg-red-50 border-2 border-red-300 rounded-2xl p-4 shadow-sm">
            <!-- Top: Icon + Message -->
            <div class="flex items-start gap-3">
                <div class="bg-red-100 rounded-xl p-2.5 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.303 3.376c.866 1.5-.217 3.374-1.948 3.374H4.645c-1.73 0-2.813-1.874-1.948-3.374L10.052 3.378c.866-1.5 3.032-1.5 3.898 0l7.353 12.748zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-red-600">{{ $depositStatus['message'] }}</p>
                    <p class="text-[11px] text-gray-500 mt-0.5">{{ $depositStatus['sub'] }}</p>
                </div>
            </div>
            <!-- Amount Row -->
            @if($depositStatus['amount'] > 0)
            <div class="mt-3 bg-red-100 rounded-xl px-4 py-2.5 flex items-center justify-between">
                <span class="text-[11px] text-red-500 font-semibold">{{ __lang('মোট বকেয়া', 'Total Due') }}</span>
                <span class="text-[15px] font-extrabold text-red-600">৳{{ number_format($depositStatus['amount'], 0) }}</span>
            </div>
            @endif
            <!-- Estimated Fine Row -->
            @if(($depositStatus['estimated_fine'] ?? 0) > 0)
            <div class="mt-2 bg-orange-100 rounded-xl px-4 py-2.5 flex items-center justify-between">
                <div>
                    <span class="text-[11px] text-orange-600 font-semibold">{{ __lang('আনুমানিক জরিমানা', 'Estimated Fine') }}</span>
                    <p class="text-[11px] text-orange-400">{{ __lang('অ্যাডমিন চূড়ান্ত জরিমানার পরিমাণ নির্ধারণ করবেন', 'Admin will determine final fine amount') }}</p>
                </div>
                <span class="text-[15px] font-extrabold text-orange-600">৳{{ number_format($depositStatus['estimated_fine'], 0) }}</span>
            </div>
            @endif
            <a href="{{ url('mobile-deposit-request') }}" class="mt-3 flex items-center justify-center gap-2 w-full bg-red-500 hover:bg-red-600 text-white text-[12px] font-bold py-2.5 rounded-xl transition">
                {{ __lang('জমার আবেদন দিন →', 'Submit Deposit Request →') }}
            </a>
        </div>

        @elseif($depositStatus['state'] === 'upcoming')
        <div class="flex items-center gap-3 bg-white border border-blue-100 rounded-2xl px-4 py-3.5 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
            </svg>
            <div class="flex-1">
                <p class="text-[13px] font-extrabold text-blue-500">{{ $depositStatus['message'] }}</p>
                <p class="text-[11px] text-gray-400 mt-0.5">{{ $depositStatus['sub'] }}</p>
            </div>
        </div>
        @endif

    </div>
    @endif

        <!-- Active Loan Cards -->
        @if($hasActiveLoan)
        <div class="px-4">
        @foreach($activeLoans as $i => $loan)
        <a href="{{ url('mobile-loan-detail/' . $loan['id']) }}" class="block mt-3">
            <div class="bg-gradient-to-br from-orange-50 via-white to-amber-50 rounded-2xl shadow-sm p-4 border-2 border-orange-200">
                <!-- Header -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                        </svg>
                        <div>
                            <p class="text-[11px] font-extrabold text-gray-800">{{ __lang('সক্রিয় ঋণ', 'Active Loan') }} {{ count($activeLoans) > 1 ? $i + 1 : '' }}</p>
                            @if($loan['purpose'])
                            <p class="text-[10px] text-gray-400">{{ $loan['purpose'] }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] font-bold text-orange-600 bg-orange-100 px-2.5 py-1 rounded-lg">{{ $loan['paid_percent'] }}% {{ __lang('পরিশোধিত', 'Paid') }}</span>
                        <p class="text-[13px] font-extrabold text-gray-700 mt-1">৳{{ number_format($loan['loan_amount'], 0) }}</p>
                    </div>
                </div>

                <!-- Next Due Date (prominent) -->
                @if($loan['next_due_date'])
                <div class="bg-orange-100 rounded-xl px-3 py-2 flex items-center justify-between mb-3">
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        <span class="text-[10px] text-orange-600 font-semibold">{{ __lang('পরবর্তী কিস্তির তারিখ', 'Next Installment Date') }}</span>
                    </div>
                    <span class="text-[12px] font-extrabold text-orange-600">{{ $loan['next_due_date'] }}</span>
                </div>
                @endif

                <!-- 3 Stats -->
                <div class="grid grid-cols-3 gap-2 mb-3">
                    <div class="bg-white rounded-xl p-2.5 text-center border border-gray-100">
                        <p class="text-[9px] text-gray-400 font-semibold uppercase">{{ $loan['repayment_type'] === 'one_time' ? __lang('মোট পরিশোধযোগ্য', 'Total Payable') : __lang('কিস্তি', 'Installment') }}</p>
                        <p class="text-[12px] font-extrabold text-orange-500 mt-0.5">৳{{ number_format($loan['installment_amount'], 0) }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-2.5 text-center border border-gray-100">
                        <p class="text-[9px] text-gray-400 font-semibold uppercase">{{ __lang('পরিশোধিত', 'Paid') }}</p>
                        <p class="text-[12px] font-extrabold text-green-600 mt-0.5">৳{{ number_format($loan['total_paid'], 0) }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-2.5 text-center border border-gray-100">
                        <p class="text-[9px] text-gray-400 font-semibold uppercase">{{ __lang('বাকি', 'Remaining') }}</p>
                        <p class="text-[12px] font-extrabold text-red-500 mt-0.5">৳{{ number_format($loan['remaining'], 0) }}</p>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-orange-400 h-1.5 rounded-full transition-all" style="width: {{ $loan['paid_percent'] }}%"></div>
                </div>
            </div>
        </a>
        @endforeach
        </div>
        @endif

    <!-- ===== Recent Activity ===== -->
    <div class="px-4 mt-4 pb-4">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-[14px] font-extrabold text-gray-800">{{ __lang('সাম্প্রতিক কার্যক্রম', 'Recent Activity') }}</h3>
            <a href="{{ url('mobile-history') }}"
               class="text-[11px] font-bold px-3 py-1 rounded-full"
               style="background:#d1fae5; color:#059669;">{{ __lang('সব দেখুন →', 'View All →') }}</a>
        </div>

        @if($recentDeposits->isEmpty())
        <div class="bg-white rounded-2xl p-8 text-center" style="border: 2px solid #e5e7eb;">
            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-[13px] font-bold text-gray-400">{{ __lang('এখনো কোনো কার্যক্রম নেই', 'No activity yet') }}</p>
        </div>
        @else
        <div class="space-y-3">
            @foreach($recentDeposits as $deposit)
            @php
                $total    = $deposit->deposit_amount + $deposit->due_amount + $deposit->fine_amount + ($deposit->other_payment ?? 0);
                $hasDue   = $deposit->due_amount > 0;
                $hasFine  = $deposit->fine_amount > 0;
                $hasOther = ($deposit->other_payment ?? 0) > 0;
                $month    = \Carbon\Carbon::createFromFormat('Y-m', $deposit->month_year)->format('F Y');
            @endphp
            <div class="bg-white rounded-2xl px-4 py-3.5" style="border: 2px solid #34d399;">
                <div class="flex items-start gap-3">
                    {{-- Icon --}}
                    <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 text-xl flex-shrink-0"
                         style="background:#d1fae5;">
                        💰
                    </div>
                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1.5">
                            <p class="text-[13px] font-extrabold text-gray-800">{{ $month }}</p>
                            <p class="text-[14px] font-extrabold" style="color:#059669;">+৳{{ number_format($total, 0) }}</p>
                        </div>
                        {{-- Breakdown chips --}}
                        <div class="flex items-center gap-1.5 flex-wrap mb-2">
                            <span class="text-[9px] font-bold px-2 py-0.5 rounded-lg" style="background:#d1fae5; color:#065f46;">
                                💰 Deposit ৳{{ number_format($deposit->deposit_amount, 0) }}
                            </span>
                            @if($hasDue)
                            <span class="text-[9px] font-bold px-2 py-0.5 rounded-lg" style="background:#fee2e2; color:#991b1b;">
                                📋 Due ৳{{ number_format($deposit->due_amount, 0) }}
                            </span>
                            @endif
                            @if($hasFine)
                            <span class="text-[9px] font-bold px-2 py-0.5 rounded-lg" style="background:#ffedd5; color:#9a3412;">
                                ⚠️ Fine ৳{{ number_format($deposit->fine_amount, 0) }}
                            </span>
                            @endif
                            @if($hasOther)
                            <span class="text-[9px] font-bold px-2 py-0.5 rounded-lg" style="background:#ede9fe; color:#4c1d95;">
                                ➕ Other ৳{{ number_format($deposit->other_payment, 0) }}
                            </span>
                            @endif
                        </div>
                        {{-- Date + method --}}
                        <div class="flex items-center gap-2 pt-2" style="border-top: 1px solid #f0fdf4;">
                            <span class="text-[10px] text-gray-400">
                                @if($deposit->payment_method === 'Cash') 💵
                                @elseif($deposit->payment_method === 'Bkash') 📱
                                @elseif($deposit->payment_method === 'Nagad') 📱
                                @elseif($deposit->payment_method === 'Rocket') 📱
                                @elseif($deposit->payment_method === 'Bank') 🏦
                                @endif
                                {{ $deposit->payment_method }}
                            </span>
                            <span class="text-gray-200">·</span>
                            <span class="text-[10px] text-gray-400">{{ $deposit->updated_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <x-mobile.footer active="home" />

</div>
