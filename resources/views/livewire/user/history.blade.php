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
            <h2 class="text-[15px] font-extrabold text-gray-900">{{ __lang('জমার ইতিহাস', 'Deposit History') }}</h2>
            <p class="text-[11px] text-gray-400">{{ __lang('আপনার মাসিক জমার রেকর্ড', 'Your monthly deposit records') }}</p>
        </div>
    </div>

    <div class="px-4 pt-4 space-y-4">

        {{-- ===== Summary Card ===== --}}
        @php
            $paidDeposits = $deposits->getCollection()->where('status', 'paid');
            $totalDeposit = $paidDeposits->sum('deposit_amount');
            $totalDue     = $paidDeposits->sum('due_amount');
            $totalFine    = $paidDeposits->sum('fine_amount');
            $totalOther   = $paidDeposits->sum('other_payment');
            $totalPaid    = $paidDeposits->count();
            $totalUnpaid  = $deposits->getCollection()->where('status', 'draft')->count();
        @endphp
        <div class="rounded-2xl overflow-hidden shadow-sm" style="border: 2px solid #34d399;">
            <div class="px-4 py-3 flex items-center gap-2" style="background: linear-gradient(135deg,#10b981,#059669);">
                <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <p class="text-[12px] font-extrabold text-white">{{ __lang('সারসংক্ষেপ (এই পৃষ্ঠা)', 'Summary (This Page)') }}</p>
                    <p class="text-[10px] text-emerald-100">{{ $totalPaid }} {{ __lang('পরিশোধিত', 'Paid') }} · {{ $totalUnpaid }} {{ __lang('অপরিশোধিত', 'Unpaid') }}</p>
                </div>
            </div>
            <div class="bg-white px-4 py-3 grid grid-cols-2 gap-3">
                <div class="bg-emerald-50 rounded-xl p-2.5 border border-emerald-100">
                    <p class="text-[9px] font-bold text-emerald-600 uppercase tracking-wide">{{ __lang('জমা', 'DEPOSIT') }}</p>
                    <p class="text-[14px] font-extrabold text-emerald-700">৳{{ number_format($totalDeposit, 0) }}</p>
                </div>
                <div class="bg-red-50 rounded-xl p-2.5 border border-red-100">
                    <p class="text-[9px] font-bold text-red-500 uppercase tracking-wide">{{ __lang('বকেয়া', 'DUE') }}</p>
                    <p class="text-[14px] font-extrabold text-red-600">৳{{ number_format($totalDue, 0) }}</p>
                </div>
                <div class="bg-orange-50 rounded-xl p-2.5 border border-orange-100">
                    <p class="text-[9px] font-bold text-orange-500 uppercase tracking-wide">{{ __lang('জরিমানা', 'FINE') }}</p>
                    <p class="text-[14px] font-extrabold text-orange-600">৳{{ number_format($totalFine, 0) }}</p>
                </div>
                <div class="bg-gray-900 rounded-xl p-2.5">
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wide">{{ __lang('মোট পরিশোধিত', 'TOTAL PAID') }}</p>
                    <p class="text-[14px] font-extrabold text-white">৳{{ number_format($totalDeposit + $totalDue + $totalFine + $totalOther, 0) }}</p>
                </div>
            </div>
        </div>

        {{-- ===== Deposits List ===== --}}
        @forelse($deposits as $deposit)
        @php
            $isPaid   = $deposit->status === 'paid';
            $total    = $deposit->deposit_amount + $deposit->due_amount + $deposit->fine_amount + $deposit->other_payment;
            $monthLabel = \Carbon\Carbon::createFromFormat('Y-m', $deposit->month_year)->format('F Y');
            $isClickable = !$isPaid; // Only unpaid deposits are clickable
            $depositUrl = !$isPaid ? url('mobile-deposit-request?month=' . $deposit->month_year) : '#';
        @endphp

        <a href="{{ $depositUrl }}"
           class="block bg-white rounded-2xl shadow-sm overflow-hidden {{ $isClickable ? 'active:scale-[0.98] transition-transform' : '' }}"
             style="border: 2px solid {{ $isPaid ? '#34d399' : '#fcd34d' }};">

            {{-- Header --}}
            <div class="px-4 py-3 flex items-center justify-between"
                 style="background: {{ $isPaid ? 'rgba(16,185,129,0.07)' : 'rgba(251,191,36,0.08)' }}; border-bottom: 1px solid {{ $isPaid ? '#bbf7d0' : '#fde68a' }};">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                         style="background: {{ $isPaid ? '#d1fae5' : '#fef3c7' }};">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="{{ $isPaid ? '#059669' : '#d97706' }}" stroke-width="2">
                            @if($isPaid)
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                    </div>
                    <div>
                        <p class="text-[13px] font-extrabold text-gray-800">{{ $monthLabel }}</p>
                        <p class="text-[10px] text-gray-400">{{ $deposit->payment_method }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-xl border"
                          style="{{ $isPaid ? 'background:#d1fae5; color:#065f46; border-color:#6ee7b7;' : 'background:#fef3c7; color:#92400e; border-color:#fcd34d;' }}">
                        {{ $isPaid ? __lang('✓ পরিশোধিত', '✓ Paid') : __lang('⏳ অপরিশোধিত', '⏳ Unpaid') }}
                    </span>
                    @if($isClickable)
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                    @endif
                </div>
            </div>

            {{-- Amounts --}}
            <div class="px-4 py-3">
                <div class="grid grid-cols-4 gap-2 mb-3">
                    <div class="text-center">
                        <p class="text-[9px] text-gray-400 font-bold uppercase">{{ __lang('জমা', 'DEPOSIT') }}</p>
                        <p class="text-[12px] font-extrabold text-gray-800">৳{{ number_format($deposit->deposit_amount, 0) }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[9px] font-bold uppercase" style="color:{{ $deposit->due_amount > 0 ? '#ef4444' : '#9ca3af' }}">{{ __lang('বকেয়া', 'DUE') }}</p>
                        <p class="text-[12px] font-extrabold" style="color:{{ $deposit->due_amount > 0 ? '#ef4444' : '#9ca3af' }}">৳{{ number_format($deposit->due_amount, 0) }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[9px] font-bold uppercase" style="color:{{ $deposit->fine_amount > 0 ? '#f97316' : '#9ca3af' }}">{{ __lang('জরিমানা', 'FINE') }}</p>
                        <p class="text-[12px] font-extrabold" style="color:{{ $deposit->fine_amount > 0 ? '#f97316' : '#9ca3af' }}">৳{{ number_format($deposit->fine_amount, 0) }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[9px] text-gray-400 font-bold uppercase">{{ __lang('মোট', 'TOTAL') }}</p>
                        <p class="text-[12px] font-extrabold" style="color:{{ $isPaid ? '#059669' : '#9ca3af' }}">৳{{ number_format($total, 0) }}</p>
                    </div>
                </div>

                {{-- Footer info --}}
                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <span class="text-[10px] text-gray-400">
                        @if($isPaid)
                            ✓ {{ $deposit->updated_at->format('d M Y, h:i A') }}
                        @else
                            —
                        @endif
                    </span>
                    <div class="flex items-center gap-2">
                        @if($deposit->transaction_id)
                        <span class="text-[10px] text-gray-400 font-mono">{{ Str::limit($deposit->transaction_id, 14) }}</span>
                        @endif
                        @if($deposit->paid_by_info)
                        <span class="text-[10px] text-gray-400">By: {{ $deposit->paid_by_info }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="flex flex-col items-center justify-center bg-white rounded-2xl shadow-sm p-10 text-center" style="border: 2px solid #e5e7eb;">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-[14px] font-bold text-gray-500">{{ __lang('কোনো রেকর্ড পাওয়া যায়নি', 'No records found') }}</p>
            <p class="text-[12px] text-gray-400 mt-1">{{ __lang('আপনার জমার ইতিহাস এখানে দেখাবে', 'Your deposit history will appear here') }}</p>
        </div>
        @endforelse

        {{-- Pagination --}}
        <div class="pb-2">
            {{ $deposits->links() }}
        </div>

    </div>

    <x-mobile.footer active="history" />

</div>
