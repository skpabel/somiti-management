@props(['active' => 'home'])

@php
    $member = auth()->user()?->member;
    $activeLoan = $member
        ? \App\Models\Loan::where('member_id', $member->id)
            ->whereIn('status', ['disbursed', 'active'])
            ->latest()->first()
        : null;
    $loanUrl = url('mobile-loan');

    // Real unread notice count for footer badge (ALL sources)
    $unreadNoticeCount = 0;
    if ($member && class_exists(\App\Models\Notice::class) && class_exists(\App\Models\NoticeRead::class)) {
        // Get deleted notice IDs (to exclude completely)
        $deletedNoticeIds = \App\Models\NoticeRead::where('member_id', $member->id)
            ->whereNotNull('deleted_at')
            ->pluck('notice_id')
            ->toArray();
        
        $query = \App\Models\Notice::whereNotIn('id', $deletedNoticeIds) // Exclude deleted ones
            ->where(function($q) use ($member) {
                $q->where('target_group', 'all')
                  ->orWhere(function($q2) use ($member) {
                      $q2->whereIn('target_group', ['specific', 'custom'])
                         ->where(function($q3) use ($member) {
                             // Check both string and integer format in JSON
                             $q3->whereRaw("JSON_CONTAINS(target_member_ids, ?)", [json_encode((string)$member->id)])
                                ->orWhereRaw("JSON_CONTAINS(target_member_ids, ?)", [json_encode((int)$member->id)]);
                         });
                  });
            });
        
        // Get read but not deleted IDs
        $readNoticeIds = \App\Models\NoticeRead::where('member_id', $member->id)
            ->whereNull('deleted_at')
            ->pluck('notice_id')
            ->toArray();
        
        if (!empty($readNoticeIds)) {
            $query->whereNotIn('id', $readNoticeIds);
        }
        
        $unreadNoticeCount = $query->count();
    }

    $isHome    = $active === 'home';
    $isHistory = in_array($active, ['transaction','history']);
    $isDeposit = $active === 'deposit';
    $isLoan    = $active === 'loan';
    $isNotice  = in_array($active, ['notice','notifications']);
@endphp

<style>
/* ✅ Force Footer to Stay Fixed on ALL devices including iOS */
.mobile-footer-fixed {
    position: -webkit-sticky !important; /* iOS Safari support */
    position: sticky !important;
    position: fixed !important;
    bottom: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 9999 !important;
    transform: translate3d(0,0,0) !important; /* Hardware acceleration */
    -webkit-transform: translate3d(0,0,0) !important;
    backface-visibility: hidden !important;
    -webkit-backface-visibility: hidden !important;
}

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

.bell-shake {
    animation: bell-shake 1.5s ease-in-out infinite;
    transform-origin: top center;
}

.pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}
</style>

<div class="mobile-footer-fixed">
    <div class="relative mx-auto flex items-center max-w-md bg-white dark:bg-gray-900"
         style="height:68px; border-top: 1px solid #e2e8f0; box-shadow: 0 -4px 24px rgba(0,0,0,0.08); backdrop-filter: blur(10px); background: rgba(255,255,255,0.98);"
         class="dark:border-gray-700 dark:shadow-[0_-4px_24px_rgba(0,0,0,0.3)] dark:bg-gray-900/98">

        {{-- Home --}}
        <a href="{{ url('mobile-dashboard') }}"
           class="flex flex-1 flex-col items-center justify-center gap-1 h-full relative transition-all active:scale-95">
            @if($isHome)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-[3px] rounded-b-full" style="background:#10b981;"></span>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24"
                 fill="{{ $isHome ? '#10b981' : 'none' }}"
                 stroke="{{ $isHome ? '#10b981' : '#94a3b8' }}"
                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12L12 4l9 8"/>
                <path d="M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"/>
            </svg>
            <span class="text-[10px] font-{{ $isHome ? 'bold' : 'medium' }}"
                  style="color:{{ $isHome ? '#10b981' : '#94a3b8' }}">{{ __lang('হোম', 'Home') }}</span>
        </a>

        {{-- History --}}
        <a href="{{ url('mobile-history') }}"
           class="flex flex-1 flex-col items-center justify-center gap-1 h-full relative transition-all active:scale-95">
            @if($isHistory)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-[3px] rounded-b-full" style="background:#10b981;"></span>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24"
                 fill="none"
                 stroke="{{ $isHistory ? '#10b981' : '#94a3b8' }}"
                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <path d="M14 2v6h6"/>
                <path d="M8 13h8M8 17h5"/>
            </svg>
            <span class="text-[10px] font-{{ $isHistory ? 'bold' : 'medium' }}"
                  style="color:{{ $isHistory ? '#10b981' : '#94a3b8' }}">{{ __lang('ইতিহাস', 'History') }}</span>
        </a>

        {{-- Deposit — FAB center --}}
        <a href="{{ url('mobile-deposit-request') }}"
           class="flex flex-1 flex-col items-center justify-center gap-1 relative active:scale-95 transition-all"
           style="margin-top: -24px;">
            <span class="flex items-center justify-center rounded-2xl"
                  style="width:60px; height:60px;
                         background: linear-gradient(145deg, #10b981, #059669);
                         box-shadow: 0 8px 24px rgba(16,185,129,0.45);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="white">
                    <path d="M21.35 3.64a1.2 1.2 0 00-1.31-.26L3.7 10.18a1.15 1.15 0 00.08 2.15l6.17 2.05 2.05 6.18a1.15 1.15 0 002.15.08l6.82-16.34a1.2 1.2 0 00-.62-1.56z"/>
                </svg>
            </span>
            <span class="text-[10px] font-{{ $isDeposit ? 'bold' : 'medium' }}"
                  style="color:{{ $isDeposit ? '#10b981' : '#94a3b8' }}">{{ __lang('জমা', 'Deposit') }}</span>
        </a>

        {{-- Loan --}}
        <a href="{{ $loanUrl }}"
           class="flex flex-1 flex-col items-center justify-center gap-1 h-full relative transition-all active:scale-95">
            @if($isLoan)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-[3px] rounded-b-full" style="background:#10b981;"></span>
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24"
                 fill="none"
                 stroke="{{ $isLoan ? '#10b981' : '#94a3b8' }}"
                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2"/>
                <path d="M16 3H8L2 7h20L16 3z"/>
                <path d="M12 12v4M10 14h4"/>
            </svg>
            <span class="text-[10px] font-{{ $isLoan ? 'bold' : 'medium' }}"
                  style="color:{{ $isLoan ? '#10b981' : '#94a3b8' }}">{{ __lang('ঋণ', 'Loan') }}</span>
        </a>

        {{-- Notice --}}
        <a href="{{ url('mobile-notifications') }}"
           class="flex flex-1 flex-col items-center justify-center gap-1 h-full relative transition-all active:scale-95">
            @if($isNotice)
            <span class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-[3px] rounded-b-full" style="background:#10b981;"></span>
            @endif
            <div class="relative {{ $unreadNoticeCount > 0 ? 'pulse-glow' : '' }}" style="border-radius: 50%;">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-7 h-7 {{ $unreadNoticeCount > 0 ? 'bell-shake' : '' }}" 
                     viewBox="0 0 24 24"
                     fill="{{ $isNotice ? '#10b981' : ($unreadNoticeCount > 0 ? '#ef4444' : 'none') }}"
                     stroke="{{ $isNotice ? '#10b981' : ($unreadNoticeCount > 0 ? '#ef4444' : '#94a3b8') }}"
                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 9A6 6 0 106 9c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                </svg>
                @if($unreadNoticeCount > 0)
                <span class="absolute -top-1 -right-2 w-[18px] h-[18px] flex items-center justify-center rounded-full text-white text-[9px] font-bold"
                      style="background:#ef4444; border: 2px solid white; animation: pulse-glow 2s ease-in-out infinite;">
                    {{ $unreadNoticeCount > 9 ? '9+' : $unreadNoticeCount }}
                </span>
                @endif
            </div>
            <span class="text-[10px] font-{{ $isNotice ? 'bold' : 'medium' }}"
                  style="color:{{ $isNotice ? '#10b981' : ($unreadNoticeCount > 0 ? '#ef4444' : '#94a3b8') }}">{{ __lang('নোটিশ', 'Notice') }}</span>
        </a>

    </div>
</div>
