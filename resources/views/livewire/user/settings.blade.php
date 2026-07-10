<div class="min-h-screen bg-gray-100 pb-24 font-sans">

    <x-mobile.user-header />

    <!-- Page Header -->
    <div class="bg-white px-4 py-3.5 flex items-center gap-3 border-b border-gray-100 sticky top-0 z-10">
        <a href="{{ url('mobile-dashboard') }}"
           class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-600 active:scale-90 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19 8 12l7-7"/>
            </svg>
        </a>
        <div class="flex-1">
            <h2 class="text-[15px] font-extrabold text-gray-900">{{ __lang('সেটিংস', 'Settings') }}</h2>
            <p class="text-[11px] text-gray-400">{{ __lang('আপনার অ্যাকাউন্ট পরিচালনা করুন', 'Manage your account') }}</p>
        </div>
    </div>

    <!-- Hero Card -->
    <div class="px-4 mt-3">
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <div>
                        <h3 class="text-xl font-extrabold">{{ __lang('অ্যাকাউন্ট সেটিংস', 'Account Settings') }}</h3>
                        <p class="text-xs text-emerald-100 font-bold mt-0.5">{{ __lang('আপনার অভিজ্ঞতা কাস্টমাইজ করুন', 'Customize your experience') }}</p>
                    </div>
                </div>
                <p class="text-sm text-emerald-50 font-medium mt-3 leading-relaxed">{{ __lang('এখান থেকে আপনার প্রোফাইল, নিরাপত্তা এবং পছন্দগুলি পরিচালনা করুন।', 'Manage your profile, security and preferences from here.') }}</p>
            </div>
        </div>
    </div>

    <!-- Account Settings -->
    <div class="px-4 mt-4">
        <h3 class="text-[14px] font-extrabold text-gray-800 mb-3">{{ __lang('অ্যাকাউন্ট', 'Account') }}</h3>
        <div class="space-y-3">
            
            <a href="{{ url('mobile-profile') }}" class="bg-white rounded-2xl shadow-sm border-2 border-emerald-200 p-4 flex items-center gap-3 active:scale-[0.98] transition">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-gray-800">{{ __lang('ব্যক্তিগত তথ্য', 'Personal Information') }}</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">{{ __lang('আপনার প্রোফাইল বিস্তারিত আপডেট করুন', 'Update your profile details') }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="{{ url('mobile-security') }}" class="bg-white rounded-2xl shadow-sm border-2 border-blue-200 p-4 flex items-center gap-3 active:scale-[0.98] transition">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-gray-800">{{ __lang('নিরাপত্তা ও পাসওয়ার্ড', 'Security & Password') }}</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">{{ __lang('অ্যাকাউন্ট নিরাপত্তা পরিচালনা করুন', 'Manage account security') }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

        </div>
    </div>

    <!-- Preferences -->
    <div class="px-4 mt-4">
        @if(session()->has('settings_success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl px-4 py-3.5 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-[13px] font-semibold text-emerald-700">{{ session('settings_success') }}</p>
        </div>
        @endif
        
        <h3 class="text-[14px] font-extrabold text-gray-800 mb-3">{{ __lang('পছন্দসমূহ', 'Preferences') }}</h3>
        
        <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 overflow-hidden">
            <div class="flex items-center gap-3 px-4 py-3.5 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-bold text-gray-700">{{ __lang('ভাষা', 'Language') }}</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">{{ $language === 'bn' ? 'বাংলা (বাংলাদেশ)' : 'English (US)' }}</p>
                </div>
                <div class="flex items-center bg-gray-100 rounded-full p-1 gap-1">
                    <button wire:click="setLanguage('bn')" 
                            wire:loading.attr="disabled"
                            wire:target="setLanguage"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition text-xs font-bold {{ $language === 'bn' ? 'bg-white shadow text-orange-500' : 'text-gray-400' }} disabled:opacity-50">
                        <span wire:loading.remove wire:target="setLanguage">বং</span>
                        <span wire:loading wire:target="setLanguage">⏳</span>
                    </button>
                    <button wire:click="setLanguage('en')"
                            wire:loading.attr="disabled"
                            wire:target="setLanguage"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition text-xs font-bold {{ $language === 'en' ? 'bg-white shadow text-orange-500' : 'text-gray-400' }} disabled:opacity-50">
                        <span wire:loading.remove wire:target="setLanguage">EN</span>
                        <span wire:loading wire:target="setLanguage">⏳</span>
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-3 px-4 py-3.5">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-bold text-gray-700">{{ __lang('থিম', 'Theme') }}</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">{{ $theme === 'dark' ? 'ডার্ক মোড' : 'লাইট মোড' }}</p>
                </div>
                <div class="flex items-center bg-gray-100 rounded-full p-1 gap-1">
                    <button wire:click="setTheme('light')"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition {{ $theme === 'light' ? 'bg-white shadow text-amber-500' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.375 3.375 0 11-7.5 0 3.375 3.375 0 017.5 0z"/>
                        </svg>
                    </button>
                    <button wire:click="setTheme('dark')"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition {{ $theme === 'dark' ? 'bg-gray-800 shadow text-indigo-300' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Support & About -->
    <div class="px-4 mt-4">
        <h3 class="text-[14px] font-extrabold text-gray-800 mb-3">{{ __lang('সহায়তা ও সম্পর্কে', 'Support & About') }}</h3>
        
        <div class="bg-white rounded-2xl shadow-sm border-2 border-teal-200 overflow-hidden">
            <a href="{{ url('mobile-support') }}" class="flex items-center gap-3 px-4 py-3.5 active:bg-gray-50 transition">
                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <p class="text-[13px] font-bold text-gray-700 flex-1">{{ __lang('সহায়তা কেন্দ্র', 'Support Center') }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="px-4 mt-5">
        <button onclick="confirm('আপনি কি নিশ্চিত যে আপনি লগআউট করতে চান?') && document.getElementById('logout-form').submit()" 
                class="w-full bg-red-500 hover:bg-red-600 text-white font-extrabold py-4 rounded-2xl shadow-lg text-[14px] transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            {{ __lang('লগআউট', 'Logout') }}
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <!-- Security Info -->
    <div class="px-4 mt-4 pb-4">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-emerald-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[12px] font-extrabold text-gray-800">{{ __lang('আপনার ডেটা নিরাপদ', 'Your data is safe') }}</p>
                    <p class="text-[10px] text-gray-500 font-medium mt-0.5">{{ __lang('আমাদের সাথে এনক্রিপ্ট করা এবং সুরক্ষিত', 'Encrypted and secure with us') }}</p>
                </div>
            </div>
        </div>
    </div>

    <x-mobile.footer active="settings" />

</div>
