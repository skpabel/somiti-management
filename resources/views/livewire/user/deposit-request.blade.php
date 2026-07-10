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
            <h2 class="text-[15px] font-extrabold text-gray-900">{{ __lang('জমার আবেদন', 'Deposit Request') }}</h2>
            <p class="text-[11px] text-gray-400">{{ __lang('Admin কে পেমেন্ট জানান', 'Notify admin about payment') }}</p>
        </div>
    </div>

    <div class="px-4 pt-4 space-y-4">

        @if(session()->has('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl px-4 py-3.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-[13px] font-semibold text-emerald-700">{{ session('success') }}</p>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 rounded-2xl px-4 py-3.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
            <p class="text-[13px] font-semibold text-red-700">{{ session('error') }}</p>
        </div>
        @endif

        @if(count($availableMonths) === 0)
        <div class="flex flex-col items-center justify-center bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-[14px] font-bold text-gray-700">{{ __lang('সব deposit পরিষ্কার!', 'All deposits clear!') }}</p>
            <p class="text-[12px] text-gray-400 mt-1">{{ __lang('কোনো বকেয়া মাস নেই।', 'No pending months.') }}</p>
        </div>
        @else

        <!-- Pending Warning — above the card -->
        @if($pendingThisMonth)
        @php
            $pendingReqAbove = \App\Models\DepositRequest::where('member_id', $member->id)
                ->where('month_year', $selectedMonthYear)
                ->where('status', 'pending')
                ->first();
        @endphp
        <div class="bg-amber-50 border-2 border-amber-300 rounded-2xl px-4 py-4">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 border border-amber-200">
                    <span class="text-lg">⏳</span>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-amber-800">{{ __lang('আবেদন ইতিমধ্যে প্রক্রিয়াধীন', 'Request already in progress') }}</p>
                    <p class="text-[11px] text-amber-600 mt-0.5 leading-relaxed">
                        {{ __lang('এই মাসের জন্য আপনার একটি আবেদন ইতিমধ্যে অপেক্ষারত আছে। অ্যাডমিনের অনুমোদনের জন্য অপেক্ষা করুন।', 'A request for this month is already pending. Please wait for admin approval.') }}
                    </p>
                </div>
            </div>
            @if($pendingReqAbove)
            <div class="mt-3 bg-white rounded-xl border border-amber-200 px-3 py-2.5 flex items-center justify-between">
                <div class="flex items-center gap-2 flex-wrap">
                    @if($pendingReqAbove->deposit_amount > 0)
                    <span class="text-[10px] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-lg">💰 ৳{{ number_format($pendingReqAbove->deposit_amount, 0) }}</span>
                    @endif
                    @if($pendingReqAbove->due_amount > 0)
                    <span class="text-[10px] font-bold bg-red-100 text-red-700 px-2 py-0.5 rounded-lg">📋 ৳{{ number_format($pendingReqAbove->due_amount, 0) }}</span>
                    @endif
                    @if($pendingReqAbove->fine_amount > 0)
                    <span class="text-[10px] font-bold bg-orange-100 text-orange-700 px-2 py-0.5 rounded-lg">⚠️ ৳{{ number_format($pendingReqAbove->fine_amount, 0) }}</span>
                    @endif
                </div>
                <span class="text-[11px] font-extrabold text-amber-600 flex-shrink-0">৳{{ number_format($pendingReqAbove->amount, 0) }}</span>
            </div>
            @endif
        </div>
        @endif

        <!-- ===== Form Card ===== -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden" style="border: 2px solid #34d399;">

            <!-- Member Info Header -->
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-4 py-4 flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0 border-2 border-white/30">
                    @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover rounded-full"/>
                    @else
                        <span class="text-white text-base font-extrabold">{{ strtoupper($member->name_english[0] ?? 'M') }}</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-bold text-white">{{ $member->name_english }}</p>
                    <p class="text-[11px] text-emerald-100">Account: #{{ $member->account_no }} · Share: {{ $member->shares }}</p>
                </div>
            </div>

            <div class="p-4 space-y-4">

                <!-- Month Select -->
                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-2 block">{{ __lang('মাস নির্বাচন করুন', 'Select Month') }}</label>
                    <select wire:model.live="selectedMonthYear"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-800 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-white transition">
                        @foreach($availableMonths as $month)
                            <option value="{{ $month['month_year'] }}">{{ $month['month_label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Type Selector — hidden if pending -->
                @if(!$pendingThisMonth)
                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-2 block">{{ __lang('কী কী পাঠাচ্ছেন?', 'What are you sending?') }} <span class="text-gray-300 font-normal normal-case">({{ __lang('একাধিক select করা যাবে', 'multiple selection allowed') }})</span></label>
                    <div class="grid grid-cols-3 gap-3">

                        @php
                            $depositSelected = in_array('deposit', $selectedTypes);
                            $dueSelected     = in_array('due', $selectedTypes);
                            $fineSelected    = in_array('fine', $selectedTypes);
                            // Now month-level pending — all 3 disabled if any pending
                            $depositDisabled = $pendingThisMonth;
                            $dueDisabled     = $pendingThisMonth;
                            $fineDisabled    = $pendingThisMonth;
                        @endphp

                        <!-- 💰 Deposit -->
                        <button wire:click="toggleType('deposit')"
                                {{ $depositDisabled ? 'disabled' : '' }}
                                class="relative flex flex-col items-center gap-2 p-3 rounded-2xl border-2 transition-all
                                {{ $depositSelected ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 bg-white' }}
                                {{ $depositDisabled ? 'opacity-40 cursor-not-allowed' : 'active:scale-95' }}">
                            @if($depositSelected)
                            <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            @endif
                            <div class="w-11 h-11 rounded-xl {{ $depositSelected ? 'bg-emerald-100' : 'bg-gray-100' }} flex items-center justify-center">
                                <span class="text-2xl">💰</span>
                            </div>
                            <span class="text-[11px] font-bold {{ $depositSelected ? 'text-emerald-700' : 'text-gray-500' }}">{{ __lang('জমা', 'Deposit') }}</span>
                            <span class="text-[10px] font-bold {{ $depositSelected ? 'text-emerald-600' : 'text-gray-400' }}">৳{{ number_format($currentMonthData['deposit_amount'] ?? 0, 0) }}</span>
                            @if($pendingThisMonth)<span class="text-[9px] text-amber-600 font-bold">⏳ Pending</span>@endif
                        </button>

                        <!-- 📋 Due -->
                        <button wire:click="toggleType('due')"
                                {{ $dueDisabled ? 'disabled' : '' }}
                                class="relative flex flex-col items-center gap-2 p-3 rounded-2xl border-2 transition-all
                                {{ $dueSelected ? 'border-red-500 bg-red-50' : 'border-gray-200 bg-white' }}
                                {{ $dueDisabled ? 'opacity-40 cursor-not-allowed' : 'active:scale-95' }}">
                            @if($dueSelected)
                            <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            @endif
                            <div class="w-11 h-11 rounded-xl {{ $dueSelected ? 'bg-red-100' : 'bg-gray-100' }} flex items-center justify-center">
                                <span class="text-2xl">📋</span>
                            </div>
                            <span class="text-[11px] font-bold {{ $dueSelected ? 'text-red-700' : 'text-gray-500' }}">{{ __lang('বকেয়া', 'Due') }}</span>
                            <span class="text-[10px] font-bold {{ $dueSelected ? 'text-red-600' : 'text-gray-400' }}">
                                @if(($currentMonthData['due_amount'] ?? 0) > 0)
                                    ৳{{ number_format($currentMonthData['due_amount'], 0) }}
                                @else
                                    {{ __lang('পরিমাণ লিখুন', 'Enter amount') }}
                                @endif
                            </span>
                        </button>

                        <!-- ⚠️ Fine -->
                        <button wire:click="toggleType('fine')"
                                {{ $fineDisabled ? 'disabled' : '' }}
                                class="relative flex flex-col items-center gap-2 p-3 rounded-2xl border-2 transition-all
                                {{ $fineSelected ? 'border-orange-500 bg-orange-50' : 'border-gray-200 bg-white' }}
                                {{ $fineDisabled ? 'opacity-40 cursor-not-allowed' : 'active:scale-95' }}">
                            @if($fineSelected)
                            <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-orange-500 rounded-full flex items-center justify-center shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            @endif
                            <div class="w-11 h-11 rounded-xl {{ $fineSelected ? 'bg-orange-100' : 'bg-gray-100' }} flex items-center justify-center">
                                <span class="text-2xl">⚠️</span>
                            </div>
                            <span class="text-[11px] font-bold {{ $fineSelected ? 'text-orange-700' : 'text-gray-500' }}">{{ __lang('জরিমানা', 'Fine') }}</span>
                            <span class="text-[10px] font-bold {{ $fineSelected ? 'text-orange-600' : 'text-gray-400' }}">
                                @if(($currentMonthData['fine_amount'] ?? 0) > 0)
                                    ৳{{ number_format($currentMonthData['fine_amount'], 0) }}
                                @else
                                    {{ __lang('পরিমাণ লিখুন', 'Enter amount') }}
                                @endif
                            </span>
                        </button>

                    </div>
                </div>
                @endif {{-- end !pendingThisMonth --}}

                <!-- Per-type Amount Fields + Payment + Submit — hidden if pending -->
                @if(!$pendingThisMonth)

                <!-- Per-type Amount Fields (shows when selected) -->
                @if(count($selectedTypes) > 0)
                <div class="space-y-2.5">

                    @if(in_array('deposit', $selectedTypes))
                    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-2.5">
                        <span class="text-xl flex-shrink-0">💰</span>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wide">{{ __lang('জমার পরিমাণ', 'DEPOSIT AMOUNT') }}</p>
                            <input type="number" wire:model.live="depositAmount"
                                   class="w-full bg-transparent text-[15px] font-extrabold text-emerald-800 focus:outline-none border-b border-emerald-300 focus:border-emerald-500 py-0.5 transition"
                                   placeholder="0" min="0" />
                        </div>
                        <span class="text-[13px] font-bold text-emerald-600 flex-shrink-0">৳</span>
                    </div>
                    @endif

                    @if(in_array('due', $selectedTypes))
                    <div class="flex items-center gap-3 bg-red-50 border border-red-200 rounded-xl px-4 py-2.5">
                        <span class="text-xl flex-shrink-0">📋</span>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-red-600 uppercase tracking-wide">{{ __lang('বকেয়া পরিমাণ', 'DUE AMOUNT') }}</p>
                            <input type="number" wire:model.live="dueAmount"
                                   class="w-full bg-transparent text-[15px] font-extrabold text-red-800 focus:outline-none border-b border-red-300 focus:border-red-500 py-0.5 transition"
                                   placeholder="0" min="0" />
                        </div>
                        <span class="text-[13px] font-bold text-red-600 flex-shrink-0">৳</span>
                    </div>
                    @endif

                    @if(in_array('fine', $selectedTypes))
                    <div class="flex items-center gap-3 bg-orange-50 border border-orange-200 rounded-xl px-4 py-2.5">
                        <span class="text-xl flex-shrink-0">⚠️</span>
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-orange-600 uppercase tracking-wide">{{ __lang('জরিমানার পরিমাণ', 'FINE AMOUNT') }}</p>
                            <input type="number" wire:model.live="fineAmount"
                                   class="w-full bg-transparent text-[15px] font-extrabold text-orange-800 focus:outline-none border-b border-orange-300 focus:border-orange-500 py-0.5 transition"
                                   placeholder="0" min="0" />
                        </div>
                        <span class="text-[13px] font-bold text-orange-600 flex-shrink-0">৳</span>
                    </div>
                    @endif

                    <!-- Total -->
                    <div class="bg-gray-800 rounded-xl px-4 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">{{ __lang('মোট পরিমাণ', 'TOTAL AMOUNT') }}</p>
                            <p class="text-[11px] text-gray-400">
                                {{ implode(' + ', array_map(fn($t) => ucfirst($t), $selectedTypes)) }}
                            </p>
                        </div>
                        <p class="text-[20px] font-extrabold text-white">৳{{ number_format($this->totalAmount, 0) }}</p>
                    </div>

                </div>
                @endif

                <!-- Payment Method -->
                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-2 block">{{ __lang('পেমেন্ট পদ্ধতি', 'Payment Method') }}</label>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach($paymentOptions as $option)
                        <button wire:click="$set('paymentMethod', '{{ $option['value'] }}')"
                                class="flex flex-col items-center gap-1 py-2.5 px-1 rounded-xl border-2 transition-all
                                {{ $paymentMethod === $option['value'] ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 bg-white' }}">
                            <span class="text-lg">{{ explode(' ', $option['label'])[0] }}</span>
                            <span class="text-[10px] font-bold {{ $paymentMethod === $option['value'] ? 'text-emerald-700' : 'text-gray-500' }}">{{ explode(' ', $option['label'])[1] }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Transaction ID -->
                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 block">
                        Transaction ID <span class="text-gray-300 font-normal normal-case">(ঐচ্ছিক)</span>
                    </label>
                    <input type="text" wire:model="transactionId"
                           placeholder="{{ __lang('যদি থাকে লিখুন...', 'If available, enter...') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-white transition" />
                </div>

                <!-- Screenshot -->
                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 block">
                        Payment Screenshot <span class="text-gray-300 font-normal normal-case">(ঐচ্ছিক)</span>
                    </label>
                    @if($screenshot)
                    <div class="relative mb-2">
                        <img src="{{ $screenshot->temporaryUrl() }}" class="w-full h-40 object-cover rounded-xl border border-gray-200" />
                        <button wire:click="$set('screenshot', null)"
                                class="absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    @else
                    <label class="cursor-pointer block">
                        <div class="border-2 border-dashed border-gray-200 rounded-2xl py-6 flex flex-col items-center gap-2 bg-gray-50 active:bg-gray-100 transition">
                            <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                                </svg>
                            </div>
                            <p class="text-[12px] font-semibold text-gray-500">{{ __lang('ছবি আপলোড করুন', 'Upload image') }}</p>
                            <p class="text-[10px] text-gray-400">JPG, PNG · Max 5MB</p>
                        </div>
                        <input type="file" wire:model="screenshot" accept="image/*" class="sr-only" />
                    </label>
                    @endif
                    @error('screenshot') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Note -->
                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 block">
                        Note <span class="text-gray-300 font-normal normal-case">(ঐচ্ছিক)</span>
                    </label>
                    <textarea wire:model="note" rows="3"
                              placeholder="{{ __lang('কোনো বিশেষ তথ্য থাকলে লিখুন...', 'Enter any special information...') }}"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:bg-white transition resize-none"></textarea>
                </div>

                <!-- Submit Button -->
                <button wire:click="submitRequest"
                        wire:loading.attr="disabled"
                        {{ empty($selectedTypes) ? 'disabled' : '' }}
                        class="w-full font-bold py-4 rounded-2xl transition active:scale-[0.98] text-[15px] flex items-center justify-center gap-2 shadow-lg
                        {{ empty($selectedTypes) ? 'bg-gray-200 text-gray-400 cursor-not-allowed shadow-none' : 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-200' }}">
                    <span wire:loading.remove wire:target="submitRequest">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                        </svg>
                    </span>
                    <span wire:loading wire:target="submitRequest">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </span>
                    {{ empty($selectedTypes) ? __lang('প্রথমে একটি ধরন নির্বাচন করুন', 'Please select a type first') : __lang('আবেদন পাঠান', 'Send Request') . ' · ৳' . number_format($this->totalAmount, 0) }}
                </button>

                @endif {{-- end !pendingThisMonth (amount+payment+submit) --}}

            </div>

        </div>
        @endif

        {{-- ===== Recent Requests — separate card ===== --}}
        @if(count($previousRequests) > 0)
        <div class="rounded-2xl shadow-sm overflow-hidden pb-2" style="border: 2px solid #34d399; background: #ffffff;">
            {{-- Card Header --}}
            <div class="px-4 py-3 flex items-center justify-between" style="border-bottom: 1px solid #bbf7d0; background: rgba(52,211,153,0.15);">
                <p class="text-[13px] font-extrabold text-gray-800">{{ __lang('সাম্প্রতিক আবেদন', 'Recent Requests') }}</p>
                <span class="text-[10px] font-bold text-gray-400">{{ count($previousRequests) }} records</span>
            </div>

            <div class="divide-y divide-gray-50">
                @foreach($previousRequests as $req)
                @php
                    $isCombined  = $req['request_type'] === 'combined';
                    $typeIcon    = match($req['request_type']) { 'deposit' => '💰', 'due' => '📋', 'fine' => '⚠️', default => '🔗' };
                    $typeBg      = match($req['request_type']) { 'deposit' => 'bg-emerald-50 text-emerald-700', 'due' => 'bg-red-50 text-red-700', 'fine' => 'bg-orange-50 text-orange-700', default => 'bg-indigo-50 text-indigo-700' };
                    $rowBorderStyle = match($req['status']) {
                        'pending'  => 'border-left: 4px solid #fbbf24;',
                        'approved' => 'border-left: 4px solid #34d399;',
                        'rejected' => 'border-left: 4px solid #f87171;',
                        default    => '',
                    };
                    $statusColor = match($req['status']) {
                        'pending'  => 'text-amber-600 bg-amber-50 border-amber-300',
                        'approved' => 'text-emerald-600 bg-emerald-50 border-emerald-300',
                        'rejected' => 'text-red-600 bg-red-50 border-red-300',
                        default    => 'text-gray-500 bg-gray-50 border-gray-200',
                    };
                    $statusLabel = match($req['status']) { 'pending' => '⏳ Pending', 'approved' => '✅ Approved', 'rejected' => '⛔ Rejected', default => $req['status'] };
                    $monthLabel  = \Carbon\Carbon::parse($req['month_year'] . '-01')->format('M Y');
                @endphp
                <div wire:click="showDetail({{ $req['id'] }})"
                     class="px-4 py-3.5 flex items-center gap-3 cursor-pointer active:bg-gray-50 transition"
                     style="{{ $rowBorderStyle }}">
                    <div class="w-9 h-9 rounded-xl {{ explode(' ', $typeBg)[0] }} flex items-center justify-center flex-shrink-0 text-lg border border-gray-100">
                        {{ $typeIcon }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <p class="text-[13px] font-bold text-gray-800">{{ $monthLabel }}</p>
                            <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-md {{ $typeBg }}">
                                {{ ucfirst($req['request_type']) }}
                                @if($isCombined)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 inline ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                @endif
                            </span>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-0.5">{{ $req['payment_method'] }} · {{ \Carbon\Carbon::parse($req['created_at'])->format('d M, h:i A') }}</p>
                        @if($req['admin_remark'])
                        <p class="text-[10px] text-red-500 mt-0.5 font-semibold">{{ $req['admin_remark'] }}</p>
                        @endif
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-[13px] font-extrabold text-gray-700">৳{{ number_format($req['amount'], 0) }}</p>
                        <span class="text-[10px] font-bold border px-2 py-0.5 rounded-lg {{ $statusColor }}">{{ $statusLabel }}</span>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        @endif

    </div>

    <x-mobile.footer active="deposit" />

    {{-- ===== Detail Popup (Bottom Sheet) ===== --}}
    @if($detailPopup && $detailRequest)
    <div class="fixed inset-0 z-50 flex flex-col justify-end" wire:click="closeDetail">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

        {{-- Sheet --}}
        <div class="relative bg-white rounded-t-3xl shadow-2xl pb-8 max-h-[85vh] overflow-y-auto"
             wire:click.stop>

            {{-- Handle --}}
            <div class="flex justify-center pt-3 pb-1">
                <div class="w-10 h-1.5 bg-gray-200 rounded-full"></div>
            </div>

            {{-- Header --}}
            <div class="px-5 pt-2 pb-4 flex items-center justify-between border-b border-gray-100">
                <div>
                    <p class="text-[15px] font-extrabold text-gray-900">{{ __lang('আবেদনের বিস্তারিত', 'Request Details') }}</p>
                    <p class="text-[12px] text-gray-400">{{ $detailRequest['month_label'] }}</p>
                </div>
                @php
                    $sc = match($detailRequest['status']) {
                        'pending'  => 'text-amber-600 bg-amber-50 border-amber-200',
                        'approved' => 'text-emerald-600 bg-emerald-50 border-emerald-200',
                        'rejected' => 'text-red-600 bg-red-50 border-red-200',
                        default    => 'text-gray-600 bg-gray-50 border-gray-200',
                    };
                    $sl = match($detailRequest['status']) {
                        'pending'  => '⏳ Pending',
                        'approved' => '✅ Approved',
                        'rejected' => '⛔ Rejected',
                        default    => $detailRequest['status'],
                    };
                @endphp
                <span class="text-[11px] font-bold border px-3 py-1 rounded-xl {{ $sc }}">{{ $sl }}</span>
            </div>

            {{-- Breakdown --}}
            <div class="px-5 pt-4 space-y-3">

                {{-- Amount chips --}}
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">{{ __lang('পেমেন্ট বিবরণী', 'PAYMENT DETAILS') }}</p>
                <div class="grid grid-cols-3 gap-2.5">
                    @if($detailRequest['deposit_amount'] > 0)
                    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-3 text-center">
                        <span class="text-2xl block mb-1">💰</span>
                        <p class="text-[9px] font-bold text-emerald-600 uppercase">জমা</p>
                        <p class="text-[14px] font-extrabold text-emerald-700">৳{{ number_format($detailRequest['deposit_amount'], 0) }}</p>
                    </div>
                    @else
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-3 text-center opacity-30">
                        <span class="text-2xl block mb-1">💰</span>
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Deposit</p>
                        <p class="text-[12px] font-bold text-gray-300">—</p>
                    </div>
                    @endif

                    @if($detailRequest['due_amount'] > 0)
                    <div class="bg-red-50 border border-red-200 rounded-2xl p-3 text-center">
                        <span class="text-2xl block mb-1">📋</span>
                        <p class="text-[9px] font-bold text-red-600 uppercase">বকেয়া</p>
                        <p class="text-[14px] font-extrabold text-red-700">৳{{ number_format($detailRequest['due_amount'], 0) }}</p>
                    </div>
                    @else
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-3 text-center opacity-30">
                        <span class="text-2xl block mb-1">📋</span>
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Due</p>
                        <p class="text-[12px] font-bold text-gray-300">—</p>
                    </div>
                    @endif

                    @if($detailRequest['fine_amount'] > 0)
                    <div class="bg-orange-50 border border-orange-200 rounded-2xl p-3 text-center">
                        <span class="text-2xl block mb-1">⚠️</span>
                        <p class="text-[9px] font-bold text-orange-600 uppercase">জরিমানা</p>
                        <p class="text-[14px] font-extrabold text-orange-700">৳{{ number_format($detailRequest['fine_amount'], 0) }}</p>
                    </div>
                    @else
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-3 text-center opacity-30">
                        <span class="text-2xl block mb-1">⚠️</span>
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Fine</p>
                        <p class="text-[12px] font-bold text-gray-300">—</p>
                    </div>
                    @endif
                </div>

                {{-- Total --}}
                <div class="bg-gray-900 rounded-2xl px-4 py-3 flex items-center justify-between">
                    <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wide">মোট পরিমাণ</p>
                    <p class="text-[20px] font-extrabold text-white">৳{{ number_format($detailRequest['amount'], 0) }}</p>
                </div>

                {{-- Payment info --}}
                <div class="bg-gray-50 rounded-2xl px-4 py-3 space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-[11px] text-gray-400 font-semibold">{{ __lang('পেমেন্ট পদ্ধতি', 'Payment Method') }}</span>
                        <span class="text-[12px] font-bold text-gray-700">{{ $detailRequest['payment_method'] }}</span>
                    </div>
                    @if($detailRequest['transaction_id'])
                    <div class="flex justify-between items-center">
                        <span class="text-[11px] text-gray-400 font-semibold">Transaction ID</span>
                        <span class="text-[11px] font-mono font-bold text-gray-700">{{ $detailRequest['transaction_id'] }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between items-center">
                        <span class="text-[11px] text-gray-400 font-semibold">{{ __lang('জমা দেওয়া হয়েছে', 'Submitted') }}</span>
                        <span class="text-[11px] font-bold text-gray-700">{{ $detailRequest['created_at'] }}</span>
                    </div>
                </div>

                {{-- Screenshot --}}
                @if($detailRequest['screenshot'])
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-2">{{ __lang('পেমেন্টের প্রমাণ', 'PAYMENT PROOF') }}</p>
                    <a href="{{ asset('storage/'.$detailRequest['screenshot']) }}" target="_blank">
                        <img src="{{ asset('storage/'.$detailRequest['screenshot']) }}"
                             class="w-full rounded-2xl border border-gray-200 object-cover max-h-48" />
                    </a>
                </div>
                @endif

                {{-- Note --}}
                @if($detailRequest['note'])
                <div class="bg-blue-50 border border-blue-100 rounded-2xl px-4 py-3">
                    <p class="text-[10px] font-bold text-blue-400 uppercase tracking-wide mb-1">Note</p>
                    <p class="text-[13px] text-blue-700">{{ $detailRequest['note'] }}</p>
                </div>
                @endif

                {{-- Admin remark --}}
                @if($detailRequest['admin_remark'])
                <div class="bg-red-50 border border-red-100 rounded-2xl px-4 py-3">
                    <p class="text-[10px] font-bold text-red-400 uppercase tracking-wide mb-1">{{ __lang('অ্যাডমিনের মন্তব্য', 'ADMIN REMARK') }}</p>
                    <p class="text-[13px] text-red-700">{{ $detailRequest['admin_remark'] }}</p>
                </div>
                @endif

                {{-- Close button --}}
                <button wire:click="closeDetail"
                        class="w-full py-3.5 rounded-2xl bg-gray-100 text-gray-600 font-bold text-[14px] active:bg-gray-200 transition">
                    {{ __lang('বন্ধ করুন', 'Close') }}
                </button>

            </div>
        </div>
    </div>
    @endif

</div>
