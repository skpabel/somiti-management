<div class="min-h-screen bg-gray-100 pb-24 font-sans">

    <x-mobile.user-header />

    <!-- Page Header -->
    <div class="bg-white px-4 py-3.5 flex items-center gap-3 border-b border-gray-100 sticky top-0 z-10">
        <a href="{{ url('mobile-settings') }}"
           class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-600 active:scale-90 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19 8 12l7-7"/>
            </svg>
        </a>
        <div class="flex-1">
            <h2 class="text-[15px] font-extrabold text-gray-900">{{ __lang('নিরাপত্তা ও পাসওয়ার্ড', 'Security & Password') }}</h2>
            <p class="text-[11px] text-gray-400">{{ __lang('আপনার অ্যাকাউন্ট নিরাপত্তা পরিচালনা করুন', 'Manage your account security') }}</p>
        </div>
    </div>

    <!-- Hero Card -->
    <div class="px-4 mt-3">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <div>
                        <h3 class="text-xl font-extrabold">{{ __lang('অ্যাকাউন্ট নিরাপত্তা', 'Account Security') }}</h3>
                        <p class="text-xs text-blue-100 font-bold mt-0.5">{{ __lang('আপনার অ্যাকাউন্ট নিরাপদ রাখুন', 'Keep your account secure') }}</p>
                    </div>
                </div>
                <p class="text-sm text-blue-50 font-medium mt-3 leading-relaxed">{{ __lang('আপনার অ্যাকাউন্ট সুরক্ষিত রাখতে নিয়মিত আপনার পাসওয়ার্ড আপডেট করুন।', 'Regularly update your password to keep your account secure.') }}</p>
            </div>
        </div>
    </div>

    <div class="px-4 mt-4 space-y-3">

        @if(session()->has('security_success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl px-4 py-3.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-[13px] font-semibold text-emerald-700">{{ session('security_success') }}</p>
        </div>
        @endif

        <!-- Account Info -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-teal-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-teal-100 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <p class="text-sm font-bold text-gray-700">অ্যাকাউন্ট তথ্য</p>
            </div>
            <div class="divide-y divide-gray-50">
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">ব্যবহারকারীর নাম</span>
                    <span class="text-xs font-semibold text-gray-700">{{ auth()->user()->username ?? auth()->user()->phone ?? 'N/A' }}</span>
                </div>
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">ভূমিকা</span>
                    <span class="text-xs font-semibold text-emerald-600 capitalize">{{ auth()->user()->role ?? 'user' }}</span>
                </div>
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">সদস্য হওয়ার তারিখ</span>
                    <span class="text-xs font-semibold text-gray-700">{{ $member->registration_date ? formatDate($member->registration_date) : 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Change Password Form -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-blue-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-blue-100 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 11-12 0 6 6 0 0112 0zM21 21l-5.2-5.2"/>
                </svg>
                <p class="text-sm font-bold text-gray-700">পাসওয়ার্ড পরিবর্তন</p>
            </div>

            <div class="p-4 space-y-3">

                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 block">বর্তমান পাসওয়ার্ড</label>
                    <input type="password" wire:model="current_password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition" />
                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 block">নতুন পাসওয়ার্ড</label>
                    <input type="password" wire:model="new_password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition" />
                    @error('new_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wide mb-1.5 block">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input type="password" wire:model="new_password_confirmation"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition" />
                </div>

                <button wire:click="updatePassword" wire:loading.attr="disabled"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl transition active:scale-[0.98] text-[14px] flex items-center justify-center gap-2 shadow-lg shadow-blue-200 mt-2">
                    <span wire:loading.remove wire:target="updatePassword">পাসওয়ার্ড আপডেট করুন</span>
                    <span wire:loading wire:target="updatePassword" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        আপডেট করা হচ্ছে...
                    </span>
                </button>
            </div>
        </div>

        <!-- Security Info -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-emerald-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[12px] font-extrabold text-gray-800">আপনার ডেটা নিরাপদ</p>
                    <p class="text-[10px] text-gray-500 font-medium mt-0.5">আমাদের সাথে এনক্রিপ্ট করা এবং সুরক্ষিত</p>
                </div>
            </div>
        </div>

    </div>

    <x-mobile.footer active="settings" />

</div>
