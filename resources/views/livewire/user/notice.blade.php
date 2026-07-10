<div class="min-h-screen bg-gray-100 pb-24 font-sans">

    <x-mobile.user-header />

    <!-- ===== Page Title ===== -->
    <div class="bg-white px-4 py-3.5 flex items-center gap-3 border-b border-gray-100 shadow-sm sticky top-0 z-10">
        <a href="{{ url('mobile-dashboard') }}"
           class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition active:scale-90">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19 8 12l7-7"/>
            </svg>
        </a>
        <h2 class="text-base font-bold text-gray-800 flex-1">নোটিশ বোর্ড</h2>
        <span class="text-[11px] font-bold text-white bg-orange-500 px-2.5 py-1 rounded-full">৩টি অপঠিত</span>
    </div>

    <!-- ===== Notice List ===== -->
    <div class="px-4 mt-4 space-y-3">

        <!-- Unread Notice -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border-l-4 border-orange-400 flex items-start gap-3 active:scale-[0.99] transition cursor-pointer">
            <div class="w-11 h-11 rounded-2xl bg-orange-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 10.25A2.25 2.25 0 016.25 8h3.1c1.95 0 4.04-.83 6.27-2.5.9-.67 2.18-.03 2.18 1.1v10.8c0 1.13-1.28 1.77-2.18 1.1-2.23-1.67-4.32-2.5-6.27-2.5h-3.1A2.25 2.25 0 014 13.75v-3.5z"/>
                    <path d="M8.2 15.8l1.1 3.1a1.35 1.35 0 01-2.54.9L5.5 16.2h2.7z"/>
                    <path d="M20.25 8.55l1.45-.83a.85.85 0 11.85 1.47l-1.45.83a.85.85 0 01-.85-1.47zm.25 3.6h1.65a.85.85 0 010 1.7H20.5a.85.85 0 010-1.7zm.6 3.83l1.45.83a.85.85 0 11-.85 1.47l-1.45-.83a.85.85 0 01.85-1.47z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="text-sm font-extrabold text-gray-900 leading-tight">মাসিক কিস্তি জমার শেষ তারিখ</h4>
                    <span class="w-2.5 h-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                </div>
                <p class="text-xs text-gray-500 mt-1 leading-snug line-clamp-2">জুলাই মাসের কিস্তি জমার শেষ তারিখ ১০ আগস্ট ২০২৬। নির্ধারিত সময়ের মধ্যে জমা না দিলে জরিমানা প্রযোজ্য হবে।</p>
                <p class="text-[10px] text-gray-400 font-semibold mt-2">২ দিন আগে</p>
            </div>
        </div>

        <!-- Unread Notice -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border-l-4 border-blue-400 flex items-start gap-3 active:scale-[0.99] transition cursor-pointer">
            <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="text-sm font-extrabold text-gray-900 leading-tight">বার্ষিক সভার নোটিশ</h4>
                    <span class="w-2.5 h-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                </div>
                <p class="text-xs text-gray-500 mt-1 leading-snug line-clamp-2">আগামী ১৫ আগস্ট ২০২৬ তারিখে বার্ষিক সাধারণ সভা অনুষ্ঠিত হবে। সকল সদস্যকে উপস্থিত থাকার অনুরোধ করা হচ্ছে।</p>
                <p class="text-[10px] text-gray-400 font-semibold mt-2">৫ দিন আগে</p>
            </div>
        </div>

        <!-- Read Notice -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border-l-4 border-gray-200 flex items-start gap-3 active:scale-[0.99] transition cursor-pointer opacity-75">
            <div class="w-11 h-11 rounded-2xl bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm-1 14.5l-4-4 1.41-1.41L11 13.67l6.59-6.58L19 8.5l-8 8z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="text-sm font-bold text-gray-600 leading-tight">জুন মাসের কিস্তি গ্রহণ সম্পন্ন</h4>
                    <span class="text-[9px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">পঠিত</span>
                </div>
                <p class="text-xs text-gray-400 mt-1 leading-snug line-clamp-2">জুন মাসের সকল কিস্তি সফলভাবে গ্রহণ করা হয়েছে। ধন্যবাদ সকলকে।</p>
                <p class="text-[10px] text-gray-400 font-semibold mt-2">১০ দিন আগে</p>
            </div>
        </div>

        {{-- Empty State
        <div class="bg-white rounded-2xl shadow-sm p-8 flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 10.25A2.25 2.25 0 016.25 8h3.1c1.95 0 4.04-.83 6.27-2.5.9-.67 2.18-.03 2.18 1.1v10.8c0 1.13-1.28 1.77-2.18 1.1-2.23-1.67-4.32-2.5-6.27-2.5h-3.1A2.25 2.25 0 014 13.75v-3.5z"/>
                </svg>
            </div>
            <p class="text-sm text-gray-400 font-semibold">কোনো নোটিশ নেই</p>
        </div>
        --}}

    </div>

    <x-mobile.footer active="notice" />

</div>
