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
            <h2 class="text-[15px] font-extrabold text-gray-900">{{ __lang('সাহায্য ও সহায়তা', 'Help & Support') }}</h2>
            <p class="text-[11px] text-gray-400">{{ __lang('আমরা আপনাকে কিভাবে সাহায্য করতে পারি?', 'How can we help you?') }}</p>
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414 1 1 0 01-1.414-1.414z"/>
                    </svg>
                    <div>
                        <h3 class="text-xl font-extrabold">{{ __lang('সাহায্য প্রয়োজন?', 'Need Help?') }}</h3>
                        <p class="text-xs text-emerald-100 font-bold mt-0.5">{{ __lang('আমরা ২৪/৭ এখানে আছি', 'We are here 24/7') }}</p>
                    </div>
                </div>
                <p class="text-sm text-emerald-50 font-medium mt-3 leading-relaxed">{{ __lang('আমাদের দল থেকে তাৎক্ষণিক সহায়তা পান। সাহায্যের জন্য যেকোনো সময় আমাদের সাথে যোগাযোগ করুন।', 'Get instant support from our team. Contact us anytime for help.') }}</p>
            </div>
        </div>
    </div>

    <!-- Contact Cards -->
    <div class="px-4 mt-4">
        <h3 class="text-[14px] font-extrabold text-gray-800 mb-3">যোগাযোগ করুন</h3>
        <div class="space-y-3">

            <!-- Phone -->
            <a href="tel:+8801XXXXXXXXX" class="bg-white rounded-2xl shadow-sm border-2 border-emerald-200 p-4 flex items-center gap-3 active:scale-[0.98] transition">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-gray-800">আমাদের কল করুন</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">+880 1XXX-XXXXXX</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/8801XXXXXXXXX" class="bg-white rounded-2xl shadow-sm border-2 border-blue-200 p-4 flex items-center gap-3 active:scale-[0.98] transition">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-gray-800">WhatsApp</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">আমাদের সাথে তাৎক্ষণিক চ্যাট করুন</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <!-- Email -->
            <a href="mailto:support@somiti.com" class="bg-white rounded-2xl shadow-sm border-2 border-purple-200 p-4 flex items-center gap-3 active:scale-[0.98] transition">
                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-gray-800">আমাদের ইমেইল করুন</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">support@somiti.com</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <!-- Live Chat -->
            <a href="#" class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 p-4 flex items-center gap-3 active:scale-[0.98] transition">
                <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-gray-800">লাইভ চ্যাট</p>
                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">কথোপকথন শুরু করুন</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

        </div>
    </div>

    <!-- Quick Help -->
    <div class="px-4 mt-4">
        <h3 class="text-[14px] font-extrabold text-gray-800 mb-3">দ্রুত সাহায্য</h3>
        
        <div class="bg-white rounded-2xl shadow-sm border-2 border-teal-200 overflow-hidden">
            <a href="#" class="flex items-center gap-3 px-4 py-3.5 border-b border-gray-100 active:bg-gray-50 transition">
                <span class="text-2xl">💰</span>
                <p class="text-[13px] font-bold text-gray-700 flex-1">কিভাবে জমা দিতে হয়?</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3.5 border-b border-gray-100 active:bg-gray-50 transition">
                <span class="text-2xl">📊</span>
                <p class="text-[13px] font-bold text-gray-700 flex-1">জমার ইতিহাস চেক করুন</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3.5 border-b border-gray-100 active:bg-gray-50 transition">
                <span class="text-2xl">🏦</span>
                <p class="text-[13px] font-bold text-gray-700 flex-1">কিভাবে ঋণের জন্য আবেদন করবেন?</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3.5 active:bg-gray-50 transition">
                <span class="text-2xl">👤</span>
                <p class="text-[13px] font-bold text-gray-700 flex-1">প্রোফাইল তথ্য আপডেট করুন</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Support Hours -->
    <div class="px-4 mt-4 pb-4">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-indigo-200 p-4">
            <div class="flex items-start gap-3">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[13px] font-extrabold text-gray-800 mb-2">সহায়তার সময়</p>
                    <div class="space-y-1">
                        <p class="text-[11px] text-gray-600 font-medium">সোমবার - শুক্রবার: সকাল ৯:০০ - সন্ধ্যা ৬:০০</p>
                        <p class="text-[11px] text-gray-600 font-medium">শনিবার: সকাল ১০:০০ - বিকাল ৪:০০</p>
                        <p class="text-[11px] text-gray-600 font-medium">রবিবার: বন্ধ</p>
                    </div>
                    <div class="mt-3 flex items-center gap-2 bg-emerald-50 border border-emerald-200 rounded-xl px-3 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-[10px] text-emerald-700 font-bold">২ ঘন্টার মধ্যে উত্তর</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-mobile.footer active="home" />

</div>
