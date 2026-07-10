<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - সমিতি ম্যানেজমেন্ট</title>
    
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- ✅ বডি লোড হওয়ার আগেই থিম সেট করে দিচ্ছি (Black Blink Fix) -->
    <script>
        document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
    </script>
    
    <!-- Tailwind CSS & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles


        <!-- PWA Links -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="theme-color" content="#000000">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="Somiti">
        
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('{{ asset('sw.js') }}');
                });
            }
        </script>
</head>

<!-- Theme Toggle Logic (Alpine.js) -->
<body style="opacity: 0; transition: opacity 0.2s;" class="min-h-screen font-poppins bg-base-200"
      x-data="{ theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'), sidebarOpen: true }" 
      x-init="$watch('theme', val => { localStorage.setItem('theme', val); document.documentElement.setAttribute('data-theme', val) }); document.documentElement.setAttribute('data-theme', theme)">
    
    @php $orgName = \App\Models\Setting::get('organization_name', ''); $orgLogo = \App\Models\Setting::get('organization_logo', ''); @endphp

    <!-- DaisyUI Drawer for Sidebar -->
    <div class="drawer lg:drawer-open" style="border-radius: 0;">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col">
            
              <!-- ===== Top Navbar ===== -->
            <div class="navbar bg-base-100/80 backdrop-blur-xl border-b border-base-300 sticky top-0 z-30 shadow-sm">
                <!-- Mobile Menu Toggle -->
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-ghost btn-square btn-circle hover:bg-base-content/10 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                
<!-- Page Title -->
<div class="flex-1 px-4">
    <marquee behavior="scroll" direction="left" scrollamount="10" class="text-xl sm:text-2xl font-bold text-primary tracking-tight">{{ $orgName ?: 'Dashboard' }}</marquee>
</div>
                
             <!-- Right Side (Theme Toggle, Notification & Profile) -->
                <div class="flex-none gap-2 sm:gap-3 flex items-center">
                    
                    <!-- ✅ Facebook Style Notification Bell (Theme Icon er left side) -->
                    <div class="relative" x-data="{ showNotif: false }">
                        <button @click="showNotif = !showNotif" class="btn btn-ghost btn-circle btn-sm hover:bg-base-content/10 transition-colors duration-200 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-base-content/70"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                            @php $pendingCount = \App\Models\MemberRequest::where('status', 'pending')->count(); @endphp
                            @if($pendingCount > 0)
                                <span class="absolute -top-1 -right-1 bg-error text-error-content rounded-full w-5 h-5 text-[10px] font-bold flex items-center justify-center animate-pulse">{{ $pendingCount }}</span>
                            @endif
                        </button>

                        @if($pendingCount > 0)
                        <div x-show="showNotif" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            @click.outside="showNotif = false"
                            class="absolute right-0 mt-2 w-80 bg-base-100 rounded-xl shadow-2xl border border-base-300 z-50 overflow-hidden"
                            style="display: none;">
                            
                            <!-- Dropdown Header -->
                            <div class="p-3 bg-base-200 border-b border-base-300 flex justify-between items-center">
                                <h3 class="font-bold text-sm text-base-content">Notifications</h3>
                                <a href="{{ route('admin.member-requests') }}" wire:navigate class="text-xs text-primary hover:underline font-semibold">See All</a>
                            </div>

                            <!-- Dropdown Body -->
                            <div class="divide-y divide-base-200 max-h-72 overflow-y-auto">
                                @php $recentRequests = \App\Models\MemberRequest::where('status', 'pending')->with('member')->latest()->take(5)->get(); @endphp
                                @foreach($recentRequests as $req)
                                <a href="{{ route('admin.member-requests') }}" wire:navigate class="flex items-start gap-3 p-3 hover:bg-base-200 transition-colors cursor-pointer">
                                    <!-- Avatar -->
                                    <div class="avatar placeholder flex-shrink-0">
                                        <div class="bg-primary text-primary-content w-10 rounded-full">
                                            <span class="text-xs">{{ strtoupper($req->member->name_english[0] ?? 'M') }}</span>
                                        </div>
                                    </div>
                                    <!-- Details -->
                                    <div class="flex-1">
                                        <p class="text-sm text-base-content leading-tight">
                                            <span class="font-bold">{{ $req->member->name_english ?? 'Unknown' }}</span>
                                            @if($req->type === 'loan_unlock')
                                                requested to <span class="text-yellow-500 font-semibold">Unlock Loan Access</span>
                                            @elseif($req->type === 'profile_edit')
                                                requested to <span class="text-blue-500 font-semibold">Edit {{ ucfirst(str_replace('_', ' ', $req->data['section'] ?? 'Profile')) }}</span>
                                            @endif
                                        </p>
                                        <p class="text-[10px] text-base-content/50 mt-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $req->created_at->diffForHumans() }}</p>
                                    </div>
                                    <!-- Unread Dot -->
                                    <div class="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                                </a>
                                @endforeach
                            </div>
                            
                        </div>
                        @endif
                    </div>

                    <!-- Dark/Light Theme Toggle Button -->
                    <button @click="theme = theme === 'light' ? 'dark' : 'light'" class="btn btn-ghost btn-circle btn-sm hover:bg-base-content/10 transition-colors duration-200">
                        <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-base-content/70"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" /></svg>
                        <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-base-content/70"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.375 3.375 0 11-7.5 0 3.375 3.375 0 017.5 0z" /></svg>
                    </button>

                    <span class="text-sm hidden sm:block text-base-content/70 font-medium">{{ auth()->user()->name }}</span>
                    
                    <!-- Profile Dropdown -->
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar hover:bg-base-content/10 transition-colors duration-200">
                            @if($orgLogo)
                                <div class="rounded-full w-10 border-2 border-primary/30 overflow-hidden">
                                    <img src="{{ asset('storage/' . $orgLogo) }}" alt="Logo" class="w-full h-full object-contain">
                                </div>
                            @else
                                <div class="rounded-full w-10 border-2 border-primary/30 bg-primary flex items-center justify-center">
                                    <span class="text-sm font-bold text-primary-content">{{ strtoupper(auth()->user()->username[0]) }}</span>
                                </div>
                            @endif
                        </div>
                        <ul tabindex="0" class="dropdown-content mt-3 z-[1] p-2 shadow-lg bg-base-200/90 backdrop-blur-xl rounded-box w-52 border border-base-300">
                            <li>
                                <a href="{{ route('settings.index', ['tab' => 'admin_profile']) }}" wire:navigate class="btn btn-sm btn-ghost w-full justify-start gap-2 hover:bg-base-content/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-ghost w-full text-error hover:bg-error/10 justify-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                                        লগআউট
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ===== Main Content Area ===== -->
            <main class="flex-1 p-4 sm:p-6">
                {{ $slot }}
            </main>

        </div> 
        
        <!-- ===== Left Sidebar ===== -->
        <div class="drawer-side z-40">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            
            <aside class="w-72 min-h-full bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 text-white flex flex-col border-r border-slate-700/50 shadow-2xl transition-all duration-300 ease-in-out" :class="sidebarOpen ? 'lg:w-72' : 'lg:w-20'"
                   style="background: linear-gradient(145deg, #1e293b 0%, #0f172a 50%, #020617 100%); backdrop-filter: blur(10px);"">
                
                <!-- Top Brand Area (Desktop Only) -->
                <div class="px-4 pt-6 pb-5 bg-gradient-to-r from-indigo-600/20 via-purple-600/20 to-pink-600/20 backdrop-blur-sm border-b border-white/10 transition-all duration-300" :class="sidebarOpen ? 'hidden lg:flex lg:items-center lg:gap-3' : 'hidden'">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m2.25-18h16.5v3.75a.75.75 0 0 1-.75.75h-14.5a.75.75 0 0 1-.75-.75V3ZM10.5 9.75h3m-3 2.25h3m-3 2.25h3" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-bold text-white truncate">Somiti Management</h3>
                            <p class="text-[10px] text-indigo-300 font-medium">Premium Admin Panel</p>
                        </div>
                    </div>
                    <button @click="sidebarOpen = false" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center flex-shrink-0 transition-colors duration-200 text-white/60 hover:text-white border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                </div>

                <!-- User Profile Section -->
                <div class="flex flex-col items-center px-6 py-6 border-b border-white/10 bg-gradient-to-b from-white/5 to-transparent backdrop-blur-md relative transition-all duration-300 overflow-hidden" :class="!sidebarOpen && 'lg:px-2 lg:py-4'">
                    
                    <!-- Mobile Close Button -->
                    <label for="my-drawer-2" aria-label="close sidebar" class="btn btn-ghost btn-sm btn-circle absolute top-4 right-4 lg:hidden text-white/70 hover:text-white hover:bg-white/10 transition-colors duration-200 border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </label>

                    <div @click="sidebarOpen = true" class="avatar mb-4 transition-all duration-300 cursor-pointer relative group" :class="!sidebarOpen && 'lg:mb-0'">
                        <div class="w-20 rounded-2xl shadow-2xl border-2 border-gradient-to-br from-indigo-400 to-purple-600 transition-all duration-300 overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 text-white relative" :class="!sidebarOpen && 'lg:w-14'">
                            <!-- Glassmorphism overlay -->
                            <div class="absolute inset-0 bg-white/20 backdrop-blur-sm rounded-2xl"></div>
                            @if(auth()->user()->photo)
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover relative z-10">
                            @elseif(auth()->user()->member && auth()->user()->member->photo)
                                <img src="{{ asset('storage/' . auth()->user()->member->photo) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover relative z-10">
                            @else
                                <span class="flex items-center justify-center w-full h-full text-2xl font-bold transition-all duration-300 relative z-10" :class="!sidebarOpen && 'lg:text-lg'">{{ strtoupper(auth()->user()->name[0]) }}</span>
                            @endif
                            <!-- Glow effect -->
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 opacity-50 group-hover:opacity-70 transition-opacity duration-300 blur-xl -z-10"></div>
                        </div>
                    </div>
                    <h2 class="font-bold text-base transition-all duration-300 truncate w-full text-center text-white" :class="!sidebarOpen && 'lg:hidden'">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-indigo-300 mt-1 flex items-center gap-2 transition-all duration-300" :class="!sidebarOpen && 'lg:hidden'">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse shadow-lg"></span> 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-yellow-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25s4.544.16 6.75.471v1.515M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.228V2.721A48.133 48.133 0 0 0 12 2.25c-2.291 0-4.544.16-6.75.471v1.515M7.73 9.728l3.768 8.777a5.25 5.25 0 0 0 1.004 0L7.73 9.728ZM13.5 18.75h-3" />
                        </svg>
                        Super Admin
                    </p>
                </div>

                <!-- Scrollable Menu Area -->
                <nav class="flex-1 overflow-y-auto pt-6 pb-4 space-y-2 transition-all duration-300 px-3" :class="!sidebarOpen && 'lg:px-1'">
                    
                    @php $authUser = auth()->user(); @endphp

                    <!-- 1. Dashboard -->
                    @if($authUser->hasPermission('dashboard'))
                    @php $isDashboard = request()->routeIs('dashboard'); @endphp
                    <a href="{{ route('dashboard') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isDashboard ? 'bg-gradient-to-r from-indigo-500/20 to-purple-500/20 text-white border border-indigo-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isDashboard)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-indigo-400 to-purple-600 rounded-l-full shadow-lg"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/10 to-purple-600/10 rounded-2xl"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300 relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm relative z-10" :class="!sidebarOpen && 'lg:hidden'">Dashboard</span>
                        @if($isDashboard)
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5 rounded-2xl animate-pulse"></div>
                        @endif
                    </a>
                    @endif

                    <!-- 2. Members Management -->
                    @if($authUser->hasPermission('member_management'))
                    @php $isMembers = request()->routeIs('members.*'); @endphp
                    <a href="{{ route('members.index') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isMembers ? 'bg-gradient-to-r from-blue-500/20 to-cyan-500/20 text-white border border-blue-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isMembers)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-blue-400 to-cyan-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Members Management</span>
                    </a>
                    @endif

                    <!-- 3. Deposit Management -->
                    @if($authUser->hasPermission('deposit_management'))
                    @php $isDeposits = request()->routeIs('deposits.*'); @endphp
                    <a href="{{ route('deposits.index') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isDeposits ? 'bg-gradient-to-r from-emerald-500/20 to-teal-500/20 text-white border border-emerald-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isDeposits)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-emerald-400 to-teal-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Deposit Management</span>
                    </a>
                    @endif

                    <!-- 4. Loan Management -->
                    @if($authUser->hasPermission('loan_management'))
                    @php $isLoans = request()->routeIs('loans.*'); @endphp
                    <a href="{{ route('loans.index') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isLoans ? 'bg-gradient-to-r from-orange-500/20 to-red-500/20 text-white border border-orange-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isLoans)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-orange-400 to-red-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Loan Management</span>
                    </a>
                    @endif

                    <!-- 5. Accounts Management -->
                    @if($authUser->hasPermission('accounts_management'))
                    @php $isAccounts = request()->routeIs('accounts.*'); @endphp
                    <a href="{{ route('accounts.index') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isAccounts ? 'bg-gradient-to-r from-violet-500/20 to-purple-500/20 text-white border border-violet-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isAccounts)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-violet-400 to-purple-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Accounts Management</span>
                    </a>
                    @endif

                    <!-- 6. Expense Management -->
                    @if($authUser->hasPermission('expenses_management'))
                    @php $isExpenses = request()->routeIs('expenses.*'); @endphp
                    <a href="{{ route('expenses.index') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isExpenses ? 'bg-gradient-to-r from-rose-500/20 to-pink-500/20 text-white border border-rose-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isExpenses)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-rose-400 to-pink-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.307a11.95 11.95 0 0 1 5.814-5.519l2.74-1.22m0 0-5.94-2.28m5.94 2.28-2.28 5.941" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Expense Management</span>
                    </a>
                    @endif
                    
                    <!-- 7. SMS Portal -->
                    @if($authUser->hasPermission('sms_portal'))
                    @php $isSms = request()->routeIs('sms.portal'); @endphp
                    <a href="{{ route('sms.portal') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isSms ? 'bg-gradient-to-r from-sky-500/20 to-blue-500/20 text-white border border-sky-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isSms)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-sky-400 to-blue-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">SMS Portal</span>
                    </a>
                    @endif
                    
                     <!-- 8. Member Requests (Admin & Super Admin) -->
                    @if($authUser->isAdmin() || $authUser->isSuperAdmin())
                    @php $pendingRequestCount = \App\Models\MemberRequest::where('status', 'pending')->count(); @endphp
                    @php $isRequests = request()->routeIs('admin.member-requests'); @endphp
                    <a href="{{ route('admin.member-requests') }}" wire:navigate class="group flex items-center justify-between py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isRequests ? 'bg-gradient-to-r from-amber-500/20 to-yellow-500/20 text-white border border-amber-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isRequests)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-amber-400 to-yellow-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <span class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-amber-500 to-yellow-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300 relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 0 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 0-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                                @if($pendingRequestCount > 0)
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center animate-pulse">{{ $pendingRequestCount }}</div>
                                @endif
                            </div>
                            <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Member Requests</span>
                        </span>
                    </a>
                    @endif

                    <!-- 9. Settings (Only for Super Admin) -->
                    @if($authUser->isSuperAdmin())
                    @php $isSettings = request()->routeIs('settings.*'); @endphp
                    <a href="{{ route('settings.index') }}" wire:navigate class="group flex items-center gap-4 py-4 px-4 rounded-2xl transition-all duration-300 relative overflow-hidden {{ $isSettings ? 'bg-gradient-to-r from-gray-500/20 to-slate-500/20 text-white border border-gray-500/30 shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white hover:border-white/20' }} border border-transparent" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:rounded-xl'">
                        @if($isSettings)
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-gray-400 to-slate-600 rounded-l-full shadow-lg"></div>
                        @endif
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-gray-500 to-slate-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.432.992a6.759 6.759 0 0 1 0 .255c-.006.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Settings</span>
                    </a>
                    @endif

                </nav>

                <!-- Bottom Logout Section -->
                <div class="border-t border-white/10 mt-auto bg-gradient-to-r from-red-500/10 to-pink-500/10 backdrop-blur-md transition-all duration-300 overflow-hidden" :class="!sidebarOpen && 'lg:p-2'">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="group flex items-center gap-4 w-full py-4 px-4 text-red-300 border border-transparent hover:bg-red-500/10 hover:border-red-500/30 hover:text-red-200 transition-all duration-300 cursor-pointer rounded-2xl mx-3 my-3" :class="!sidebarOpen && 'lg:px-2 lg:justify-center lg:mx-1'">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </div>
                            <span class="font-semibold text-sm" :class="!sidebarOpen && 'lg:hidden'">Logout</span>
                        </button>
                    </form>
                </div>

            </aside>
        
        </div>
    </div>

    <script>document.body.style.opacity = '1';</script>
    @livewireScripts
</body>
</html>