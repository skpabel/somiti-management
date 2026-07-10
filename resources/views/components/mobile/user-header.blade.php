@php
    $member     = auth()->user()->member;
    $orgName    = \App\Models\Setting::get('organization_name', 'Organization');
    $shortName  = collect(preg_split('/\s+/', trim($orgName)))->map(fn($w) => strtoupper($w[0] ?? ''))->implode('');
    $dateFormat = \App\Models\Setting::get('date_format', 'd M, Y');

    // ==========================================
    // TOP BELL COUNT = Deposit Notifications + Due/Fine + Overdue Repayments
    // ==========================================
    
    $topBellCount = 0;
    
    if ($member) {
        // 1. Unread Deposit/Loan Notifications (source = deposit_request OR loan_request)
        $depositLoanNotifCount = 0;
        if (class_exists(\App\Models\Notice::class) && class_exists(\App\Models\NoticeRead::class)) {
            // Get deleted notice IDs (to exclude completely)
            $deletedNoticeIds = \App\Models\NoticeRead::where('member_id', $member->id)
                ->whereNotNull('deleted_at')
                ->pluck('notice_id')
                ->toArray();
            
            // Get read but not deleted IDs
            $readNoticeIds = \App\Models\NoticeRead::where('member_id', $member->id)
                ->whereNull('deleted_at')
                ->pluck('notice_id')
                ->toArray();
            
            $query = \App\Models\Notice::whereIn('source', ['deposit_request', 'loan_request'])
                ->whereNotIn('id', $deletedNoticeIds) // Exclude deleted ones
                ->where(function($q) use ($member) {
                    $q->where('target_group', 'all')
                      ->orWhere(function($q2) use ($member) {
                          $q2->whereIn('target_group', ['specific', 'custom'])
                             ->where(function($q3) use ($member) {
                                 $q3->whereRaw("JSON_CONTAINS(target_member_ids, ?)", [json_encode((string)$member->id)])
                                    ->orWhereRaw("JSON_CONTAINS(target_member_ids, ?)", [json_encode((int)$member->id)]);
                             });
                      });
                });
            
            if (!empty($readNoticeIds)) {
                $query->whereNotIn('id', $readNoticeIds);
            }
            
            $depositLoanNotifCount = $query->count();
        }
        
        // 2. Unpaid Dues/Fines (draft deposits)
        $unpaidDuesCount = \App\Models\Deposit::where('member_id', $member->id)
            ->where('status', 'draft')
            ->count();
        
        $topBellCount = $depositLoanNotifCount + $unpaidDuesCount;
    }
    
    $notifCount = $topBellCount;
@endphp

<style>
@keyframes bell-shake {
    0%, 100% { transform: rotate(0deg); }
    10% { transform: rotate(15deg); }
    20% { transform: rotate(-12deg); }
    30% { transform: rotate(10deg); }
    40% { transform: rotate(-8deg); }
    50% { transform: rotate(5deg); }
    60% { transform: rotate(-3deg); }
    70% { transform: rotate(2deg); }
    80% { transform: rotate(-1deg); }
}

@keyframes pulse-glow {
    0%, 100% { 
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
    }
    50% { 
        box-shadow: 0 0 0 8px rgba(239, 68, 68, 0);
    }
}

@keyframes ping-pulse {
    0%, 100% { 
        transform: scale(1); 
        opacity: .8; 
    }
    50% { 
        transform: scale(1.9); 
        opacity: 0; 
    }
}

.bell-shake { 
    animation: bell-shake 1.5s ease-in-out infinite; 
    transform-origin: top center; 
}

.pulse-glow { 
    animation: pulse-glow 2s ease-in-out infinite; 
}

.ping-pulse { 
    animation: ping-pulse 1.5s ease-in-out infinite; 
}
</style>

<!-- ===== Top Navigation Bar ===== -->
<div class="bg-white px-4 py-3.5 flex items-center justify-between relative z-40
            shadow-[0_2px_12px_rgba(0,0,0,0.06)]">

    <!-- Left: Logo + Org Name -->
    <div class="flex items-center gap-2.5">
        <div class="w-10 h-10 rounded-2xl bg-emerald-600 flex items-center justify-center flex-shrink-0 shadow-sm">
            <span class="text-white text-xs font-extrabold tracking-tight">{{ $shortName }}</span>
        </div>
        <div class="leading-tight">
            <h1 class="text-[13px] font-extrabold text-gray-900">{{ $orgName }}</h1>
            <div class="flex items-center gap-1 mt-0.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <p class="text-[10px] text-emerald-600 font-semibold">Somiti Management</p>
            </div>
        </div>
    </div>

    <!-- Right: Bell + Avatar -->
    <div class="flex items-center gap-2">

        <!-- Bell -->
        <a href="{{ url('mobile-notifications') }}"
           class="relative flex h-9 w-9 items-center justify-center rounded-full transition active:scale-90
                  {{ $notifCount > 0 ? 'bg-red-50 pulse-glow' : 'bg-gray-100' }}"
           style="{{ $notifCount > 0 ? 'border-radius: 50%;' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 {{ $notifCount > 0 ? 'text-red-500 bell-shake' : 'text-gray-500' }}"
                 fill="{{ $notifCount > 0 ? '#ef4444' : 'none' }}" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor" 
                 stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                         a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341
                         C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436
                         L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if($notifCount > 0)
            <span class="ping-pulse absolute top-1.5 right-1.5 h-3 w-3 rounded-full bg-red-400"></span>
            <span class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] bg-red-500 text-white
                         text-[9px] font-extrabold rounded-full flex items-center justify-center px-1 shadow">
                {{ $notifCount }}
            </span>
            @endif
        </a>

        <!-- Avatar Dropdown -->
        <div class="relative" x-data="{ open: false, pwModal: false, pwCurrent: '', pwNew: '', pwConfirm: '', pwError: '', pwSuccess: false }" @click.outside="open = false">
            <button @click="open = !open"
                class="w-10 h-10 rounded-full border-2 border-emerald-500 overflow-hidden bg-emerald-50 flex items-center justify-center flex-shrink-0 active:scale-90 transition">
                @if($member && $member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover"/>
                @else
                    <span class="text-sm font-extrabold text-emerald-600">
                        {{ strtoupper($member->name_english[0] ?? 'U') }}
                    </span>
                @endif
            </button>

            <!-- Dropdown -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                 class="absolute right-0 top-12 w-56 rounded-2xl z-50 overflow-hidden shadow-[0_8px_40px_rgba(0,0,0,0.14)] border border-slate-100 bg-white"
                 style="display:none;">
                <div class="px-4 py-3 border-b border-gray-50">
                    <p class="text-[13px] font-bold text-gray-800 truncate">{{ $member->name_english ?? 'User' }}</p>
                    <p class="text-[11px] text-gray-400">{{ auth()->user()->username ?? '' }}</p>
                </div>
                <a href="{{ url('mobile-profile') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                    <div class="w-7 h-7 rounded-xl bg-emerald-50 flex items-center justify-center">
                        <x-heroicon-o-user class="w-4 h-4 text-emerald-500" />
                    </div>
                    <span class="text-[13px] font-medium text-gray-700">{{ __lang('প্রোফাইল', 'Profile') }}</span>
                </a>
                <a href="{{ url('mobile-settings') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                    <div class="w-7 h-7 rounded-xl bg-purple-50 flex items-center justify-center">
                        <x-heroicon-o-cog-6-tooth class="w-4 h-4 text-purple-500" />
                    </div>
                    <span class="text-[13px] font-medium text-gray-700">{{ __lang('সেটিংস', 'Settings') }}</span>
                </a>
                <button @click="open = false; pwModal = true" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition border-t border-gray-50">
                    <div class="w-7 h-7 rounded-xl bg-blue-50 flex items-center justify-center">
                        <x-heroicon-o-key class="w-4 h-4 text-blue-500" />
                    </div>
                    <span class="text-[13px] font-medium text-gray-700">{{ __lang('পাসওয়ার্ড পরিবর্তন', 'Change Password') }}</span>
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 transition border-t border-gray-50">
                        <div class="w-7 h-7 rounded-xl bg-red-50 flex items-center justify-center">
                            <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 text-red-500" />
                        </div>
                        <span class="text-[13px] font-medium text-red-500">{{ __lang('লগআউট', 'Logout') }}</span>
                    </button>
                </form>
            </div>

            <!-- Change Password Modal -->
            <div x-show="pwModal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="fixed inset-0 z-[60] flex items-center justify-center px-4"
                 style="display:none;">
                <div class="absolute inset-0 bg-black/50" @click="pwModal = false; pwError = ''"></div>
                <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center">
                                <x-heroicon-o-key class="w-4 h-4 text-blue-500" />
                            </div>
                            <p class="text-sm font-extrabold text-gray-800">{{ __lang('পাসওয়ার্ড পরিবর্তন', 'Change Password') }}</p>
                        </div>
                        <button @click="pwModal = false; pwError = ''" class="text-gray-400 hover:text-gray-600">
                            <x-heroicon-o-x-mark class="w-5 h-5" />
                        </button>
                    </div>
                    <div x-show="pwError" class="mb-3 flex items-center gap-2 bg-red-50 border border-red-100 rounded-xl px-3 py-2">
                        <x-heroicon-o-exclamation-circle class="w-4 h-4 text-red-500 flex-shrink-0" />
                        <p class="text-xs text-red-600 font-medium" x-text="pwError"></p>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs text-gray-400 font-medium mb-1 block">{{ __lang('বর্তমান পাসওয়ার্ড', 'Current Password') }}</label>
                            <input type="password" x-model="pwCurrent" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-emerald-400" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 font-medium mb-1 block">{{ __lang('নতুন পাসওয়ার্ড', 'New Password') }}</label>
                            <input type="password" x-model="pwNew" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-emerald-400" />
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 font-medium mb-1 block">{{ __lang('নিশ্চিত করুন', 'Confirm Password') }}</label>
                            <input type="password" x-model="pwConfirm" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-emerald-400" />
                        </div>
                        <button
                            @click="
                                pwError = '';
                                if (!pwCurrent || !pwNew || !pwConfirm) { pwError = 'সব ফিল্ড পূরণ করুন।'; return; }
                                if (pwNew.length < 6) { pwError = 'নতুন পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।'; return; }
                                if (pwNew !== pwConfirm) { pwError = 'পাসওয়ার্ড মিল হচ্ছে না।'; return; }
                                fetch('{{ route('user.change-password') }}', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ current_password: pwCurrent, new_password: pwNew })
                                }).then(r => r.json()).then(d => {
                                    if (d.success) {
                                        pwModal = false; pwCurrent = ''; pwNew = ''; pwConfirm = ''; pwError = '';
                                        pwSuccess = true;
                                        setTimeout(() => { pwSuccess = false; }, 2500);
                                    } else { pwError = d.message; }
                                });
                            "
                            class="w-full bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold py-2.5 rounded-xl transition">
                            {{ __lang('পাসওয়ার্ড আপডেট করুন', 'Update Password') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Success Toast -->
            <div x-show="pwSuccess"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="fixed inset-0 z-[70] flex items-center justify-center pointer-events-none"
                 style="display:none;">
                <div class="flex items-center gap-3 bg-white border border-emerald-100 shadow-2xl rounded-2xl px-6 py-5">
                    <x-heroicon-o-check-circle class="w-12 h-12 text-emerald-500" />
                    <div>
                        <p class="text-sm font-extrabold text-gray-800">{{ __lang('পাসওয়ার্ড পরিবর্তিত হয়েছে!', 'Password Changed!') }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ __lang('আপনার পাসওয়ার্ড সফলভাবে আপডেট হয়েছে।', 'Your password has been updated successfully.') }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
