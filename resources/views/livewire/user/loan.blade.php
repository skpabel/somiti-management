<div class="min-h-screen bg-gray-50 pb-24 font-sans">

    <x-mobile.user-header />

    <!-- Page Title -->
    <div class="bg-white px-4 py-3.5 flex items-center gap-3 border-b border-gray-100 sticky top-0 z-10">
        <a href="{{ url('mobile-dashboard') }}"
           class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-600 active:scale-90 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19 8 12l7-7"/>
            </svg>
        </a>
        <div class="flex-1">
            <h2 class="text-[15px] font-extrabold text-gray-900">{{ __lang('আমার ঋণ', 'My Loans') }}</h2>
            <p class="text-[11px] text-gray-400">{{ __lang('সক্রিয় ঋণের বিস্তারিত', 'Active loan details') }}</p>
        </div>
    </div>

    <div class="px-4 pt-4 space-y-4">

        @if(!$hasActiveLoan)
        {{-- No active loan --}}
        <div class="bg-white rounded-2xl p-10 text-center" style="border: 2px solid #e5e7eb;">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                 style="background:#f1f5f9;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="1.5">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 3H8L2 7h20L16 3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v4M10 14h4"/>
                </svg>
            </div>
            <p class="text-[15px] font-extrabold text-gray-700">{{ __lang('কোনো সক্রিয় ঋণ নেই', 'No active loans') }}</p>
            <p class="text-[12px] text-gray-400 mt-1.5 leading-relaxed">
                {{ __lang('এই মুহূর্তে আপনার কোনো সক্রিয় ঋণ নেই।<br>ঋণের জন্য আবেদন করতে অ্যাডমিনের সাথে যোগাযোগ করুন।', 'You have no active loans at the moment.<br>Contact admin to apply for a loan.') }}
            </p>
        </div>

        @else
        {{-- Active loans --}}
        @foreach($activeLoans as $loan)
        <a href="{{ url('mobile-loan-detail/' . $loan['id']) }}"
           class="block rounded-2xl overflow-hidden shadow-sm active:scale-[0.98] transition"
           style="border: 2px solid #fb923c;">

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
                            {{ $loan['purpose'] ?? __lang('সক্রিয় ঋণ', 'Active Loan') }}
                        </p>
                        @if($loan['disbursement_date'])
                        <p class="text-[10px] text-gray-400">{{ __lang('বিতরণ:', 'Disbursed:') }} {{ $loan['disbursement_date'] }}</p>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[16px] font-extrabold" style="color:#ea580c;">
                        ৳{{ number_format($loan['loan_amount'], 0) }}
                    </p>
                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-lg"
                          style="background:#fed7aa; color:#9a3412;">
                        {{ $loan['paid_percent'] }}% {{ __lang('পরিশোধিত', 'paid') }}
                    </span>
                </div>
            </div>

            {{-- Stats --}}
            <div class="bg-white px-4 py-3 grid grid-cols-3 gap-2">
                <div class="text-center">
                    <p class="text-[9px] text-gray-400 font-bold uppercase">
                        {{ $loan['repayment_type'] === 'one_time' ? __lang('মোট', 'Total') : __lang('কিস্তি', 'Installment') }}
                    </p>
                    <p class="text-[13px] font-extrabold" style="color:#ea580c;">
                        ৳{{ number_format($loan['installment_amount'], 0) }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-[9px] text-gray-400 font-bold uppercase">{{ __lang('পরিশোধিত', 'PAID') }}</p>
                    <p class="text-[13px] font-extrabold" style="color:#16a34a;">
                        ৳{{ number_format($loan['total_paid'], 0) }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-[9px] text-gray-400 font-bold uppercase">{{ __lang('বাকি', 'REMAINING') }}</p>
                    <p class="text-[13px] font-extrabold" style="color:#dc2626;">
                        ৳{{ number_format($loan['remaining'], 0) }}
                    </p>
                </div>
            </div>

            {{-- Progress bar --}}
            <div class="px-4 pb-3 bg-white">
                @if($loan['next_due_date'])
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] text-gray-400">{{ __lang('পরবর্তী কিস্তির তারিখ', 'Next installment date') }}</span>
                    <span class="text-[10px] font-bold" style="color:#ea580c;">{{ $loan['next_due_date'] }}</span>
                </div>
                @endif
                <div class="w-full rounded-full h-2" style="background:#f1f5f9;">
                    <div class="h-2 rounded-full transition-all"
                         style="width:{{ $loan['paid_percent'] }}%; background: linear-gradient(90deg,#fb923c,#ea580c);"></div>
                </div>
                <div class="flex justify-between mt-1">
                    <span class="text-[9px] text-gray-400">0%</span>
                    <span class="text-[9px] font-bold" style="color:#ea580c;">{{ $loan['paid_percent'] }}%</span>
                    <span class="text-[9px] text-gray-400">100%</span>
                </div>
            </div>

        </a>
        @endforeach
        @endif

    </div>

    <x-mobile.footer active="loan" />

</div>
