<div class="min-h-screen bg-white pb-28 font-sans"
     x-data="{
        popup: false,
        item: {},
        open(data) {
            this.item = data;
            this.popup = true;
        }
     }">

    <x-mobile.user-header />

    {{-- ===== Header ===== --}}
    <div class="bg-white px-4 pt-4 pb-0 sticky top-0 z-30 border-b border-gray-100">

        {{-- Title row --}}
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
                <a href="{{ url('mobile-dashboard') }}"
                   class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-500 active:scale-90 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19 8 12l7-7"/>
                    </svg>
                </a>
                <p class="text-[16px] font-extrabold text-gray-900">{{ __lang('নোটিফিকেশন', 'Notifications') }}</p>
            </div>
            @if($this->unreadCount > 0)
            <span class="text-[11px] font-bold text-white bg-emerald-500 px-2.5 py-0.5 rounded-full">
                {{ $this->unreadCount }} {{ __lang('নতুন', 'New') }}
            </span>
            @endif
        </div>

        {{-- Filter Tabs --}}
        <div class="flex gap-0 overflow-x-auto scrollbar-hide">
            @php
                $tabs = [
                    'all'     => ['label' => __lang('সব', 'All'), 'count' => count($this->notifications)],
                    'unread'  => ['label' => __lang('অপঠিত', 'Unread'), 'count' => $this->unreadCount],
                    'deposit' => ['label' => __lang('জমা', 'Deposit'), 'count' => $this->depositCount],
                    'loan'    => ['label' => __lang('ঋণ', 'Loan'), 'count' => $this->loanCount],
                    'notice'  => ['label' => __lang('নোটিশ', 'Notice'), 'count' => $this->noticeCount],
                ];
            @endphp
            @foreach($tabs as $key => $tab)
            <button wire:click="setFilter('{{ $key }}')"
                    class="relative flex-shrink-0 px-4 py-2.5 text-[13px] font-semibold transition-colors
                           {{ $activeFilter === $key ? 'text-emerald-600' : 'text-gray-400' }}">
                {{ $tab['label'] }}
                @if($tab['count'] > 0 && $key !== 'all')
                <span class="ml-1 {{ $key === 'unread' ? 'bg-red-500' : 'bg-emerald-500' }} text-white text-[9px] font-extrabold px-1.5 py-0.5 rounded-full align-middle">{{ $tab['count'] }}</span>
                @endif
                @if($activeFilter === $key)
                <span class="absolute bottom-0 left-3 right-3 h-0.5 bg-emerald-500 rounded-full"></span>
                @endif
            </button>
            @endforeach
        </div>
    </div>

    {{-- ===== List ===== --}}
    <div class="px-4 mt-3 space-y-3">

        @forelse($this->filteredItems as $item)
        @php

            $titleColor = !$item['read'] ? 'text-gray-900' : 'text-gray-400';
            $iconColor = match($item['color']) {
                'orange' => !$item['read'] ? 'text-orange-500' : 'text-orange-300',
                'red'    => !$item['read'] ? 'text-red-500'    : 'text-red-300',
                'blue'   => !$item['read'] ? 'text-blue-500'   : 'text-blue-300',
                'green'  => !$item['read'] ? 'text-emerald-500': 'text-emerald-300',
                default  => !$item['read'] ? 'text-gray-500'   : 'text-gray-300',
            };
            $borderColor = match($item['color']) {
                'orange' => 'border-orange-300',
                'red'    => 'border-red-300',
                'blue'   => 'border-blue-300',
                'green'  => 'border-emerald-300',
                default  => 'border-gray-300',
            };
            $isNotice = $item['type'] === 'notice';
            $popupData = json_encode([
                'title'      => $item['title'],
                'message'    => $item['message'],
                'amount'     => $item['amount'] ?? null,
                'time'       => $item['time'] ?? null,
                'color'      => $item['color'],
                'type'       => $item['type'],
                'month_year' => $item['month_year'] ?? null,
                '_emoji'     => $item['_emoji'] ?? null,
            ]);
        @endphp

        <div @if($isNotice)
                 wire:click="markRead({{ $item['_id'] ?? 0 }}, '{{ $item['_src'] }}')"
             @endif
             @click="@if($item['type'] === 'deposit' && isset($item['month_year']))window.location.href='{{ url('mobile-deposit-request') }}?month={{ $item['month_year'] ?? '' }}'@else open({{ $popupData }})@endif"
             class="bg-white rounded-2xl border {{ !$item['read'] ? $borderColor . ' border-2' : 'border-gray-100' }} px-4 py-3.5 flex items-center gap-3 shadow-sm cursor-pointer active:scale-[0.98] transition-transform relative">

            {{-- Icon --}}
            <div class="flex-shrink-0">
                @if($item['type'] === 'deposit')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 {{ $iconColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                </svg>
                @elseif($item['type'] === 'loan')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 {{ $iconColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
                @elseif($item['type'] === 'notice')
                {{-- Notice: Use emoji from data --}}
                @php
                    $emoji = $item['_emoji'] ?? '📢';
                    $bgColor = match($item['color']) {
                        'red' => 'bg-red-100',
                        'purple' => 'bg-purple-100',
                        'blue' => 'bg-blue-100',
                        default => 'bg-gray-100',
                    };
                @endphp
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-2xl {{ !$item['read'] ? $bgColor : 'bg-gray-100' }}">
                    {{ $emoji }}
                </div>
                @elseif($item['color'] === 'blue')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 {{ $iconColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                </svg>
                @elseif($item['color'] === 'green')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 {{ $iconColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 {{ $iconColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
                @endif
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                @if($item['type'] === 'notice' && str_contains($item['message'], 'Dear'))
                    {{-- Notice with personalized format - Enhanced design --}}
                    @php
                        preg_match('/(Dear\s+[^(]+)\s*\((Acc#\d+),\s*(Share#[\d.]+)\)\s*(.*)/i', $item['message'], $match);
                        $hasMatch = !empty($match);
                        $name = $hasMatch ? trim(str_replace('Dear', '', $match[1])) : '';
                        $acc = $hasMatch ? $match[2] : '';
                        $share = $hasMatch ? $match[3] : '';
                        $actualMsg = $hasMatch ? trim($match[4]) : $item['message'];
                    @endphp
                    
                    @if($hasMatch)
                        {{-- Row 1: Title --}}
                        <p class="text-[13px] font-bold {{ $titleColor }} leading-snug truncate mb-1">{{ $item['title'] }}</p>
                        
                        {{-- Row 2: Compact info badges --}}
                        <div class="flex items-center gap-1.5 mb-1">
                            <div class="flex items-center gap-1 bg-emerald-50 border border-emerald-200 rounded-md px-2 py-0.5">
                                <span class="text-[10px] font-bold text-emerald-700">{{ $name }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="text-[9px] font-semibold text-emerald-600 bg-emerald-50 border border-emerald-200 rounded px-1.5 py-0.5">{{ $acc }}</span>
                                <span class="text-[9px] font-semibold text-emerald-600 bg-emerald-50 border border-emerald-200 rounded px-1.5 py-0.5">{{ $share }}</span>
                            </div>
                        </div>
                        
                        {{-- Row 3: Actual message + time --}}
                        <div class="flex items-center justify-between gap-2">
                            <p class="text-[12px] text-gray-600 leading-snug truncate">{{ $actualMsg }}</p>
                            @if(isset($item['time']) && $item['time'])
                            <p class="text-[11px] text-gray-400 whitespace-nowrap flex-shrink-0">{{ $item['time'] }}</p>
                            @endif
                        </div>
                    @else
                        {{-- Fallback to original design --}}
                        <div class="flex items-center justify-between gap-2">
                            <p class="text-[13px] font-bold {{ $titleColor }} leading-snug truncate">{{ $item['title'] }}</p>
                        </div>
                        <div class="flex items-center justify-between gap-2 mt-0.5">
                            <p class="text-[12px] text-gray-400 leading-snug">{{ $item['message'] }}</p>
                            @if(isset($item['time']) && $item['time'])
                            <p class="text-[11px] text-gray-400 whitespace-nowrap flex-shrink-0">{{ $item['time'] }}</p>
                            @endif
                        </div>
                    @endif
                @else
                    {{-- Original design for deposit/loan notifications --}}
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[13px] font-bold {{ $titleColor }} leading-snug truncate">{{ $item['title'] }}</p>
                        @if(isset($item['amount']) && $item['amount'])
                        <p class="text-[13px] font-extrabold {{ $iconColor }} whitespace-nowrap flex-shrink-0">{{ $item['amount'] }}</p>
                        @endif
                    </div>
                    <div class="flex items-center justify-between gap-2 mt-0.5">
                        <p class="text-[12px] text-gray-400 leading-snug">{{ $item['message'] }}</p>
                        @if(isset($item['time']) && $item['time'])
                        <p class="text-[11px] text-gray-400 whitespace-nowrap flex-shrink-0">{{ $item['time'] }}</p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Delete Button (only for notice type) --}}
            @if($item['type'] === 'notice')
            <button wire:click.stop="deleteNotice({{ $item['_id'] ?? 0 }})" 
                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-red-50 text-red-500 hover:bg-red-100 active:scale-90 transition-all"
                    title="{{ __lang('নোটিশ মুছে দিন', 'Delete Notice') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
            @endif

        </div>

        @empty

        <div class="flex flex-col items-center justify-center py-20 px-8 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <p class="text-[14px] font-bold text-gray-500">{{ __lang('কোনো নোটিফিকেশন নেই', 'No notifications') }}</p>
            <p class="text-[12px] text-gray-400 mt-1">{{ __lang('সব আপডেট দেখা হয়েছে!', 'All updates have been seen!') }}</p>
        </div>

        @endforelse

    </div>

    {{-- ===== Detail Popup ===== --}}
    <div x-show="popup"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="popup = false"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-5"
         style="display:none">

        <div x-show="popup"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="w-full max-w-sm bg-white rounded-3xl px-5 pt-6 pb-6 shadow-2xl">

            {{-- Icon + Title --}}
            <div class="flex items-start gap-3 mb-4">
                <div class="flex-shrink-0 mt-0.5">
                    <template x-if="item.type === 'deposit'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                             :class="item.color === 'orange' ? 'text-orange-500' : item.color === 'red' ? 'text-red-500' : item.color === 'blue' ? 'text-blue-500' : 'text-emerald-500'">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                        </svg>
                    </template>
                    <template x-if="item.type === 'loan'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                             :class="item.color === 'red' ? 'text-red-500' : 'text-blue-500'">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                        </svg>
                    </template>
                    <template x-if="item.type === 'notice'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-2xl"
                             :class="item.color === 'red' ? 'bg-red-100' : item.color === 'purple' ? 'bg-purple-100' : item.color === 'blue' ? 'bg-blue-100' : 'bg-gray-100'"
                             x-text="item._emoji || '📢'">
                        </div>
                    </template>
                </div>
                <div class="flex-1">
                    <p class="text-[15px] font-extrabold text-gray-900 leading-snug" x-text="item.title"></p>
                    <p class="text-[11px] text-gray-400 mt-0.5" x-show="item.time" x-text="item.time"></p>
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 mb-4"></div>

            {{-- Message + Amount centered --}}
            <div class="flex flex-col items-center justify-center py-2 gap-3">
                {{-- Personalized greeting card (if exists) --}}
                <div x-show="item.message && item.message.includes('Dear')"
                     x-data="{
                         getParts() {
                             let msg = item.message || '';
                             let regex = /(Dear\s+[^(]+)\s*\((Acc#\d+),\s*(Share#[\d.]+)\)\s*(.*)/i;
                             let match = msg.match(regex);
                             if (match) {
                                 return {
                                     greeting: match[1].trim(),
                                     name: match[1].replace('Dear', '').trim(),
                                     acc: match[2],
                                     share: match[3],
                                     message: match[4].trim()
                                 };
                             }
                             return null;
                         }
                     }"
                     class="w-full">
                    <template x-if="getParts()">
                        <div class="bg-gradient-to-br from-emerald-50 to-green-50 border-2 border-emerald-200 rounded-2xl p-4 shadow-sm">
                            {{-- Greeting header --}}
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-lg shadow-md"
                                     x-text="getParts().name.charAt(0).toUpperCase()">
                                </div>
                                <div class="flex-1">
                                    <p class="text-[11px] text-emerald-600 font-semibold uppercase tracking-wide">{{ __lang('প্রিয়', 'Dear') }}</p>
                                    <p class="text-[15px] font-extrabold text-emerald-900 leading-tight" x-text="getParts().name"></p>
                                </div>
                            </div>
                            
                            {{-- Account & Share badges --}}
                            <div class="flex gap-2 mb-3">
                                <div class="flex-1 bg-white rounded-lg px-3 py-2 border border-emerald-200">
                                    <p class="text-[9px] text-emerald-600 font-bold uppercase">Account</p>
                                    <p class="text-[13px] font-extrabold text-emerald-900" x-text="getParts().acc"></p>
                                </div>
                                <div class="flex-1 bg-white rounded-lg px-3 py-2 border border-emerald-200">
                                    <p class="text-[9px] text-emerald-600 font-bold uppercase">Shares</p>
                                    <p class="text-[13px] font-extrabold text-emerald-900" x-text="getParts().share"></p>
                                </div>
                            </div>
                            
                            {{-- Actual message --}}
                            <div class="bg-white rounded-xl p-3 border border-emerald-200">
                                <p class="text-[13px] text-gray-700 leading-relaxed" x-text="getParts().message"></p>
                            </div>
                        </div>
                    </template>
                </div>
                
                {{-- Fallback for messages without "Dear" pattern --}}
                <p x-show="!item.message || !item.message.includes('Dear')" 
                   class="text-[13px] text-gray-600 leading-relaxed text-center" 
                   x-text="item.message"></p>
                
                {{-- Amount display --}}
                <p x-show="item.amount"
                   class="text-[22px] font-extrabold mt-1"
                   :class="item.color === 'orange' ? 'text-orange-500' : item.color === 'red' ? 'text-red-500' : item.color === 'blue' ? 'text-blue-500' : 'text-emerald-500'"
                   x-text="item.amount"></p>
            </div>

            {{-- Request button (deposit only) --}}
            <template x-if="item.type === 'deposit'">
                <div class="mt-4 p-3 rounded-2xl bg-gray-50 border border-gray-100">
                    <p class="text-[12px] text-gray-500 leading-relaxed">{{ __lang('যদি আপনি ইতিমধ্যে পরিশোধ করে থাকেন, তাহলে একটি জমার আবেদন দিন যাতে অ্যাডমিন যাচাই করতে পারেন।', 'If you have already paid, submit a deposit request so admin can verify.') }}</p>
                    <button @click="window.location.href = '{{ url('mobile-deposit-request') }}?month=' + item.month_year"
                            class="mt-3 w-full py-2.5 rounded-xl bg-emerald-500 text-white text-[13px] font-bold active:scale-95 transition">
                        📬 {{ __lang('জমার আবেদন দিন', 'Submit Deposit Request') }}
                    </button>
                </div>
            </template>

            {{-- Loan button --}}
            <template x-if="item.type === 'loan'">
                <div class="mt-4 p-3 rounded-2xl bg-gray-50 border border-gray-100">
                    <p class="text-[12px] text-gray-500 leading-relaxed">{{ __lang('অনুগ্রহ করে অ্যাডমিনের সাথে যোগাযোগ করুন বা আপনার কিস্তি জমা দিন।', 'Please contact admin or submit your installment.') }}</p>
                    <button @click="window.location.href = '{{ url('mobile-loan') }}'"
                            class="mt-3 w-full py-2.5 rounded-xl text-white text-[13px] font-bold active:scale-95 transition"
                            style="background:#f97316;">
                        🏦 {{ __lang('ঋণের বিস্তারিত দেখুন', 'View Loan Details') }}
                    </button>
                </div>
            </template>

            {{-- Close button --}}
            <button @click="popup = false"
                    class="mt-3 w-full py-3 rounded-2xl bg-gray-100 text-[13px] font-bold text-gray-600 active:scale-95 transition">
                {{ __lang('বন্ধ করুন', 'Close') }}
            </button>

        </div>
    </div>

    <x-mobile.footer active="notice" />
</div>
