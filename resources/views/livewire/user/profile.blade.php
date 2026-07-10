<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white pb-28 font-sans">

    <x-mobile.user-header />

    <!-- ===== Profile Hero Section ===== -->
    <div class="relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-700"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 px-4 pt-6 pb-8">
            <!-- Profile Card -->
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-emerald-900/20 p-6 border border-white/50">
                <div class="flex items-start gap-4">
                    <!-- Avatar -->
                    <div class="relative flex-shrink-0">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-400 to-emerald-600 shadow-lg shadow-emerald-500/30 ring-4 ring-white/50">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" class="w-full h-full object-cover" alt="Profile"/>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-3xl font-black text-white">{{ strtoupper($member->name_english[0] ?? 'U') }}</span>
                                </div>
                            @endif
                        </div>
                        <!-- Status Badge -->
                        <div class="absolute -bottom-1.5 -right-1.5 w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <h1 class="text-xl font-black text-gray-900 leading-tight mb-0.5 truncate">{{ $member->name_english }}</h1>
                        @if($member->name_bangla)
                        <p class="text-sm text-gray-500 font-medium mb-2">{{ $member->name_bangla }}</p>
                        @endif
                        
                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/>
                                </svg>
                                <span class="text-xs font-bold">{{ $member->account_no }}</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-blue-50 border border-blue-200 text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                                </svg>
                                <span class="text-xs font-bold">{{ number_format($member->shares, 2) }} Share</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Read-only Notice -->
                <div class="mt-4 flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-xl px-3 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                    <p class="text-[11px] text-amber-800 font-semibold">{{ __lang('প্রোফাইল শুধুমাত্র পঠনযোগ্য। পরিবর্তনের জন্য অ্যাডমিনের সাথে যোগাযোগ করুন।', 'Profile is read-only. Contact admin for changes.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 mt-4 space-y-3">

        <!-- Personal Information -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-emerald-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-emerald-100 flex items-center gap-2">
                <x-heroicon-o-user class="w-4 h-4 text-emerald-500" />
                <p class="text-sm font-bold text-gray-700">{{ __lang('ব্যক্তিগত তথ্য', 'Personal Information') }}</p>
            </div>
            <div class="divide-y divide-gray-50">
                @php
                    $rows = [
                        ['label' => 'Mobile',  'value' => $member->mobile],
                        ['label' => __lang('লিঙ্গ', 'Gender'), 'value' => $member->gender],
                        ['label' => __lang('জাতীয় পরিচয়পত্র', 'National ID'), 'value' => $member->nid ?: __lang('সেট করা হয়নি', 'Not set')],
                        ['label' => __lang('জন্ম তারিখ', 'Date of Birth'), 'value' => $member->dob ? \formatDate($member->dob) : __lang('সেট করা হয়নি', 'Not set')],
                    ];
                @endphp
                @foreach($rows as $row)
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">{{ $row['label'] }}</span>
                    <span class="text-xs font-semibold text-gray-700">{{ $row['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Share & Registration -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-blue-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-blue-100 flex items-center gap-2">
                <x-heroicon-o-chart-bar class="w-4 h-4 text-emerald-500" />
                <p class="text-sm font-bold text-gray-700">{{ __lang('শেয়ার ও নিবন্ধন', 'Share & Registration') }}</p>
            </div>
            <div class="divide-y divide-gray-50">
                @php
                    $rows = [
                        ['label' => __lang('শেয়ার', 'Shares'), 'value' => number_format($member->shares, 2)],
                        ['label' => __lang('নিবন্ধন ফি', 'Registration Fee'), 'value' => '৳' . number_format($member->registration_fee, 0)],
                        ['label' => __lang('নিবন্ধনের তারিখ', 'Registration Date'), 'value' => $member->registration_date ? \formatDate($member->registration_date) : __lang('সেট করা হয়নি', 'Not set')],
                    ];
                @endphp
                @foreach($rows as $row)
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">{{ $row['label'] }}</span>
                    <span class="text-xs font-semibold text-gray-700">{{ $row['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Address -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-purple-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-purple-100 flex items-center gap-2">
                <x-heroicon-o-map-pin class="w-4 h-4 text-emerald-500" />
                <p class="text-sm font-bold text-gray-700">{{ __lang('ঠিকানা', 'Address') }}</p>
            </div>
            <div class="divide-y divide-gray-50">
                <div class="flex items-start justify-between px-4 py-3 gap-4">
                    <span class="text-xs text-gray-400 font-medium flex-shrink-0">{{ __lang('বর্তমান', 'Current') }}</span>
                    <span class="text-xs font-semibold text-gray-700 text-right">{{ $member->present_address ?: __lang('সেট করা হয়নি', 'Not set') }}</span>
                </div>
                <div class="flex items-start justify-between px-4 py-3 gap-4">
                    <span class="text-xs text-gray-400 font-medium flex-shrink-0">{{ __lang('স্থায়ী', 'Permanent') }}</span>
                    <span class="text-xs font-semibold text-gray-700 text-right">{{ $member->permanent_address ?: __lang('সেট করা হয়নি', 'Not set') }}</span>
                </div>
            </div>
        </div>

        <!-- Nominee -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-orange-100 flex items-center gap-2">
                <x-heroicon-o-user-group class="w-4 h-4 text-emerald-500" />
                <p class="text-sm font-bold text-gray-700">{{ __lang('মনোনীত ব্যক্তি', 'Nominee') }}</p>
            </div>
            <div class="divide-y divide-gray-50">
                @php
                    $rows = [
                        ['label' => __lang('নাম', 'Name'), 'value' => $member->nominee_name ?: __lang('সেট করা হয়নি', 'Not set')],
                        ['label' => __lang('সম্পর্ক', 'Relation'), 'value' => $member->nominee_relation ?: __lang('সেট করা হয়নি', 'Not set')],
                        ['label' => __lang('মোবাইল', 'Mobile'), 'value' => $member->nominee_mobile ?: __lang('সেট করা হয়নি', 'Not set')],
                    ];
                @endphp
                @foreach($rows as $row)
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">{{ $row['label'] }}</span>
                    <span class="text-xs font-semibold text-gray-700">{{ $row['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Login Information -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-teal-200 overflow-hidden">
            <div class="px-4 py-3 border-b border-teal-100 flex items-center gap-2">
                <x-heroicon-o-lock-closed class="w-4 h-4 text-emerald-500" />
                <p class="text-sm font-bold text-gray-700">{{ __lang('লগইন তথ্য', 'Login Information') }}</p>
            </div>
            <div class="divide-y divide-gray-50">
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">{{ __lang('ব্যবহারকারীর নাম', 'Username') }}</span>
                    <span class="text-xs font-semibold text-gray-700">{{ auth()->user()->username ?? auth()->user()->phone ?? 'N/A' }}</span>
                </div>
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">{{ __lang('ভূমিকা', 'Role') }}</span>
                    <span class="text-xs font-semibold text-emerald-600 capitalize">{{ auth()->user()->role ?? 'user' }}</span>
                </div>
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-xs text-gray-400 font-medium">{{ __lang('সদস্য হওয়ার তারিখ', 'Member Since') }}</span>
                    <span class="text-xs font-semibold text-gray-700">{{ $member->registration_date ? \formatDate($member->registration_date) : 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Loans -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-indigo-200 overflow-hidden">
            <div class="px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-banknotes class="w-4 h-4 text-emerald-500" />
                    <p class="text-sm font-bold text-gray-700">{{ __lang('ঋণের অবস্থা', 'Loan Status') }}</p>
                </div>
                @if($member->can_apply_loan)
                <span class="flex items-center gap-1 text-[11px] font-bold bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-lg">
                    <x-heroicon-o-lock-open class="w-3 h-3" /> {{ __lang('মুক্ত', 'Available') }}
                </span>
                @else
                <span class="flex items-center gap-1 text-[11px] font-bold bg-red-50 text-red-500 px-2.5 py-1 rounded-lg">
                    <x-heroicon-o-lock-closed class="w-3 h-3" /> {{ __lang('বন্ধ', 'Restricted') }}
                </span>
                @endif
            </div>
        </div>

    </div>

    <x-mobile.footer active="home" />

</div>
