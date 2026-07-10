<div>
    <!-- ===== Modern Green Gradient Header ===== -->
    <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-6 sm:p-8 rounded-t-2xl shadow-lg text-white">
        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm border border-white/20 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-3xl font-extrabold tracking-tight">System Settings</h1>
                    <p class="text-sm text-blue-100 mt-1">Manage Users, SMS and System Tools</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Body Section ===== -->
    <div class="bg-base-100 p-4 sm:p-8 rounded-b-2xl shadow-xl border border-t-0 border-base-300">
        
        <div x-data="{ activeTab: '{{ $activeTab }}' }" class="w-full">
            
            <!-- ✅ Mobile Dropdown View -->
            <div class="md:hidden mb-6">
                <select x-model="activeTab" class="select select-bordered w-full font-semibold text-sm bg-emerald-50 text-[#00a550] border-emerald-300 focus:outline-none focus:ring-2 focus:ring-[#00a550]">
                    <option value="organization">🏢 Organization</option>
                    <option value="admin_profile">👤 Admin Profile</option>
                    <option value="user_management">🛡️ User Management</option>
                    <option value="sms">📱 SMS Gateway</option>
                    <option value="system_tools">🔧 System Tools</option>
                </select>
            </div>

            <!-- ✅ Desktop Underline Tabs -->
            <div class="hidden md:block border-b border-base-300 mb-8">
                <nav class="flex gap-6 overflow-x-auto pb-px -mb-px scrollbar-hide">
                    
                    <!-- 1. Organization -->
                    <button type="button" @click="activeTab = 'organization'" :class="activeTab === 'organization' ? 'border-[#00a550] text-[#00a550]' : 'border-transparent text-base-content/50 hover:text-base-content hover:border-base-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-all duration-200 flex items-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                        Organization
                    </button>

                    <!-- 2. Admin Profile -->
                    <button type="button" @click="activeTab = 'admin_profile'" :class="activeTab === 'admin_profile' ? 'border-[#00a550] text-[#00a550]' : 'border-transparent text-base-content/50 hover:text-base-content hover:border-base-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-all duration-200 flex items-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Admin Profile
                    </button>

                    <!-- 3. User Management -->
                    <button type="button" @click="activeTab = 'user_management'" :class="activeTab === 'user_management' ? 'border-[#00a550] text-[#00a550]' : 'border-transparent text-base-content/50 hover:text-base-content hover:border-base-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-all duration-200 flex items-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                        User Management
                    </button>

                    <!-- 2. SMS Gateway -->
                    <button type="button" @click="activeTab = 'sms'" :class="activeTab === 'sms' ? 'border-[#00a550] text-[#00a550]' : 'border-transparent text-base-content/50 hover:text-base-content hover:border-base-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-all duration-200 flex items-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                        SMS Gateway
                    </button>

                    <!-- 3. System Tools -->
                    <button type="button" @click="activeTab = 'system_tools'" :class="activeTab === 'system_tools' ? 'border-[#00a550] text-[#00a550]' : 'border-transparent text-base-content/50 hover:text-base-content hover:border-base-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm transition-all duration-200 flex items-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17l-5.1-5.1m0 0L11.42 4.97m-5.1 5.1H21M3.12 4.97v14.06" /></svg>
                        System Tools
                    </button>
                </nav>
            </div>

            <!-- Tab Contents -->
            <div class="min-h-[30vh] sm:min-h-[40vh]">
                
                <!-- ===== 🏢 Organization Tab ===== -->
                <div x-show="activeTab === 'organization'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    
                    @if (session()->has('org_message'))
                        <div x-data x-init="setTimeout(() => this.remove(), 4000)" class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-sm font-medium">{{ session('org_message') }}</span>
                        </div>
                    @endif

                    @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <!-- Organization Profile Card -->
                    <div class="bg-base-100 rounded-2xl border border-base-300 shadow-sm overflow-hidden">
                        <!-- Cover Banner -->
                        <div class="h-24 bg-gradient-to-r from-[#00a550] via-emerald-500 to-teal-500 relative">
                            <div class="absolute -bottom-10 left-6">
                                <div class="relative cursor-pointer" @mouseenter="$refs.orgPhotoOverlay.style.opacity = '1'" @mouseleave="$refs.orgPhotoOverlay.style.opacity = '0'">
                                    <div class="w-20 h-20 rounded-2xl bg-base-100 border-4 border-base-100 shadow-lg flex items-center justify-center overflow-hidden">
                                        @if($organization_logo)
                                            <img src="{{ asset('storage/' . $organization_logo) }}" alt="Logo" class="w-full h-full object-contain p-1.5">
                                        @else
                                            <span class="text-2xl font-bold text-[#00a550]">O</span>
                                        @endif
                                    </div>
                                    <div x-ref="orgPhotoOverlay" style="opacity: 0; transition: opacity 0.2s;" class="absolute inset-0 rounded-2xl bg-black/40 flex items-center justify-center">
                                        <button type="button" @click.stop="$refs.orgLogoInput.click()" class="w-10 h-10 rounded-xl bg-white/25 backdrop-blur-sm flex items-center justify-center hover:bg-white/35 transition-colors" title="লোগো আপলোড করুন">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-5 h-5 drop-shadow-lg"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" /></svg>
                                        </button>
                                    </div>
                                    <input type="file" wire:model.live="organization_logo" x-ref="orgLogoInput" class="hidden" accept="image/*" />
                                    @error('organization_logo') <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 text-[9px] text-red-500 whitespace-nowrap bg-base-100 px-1.5 rounded shadow">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="pt-12 px-6 pb-6">
                            <div class="mb-6">
                                <h4 class="font-bold text-base-content text-xl">{{ $organization_name ?: 'Organization Name' }}</h4>
                                <p class="text-sm text-base-content/50 mt-0.5 font-mono">Organization Profile</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="badge badge-sm text-white bg-gradient-to-r from-[#00a550] to-teal-500 border-none shadow-sm">Organization</span>
                                </div>
                            </div>

                            <!-- Name Update -->
                            <form wire:submit="saveOrganizationSettings" class="flex items-center gap-3 mb-4">
                                <div class="flex-1">
                                    <label class="text-[11px] font-bold text-base-content/35 uppercase tracking-wider mb-1.5 block">Organization Name</label>
                                    <input type="text" wire:model="organization_name" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550] bg-transparent text-sm" />
                                    @error('organization_name') <span class="text-red-500 text-[10px] mt-0.5 block">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn bg-[#00a550] hover:bg-[#008c44] text-white border-none shadow-md mt-5 px-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="border-t border-base-200 my-4"></div>

                            <!-- Logo Shape Selector -->
                            <div>
                                <h4 class="text-sm font-semibold text-base-content mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#00a550]"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.5 2.5 0 01-2.25-2.25H12M9 12.75L6.75 15.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Logo Shape
                                </h4>
                                <div class="flex items-center gap-3">
                                    <label class="flex items-center gap-2.5 cursor-pointer px-4 py-3 rounded-xl border-2 transition-all" :class="$wire.organization_logo_shape === 'round' ? 'border-[#00a550] bg-[#00a550]/5 shadow-sm' : 'border-base-200 hover:border-base-300'">
                                        <input type="radio" wire:model.live="organization_logo_shape" value="round" class="hidden" />
                                        <div class="w-8 h-8 rounded-full bg-base-300 group-hover:bg-[#00a550]/20 flex items-center justify-center transition-colors" :class="$wire.organization_logo_shape === 'round' ? 'bg-[#00a550]/20' : ''">
                                            <div class="w-5 h-5 rounded-full border-2 border-current" :class="$wire.organization_logo_shape === 'round' ? 'text-[#00a550]' : 'text-base-content/30'"></div>
                                        </div>
                                        <span class="text-xs font-semibold" :class="$wire.organization_logo_shape === 'round' ? 'text-[#00a550]' : 'text-base-content/50'">Round</span>
                                    </label>
                                    <label class="flex items-center gap-2.5 cursor-pointer px-4 py-3 rounded-xl border-2 transition-all" :class="$wire.organization_logo_shape === 'square' ? 'border-[#00a550] bg-[#00a550]/5 shadow-sm' : 'border-base-200 hover:border-base-300'">
                                        <input type="radio" wire:model.live="organization_logo_shape" value="square" class="hidden" />
                                        <div class="w-8 h-8 rounded-md bg-base-300 group-hover:bg-[#00a550]/20 flex items-center justify-center transition-colors" :class="$wire.organization_logo_shape === 'square' ? 'bg-[#00a550]/20' : ''">
                                            <div class="w-5 h-5 rounded-sm border-2 border-current" :class="$wire.organization_logo_shape === 'square' ? 'text-[#00a550]' : 'text-base-content/30'"></div>
                                        </div>
                                        <span class="text-xs font-semibold" :class="$wire.organization_logo_shape === 'square' ? 'text-[#00a550]' : 'text-base-content/50'">Square</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="bg-base-200 rounded-2xl border border-dashed border-base-300 p-12 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-base-300 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-base-content/30"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                        </div>
                        <p class="text-base-content/50 text-sm">শুধুমাত্র Admin বা Super Admin এই তথ্য পরিবর্তন করতে পারবেন।</p>
                    </div>
                    @endif
                </div>
                <!-- ===== 👤 Admin Profile Tab ===== -->
                <div x-show="activeTab === 'admin_profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    
                    @if(session()->has('profile_message'))
                        <div x-data x-init="setTimeout(() => this.remove(), 4000)" class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-sm font-medium">{{ session('profile_message') }}</span>
                        </div>
                    @endif

                    <!-- Profile Card -->
                    <div class="bg-base-100 rounded-2xl border border-base-300 shadow-sm overflow-hidden">
                        <!-- Cover Banner -->
                        <div class="h-24 bg-gradient-to-r from-[#00a550] via-emerald-500 to-teal-500 relative">
                            <div class="absolute -bottom-10 left-6">
                                <div class="relative cursor-pointer" @mouseenter="$refs.photoOverlay.style.opacity = '1'" @mouseleave="$refs.photoOverlay.style.opacity = '0'">
                                    <div class="w-20 h-20 rounded-2xl bg-base-100 border-4 border-base-100 shadow-lg flex items-center justify-center overflow-hidden">
                                        @if(auth()->user()->isSuperAdmin() && auth()->user()->photo)
                                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                        @elseif(auth()->user()->member && auth()->user()->member->photo)
                                            <img src="{{ asset('storage/' . auth()->user()->member->photo) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-2xl font-bold text-[#00a550]">{{ strtoupper(auth()->user()->name[0]) }}</span>
                                        @endif
                                    </div>
                                    @if(auth()->user()->isSuperAdmin())
                                    <div x-ref="photoOverlay" style="opacity: 0; transition: opacity 0.2s;" class="absolute inset-0 rounded-2xl bg-black/40 flex items-center justify-center">
                                        <button type="button" @click.stop="$refs.adminPhotoInput.click()" class="w-10 h-10 rounded-xl bg-white/25 backdrop-blur-sm flex items-center justify-center hover:bg-white/35 transition-colors" title="ফটো আপলোড করুন">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-5 h-5 drop-shadow-lg"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" /></svg>
                                        </button>
                                    </div>
                                    <input type="file" wire:model.live="admin_photo" x-ref="adminPhotoInput" class="hidden" accept="image/*" />
                                    @error('admin_photo') <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 text-[9px] text-red-500 whitespace-nowrap bg-base-100 px-1.5 rounded shadow">{{ $message }}</span> @enderror
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="pt-12 px-6 pb-6">
                            <div class="mb-6">
                                    <h4 class="font-bold text-base-content text-xl">{{ auth()->user()->name }}</h4>
                                    <p class="text-sm text-base-content/50 mt-0.5 font-mono">{{ auth()->user()->username }}</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        @if(auth()->user()->isSuperAdmin())
                                            <span class="badge badge-sm text-white bg-gradient-to-r from-amber-500 to-orange-500 border-none shadow-sm">Super Admin</span>
                                        @elseif(auth()->user()->isAdmin())
                                            <span class="badge badge-sm text-white bg-[#00a550] border-none shadow-sm">Admin</span>
                                        @else
                                            <span class="badge badge-sm bg-base-300 text-base-content/60 border-none">User</span>
                                        @endif
                                        <span class="text-[11px] text-base-content/35">• {{ count(auth()->user()->permissions ?? []) }} Modules</span>
                                    </div>
                                </div>

                            <!-- Name Update -->
                            <form wire:submit="updateAdminName" class="flex items-center gap-3 mb-4">
                                <div class="flex-1">
                                    <label class="text-[11px] font-bold text-base-content/35 uppercase tracking-wider mb-1.5 block">Display Name</label>
                                    <input type="text" wire:model="admin_name" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550] bg-transparent text-sm" />
                                    @error('admin_name') <span class="text-red-500 text-[10px] mt-0.5 block">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn bg-[#00a550] hover:bg-[#008c44] text-white border-none shadow-md mt-5 px-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="border-t border-base-200 my-4"></div>

                            <!-- Reset Password -->
                            <button wire:click="openResetPasswordModal" class="w-full flex items-center justify-between p-3.5 rounded-xl border border-base-200 hover:border-red-200 hover:bg-red-50 transition-all group cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-red-50 group-hover:bg-red-100 flex items-center justify-center transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-semibold text-base-content">Change Password</p>
                                        <p class="text-[11px] text-base-content/40">আপনার অ্যাকাউন্টের পাসওয়ার্ড পরিবর্তন করুন</p>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-base-content/20 group-hover:text-red-400 transition-colors"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ===== Reset Password Modal ===== -->
                @if($resetPasswordModal)
                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click="closeResetPasswordModal">
                    <div class="bg-base-100 rounded-2xl shadow-2xl max-w-md w-full overflow-hidden" wire:click.stop>
                        
                        <div class="bg-gradient-to-r from-red-500 to-rose-600 p-5 text-white flex justify-between items-center">
                            <h2 class="text-lg font-bold flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                </div>
                                Change Password
                            </h2>
                            <button wire:click="closeResetPasswordModal" class="text-white/60 hover:text-white w-8 h-8 rounded-lg hover:bg-white/10 flex items-center justify-center transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="bg-amber-50 border border-amber-200 text-amber-700 p-3 rounded-xl text-sm flex items-start gap-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                <span>পাসওয়ার্ড পরিবর্তন করলে আপনাকে আবার লগইন করতে হবে।</span>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-base-content/40 uppercase tracking-wider mb-1.5 block">বর্তমান পাসওয়ার্ড</label>
                                <input type="password" wire:model="old_password" class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm" placeholder="এখনকার পাসওয়ার্ড" />
                                @error('old_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="text-xs font-bold text-base-content/40 uppercase tracking-wider mb-1.5 block">নতুন পাসওয়ার্ড</label>
                                <input type="password" wire:model="new_password" class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm" placeholder="কমপক্ষে ৬ অক্ষর" />
                                @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="text-xs font-bold text-base-content/40 uppercase tracking-wider mb-1.5 block">নিশ্চিত করুন</label>
                                <input type="password" wire:model="confirm_password" class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm" placeholder="আবার নতুন পাসওয়ার্ড" />
                                @error('confirm_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button wire:click="closeResetPasswordModal" class="flex-1 py-2.5 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200 transition-colors text-sm">বাতিল</button>
                                <button wire:click="resetPassword" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 rounded-xl shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/30 text-sm">পরিবর্তন করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- ===== 🛡️ User Management Tab ===== -->
                <div x-show="activeTab === 'user_management'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <!-- Success Message -->
                    @if (session()->has('message'))
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ session('message') }}</span>
                        </div>
                    @endif

                    <!-- ✅ User Role Management Card -->
                    <div class="bg-base-200 rounded-xl border border-base-300 overflow-hidden shadow-sm">
                        
                        <!-- Card Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 pb-3 border-b-2 border-dashed border-emerald-100 bg-emerald-50/50">
                            <h3 class="text-lg font-bold text-base-content flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#00a550]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                                User Role Management
                            </h3>
                            <button wire:click="openAddUserModal" class="btn btn-sm bg-[#00a550] hover:bg-[#008c44] text-white border-none shadow-md mt-3 sm:mt-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Add New User
                            </button>
                        </div>

                        <!-- ===== DESKTOP VIEW (Table) ===== -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="table w-full text-sm">
                                <thead>
                                    <tr class="bg-emerald-50 text-emerald-800 uppercase text-xs">
                                        <th>Acc#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Access</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr class="border-b border-base-200 hover:bg-emerald-50/30 transition-colors">
                                        <td class="font-bold text-[#00a550]">{{ $user->member->account_no ?? '-' }}</td>
                                        <td class="font-semibold text-base-content">
                                            {{ $user->name }}
                                            @if($user->isSuperAdmin())
                                                <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-700 border border-amber-200 shadow-sm">System Administrator</span>
                                            @endif
                                        </td>
                                        <td class="font-mono text-emerald-600">{{ $user->username }}</td>
                                        <td>
                                            @if($user->isSuperAdmin())
                                                <span class="badge badge-sm text-white bg-gradient-to-r from-amber-500 to-orange-500 border-none shadow-sm">Super Admin</span>
                                            @elseif($user->isAdmin())
                                                <span class="badge badge-sm text-white bg-[#00a550] border-none shadow-sm">Admin</span>
                                            @else
                                                <span class="badge badge-sm bg-emerald-100 text-emerald-700 border border-emerald-200">User</span>
                                            @endif
                                        </td>
                                        <td class="text-xs text-base-content/60">
                                            @if($user->isSuperAdmin())
                                                Full Access
                                            @elseif($user->isAdmin())
                                                {{ count($user->permissions ?? []) }} Modules
                                            @else
                                                Mobile Dashboard Only
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button wire:click="openEditUserModal({{ $user->id }})" class="btn btn-ghost btn-xs text-emerald-500 hover:bg-emerald-50" title="Edit User">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- ===== MOBILE VIEW (Cards) ===== -->
                        <div class="md:hidden p-4 space-y-3">
                            @foreach($users as $user)
                            <div class="bg-base-100 rounded-lg p-4 border-l-4 border-[#00a550] shadow-sm">
                                <div class="flex items-start gap-3">
                                    <div class="bg-emerald-100 text-[#00a550] font-extrabold text-xs px-2.5 py-1 rounded-md border border-emerald-200 mt-1 shrink-0">
                                        #{{ $user->member->account_no ?? '-' }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-base-content">
                                            {{ $user->name }}
                                            @if($user->isSuperAdmin())
                                                <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-700 border border-amber-200">System Admin</span>
                                            @endif
                                        </h4>
                                        <p class="text-xs text-base-content/60 font-mono mt-0.5 truncate">{{ $user->username }}</p>
                                    </div>
                                    <button wire:click="openEditUserModal({{ $user->id }})" class="btn btn-ghost btn-xs text-emerald-500 hover:bg-emerald-50 shrink-0 -mt-1 -mr-2" title="Edit User">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </button>
                                </div>
                                <div class="flex items-center gap-2 flex-wrap mt-3 border-t border-base-200 pt-2">
                                    @if($user->isSuperAdmin())
                                        <span class="badge badge-sm text-white bg-gradient-to-r from-amber-500 to-orange-500 border-none shadow-sm">Super Admin</span>
                                        <span class="text-[10px] text-base-content/50">• Full Access</span>
                                    @elseif($user->isAdmin())
                                        <span class="badge badge-sm text-white bg-[#00a550] border-none shadow-sm">Admin</span>
                                        <span class="text-[10px] text-base-content/50">• {{ count($user->permissions ?? []) }} Modules</span>
                                    @else
                                        <span class="badge badge-sm bg-emerald-100 text-emerald-700 border border-emerald-200">User</span>
                                        <span class="text-[10px] text-base-content/50">• Mobile Dashboard Only</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>


                <!-- ===== Add New User Modal ===== -->
                @if($addUserModal)
                <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4" wire:click="closeAddUserModal">
                    <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-0 relative max-h-[90vh] overflow-y-auto" wire:click.stop>
                        
                        <div class="bg-gradient-to-r from-[#00a550] to-emerald-700 p-5 rounded-t-2xl text-white flex justify-between items-center">
                            <h2 class="text-lg font-bold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z" /></svg>
                                Add New User
                            </h2>
                            <button wire:click="closeAddUserModal" class="text-white/70 hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                        </div>

                        <div class="p-6 space-y-4">
                            <!-- Select Member -->
                            <div>
                                <label class="block text-sm font-medium text-base-content/70 mb-1">Select Member *</label>
                                <select wire:model.live="selectedMemberId" class="select select-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]">
                                    <option value="" disabled selected>Select a Member</option>
                                    @foreach($availableMembers as $m)
                                        <option value="{{ $m->id }}">#{{ $m->account_no }} - {{ $m->name_english }} ({{ $m->mobile }})</option>
                                    @endforeach
                                </select>
                                @error('selectedMemberId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Credentials -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-base-content/70 mb-1">Username *</label>
                                    <input type="text" wire:model="newUsername" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" />
                                    @error('newUsername') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-base-content/70 mb-1">Password *</label>
                                    <input type="text" wire:model="newPassword" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" />
                                    @error('newPassword') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Role Selection -->
                            <div>
                                <label class="block text-sm font-medium text-base-content/70 mb-2">Assign Role *</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" wire:model.live="newRole" value="admin" class="radio radio-[#00a550] radio-sm" />
                                        <span class="text-sm font-medium text-base-content">Admin</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" wire:model.live="newRole" value="user" class="radio radio-[#00a550] radio-sm" />
                                        <span class="text-sm font-medium text-base-content">User (Mobile Dashboard)</span>
                                    </label>
                                </div>
                                @error('newRole') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Dynamic Permissions (Only if Admin) -->
                            @if($newRole === 'admin')
                            <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl">
                                <h4 class="font-bold text-[#00a550] text-sm mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" /></svg>
                                    Module Access for Admin
                                </h4>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach($modules as $key => $label)
                                    <label class="flex items-center gap-2 cursor-pointer bg-white p-2 rounded-lg border border-emerald-100 hover:border-[#00a550] transition-colors shadow-sm">
                                        <input type="checkbox" wire:model="selectedPermissions" value="{{ $key }}" class="checkbox checkbox-sm checkbox-success" />
                                        <span class="text-sm text-base-content">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @elseif($newRole === 'user')
                            <div class="bg-teal-50 border border-teal-200 p-3 rounded-lg text-sm text-teal-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                This user will only have access to the Mobile Dashboard.
                            </div>
                            @endif

                            <div class="flex gap-3 pt-2">
                                <button wire:click="closeAddUserModal" class="flex-1 py-2 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200">Cancel</button>
                                <button wire:click="saveNewUser" class="flex-1 bg-[#00a550] hover:bg-[#008c44] text-white font-bold py-2 rounded-xl shadow-md">Create User</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                <!-- ===== Edit User Modal ===== -->
                @if($editUserModal)
                <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4" wire:click="closeEditUserModal">
                    <div class="bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-0 relative max-h-[90vh] overflow-y-auto" wire:click.stop>
                        
                        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-5 rounded-t-2xl text-white flex justify-between items-center">
                            <h2 class="text-lg font-bold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                Edit User Information
                            </h2>
                            <button wire:click="closeEditUserModal" class="text-white/70 hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                        </div>

                        <div class="p-6 space-y-4">
                            
                            @if($editRole === 'super_admin')
                            <div class="bg-amber-50 border-l-4 border-amber-500 text-amber-700 p-3 rounded-lg text-sm">
                                ⚠️ This is the System Administrator. You can only change Username and Password.
                            </div>
                            @endif

                            <!-- Credentials -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-base-content/70 mb-1">Username *</label>
                                    <input type="text" wire:model="editUsername" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" />
                                    @error('editUsername') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-base-content/70 mb-1">New Password</label>
                                    <input type="text" wire:model="editPassword" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" placeholder="Leave blank to keep old" />
                                </div>
                            </div>

                            <!-- Role & Permissions (Disabled for Super Admin) -->
                            @if($editRole !== 'super_admin')
                            <div>
                                <label class="block text-sm font-medium text-base-content/70 mb-2">Assign Role *</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" wire:model.live="editRole" value="admin" class="radio radio-[#00a550] radio-sm" />
                                        <span class="text-sm font-medium text-base-content">Admin</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" wire:model.live="editRole" value="user" class="radio radio-[#00a550] radio-sm" />
                                        <span class="text-sm font-medium text-base-content">User (Mobile Dashboard)</span>
                                    </label>
                                </div>
                            </div>

                            @if($editRole === 'admin')
                            <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl">
                                <h4 class="font-bold text-[#00a550] text-sm mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" /></svg>
                                    Module Access for Admin
                                </h4>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach($modules as $key => $label)
                                    <label class="flex items-center gap-2 cursor-pointer bg-white p-2 rounded-lg border border-emerald-100 hover:border-[#00a550] transition-colors shadow-sm">
                                        <input type="checkbox" wire:model="editPermissions" value="{{ $key }}" class="checkbox checkbox-sm checkbox-success" />
                                        <span class="text-sm text-base-content">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @elseif($editRole === 'user')
                            <div class="bg-teal-50 border border-teal-200 p-3 rounded-lg text-sm text-teal-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                This user will only have access to the Mobile Dashboard.
                            </div>
                            @endif
                            @endif

                            <div class="flex gap-3 pt-2">
                                <button wire:click="closeEditUserModal" class="flex-1 py-2 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-200">Cancel</button>
                                <button wire:click="updateUserInfo" class="flex-1 bg-[#00a550] hover:bg-[#008c44] text-white font-bold py-2 rounded-xl shadow-md">Update Info</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- ===== 📱 SMS Gateway Tab ===== -->
                <div x-show="activeTab === 'sms'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <div class="bg-base-200 rounded-xl border border-base-300 overflow-hidden shadow-sm">
                        
                        <!-- Card Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 pb-3 border-b-2 border-dashed border-emerald-100 bg-emerald-50/50">
                            <h3 class="text-lg font-bold text-base-content flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#00a550]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                                SMS Gateway Configuration
                            </h3>
                        </div>

                        <div class="p-6 space-y-5">
                            
                            <!-- Status Toggle -->
                            <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-[#00a550] text-sm">Gateway Status</h4>
                                    <p class="text-xs text-base-content/60 mt-1">SMS পাঠানোর সুবিধা চালু অথবা বন্ধ রাখুন</p>
                                </div>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <span class="text-sm font-semibold {{ $sms_is_active ? 'text-[#00a550]' : 'text-red-500' }}">
                                        {{ $sms_is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <input type="checkbox" wire:model.live="sms_is_active" class="toggle toggle-success" />
                                </label>
                            </div>

                            <!-- API Configuration Form -->
                            <form wire:submit="saveSmsSettings" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-base-content/70 mb-1">API URL *</label>
                                    <input type="url" wire:model="sms_api_url" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" placeholder="https://api.mimsms.com/api/SmsSending/SMS" />
                                    @error('sms_api_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">API Key / Token *</label>
                                        <input type="text" wire:model="sms_api_key" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" placeholder="আপনার API Key বসান" />
                                        @error('sms_api_key') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">API Username</label>
                                        <input type="text" wire:model="sms_api_username" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" placeholder="MIMSMS এর UserName" />
                                        <p class="text-xs text-base-content/50 mt-1">আপনার প্রোভাইডার থেকে দেওয়া UserName</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">Sender ID / Mask *</label>
                                        <input type="text" wire:model="sms_sender_id" class="input input-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" placeholder="e.g., MySomiti" />
                                        @error('sms_sender_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        <p class="text-xs text-base-content/50 mt-1">যে নাম থেকে SMS আসবে</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-base-content/70 mb-1">Transaction Type</label>
                                        <select wire:model="sms_transaction_type" class="select select-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]">
                                            <option value="T">T - Text (English Only)</option>
                                            <option value="U">U - Unicode (Bangla Supported)</option>
                                        </select>
                                        <p class="text-xs text-base-content/50 mt-1">বাংলা মেসেজ পাঠাতে 'Unicode' সিলেক্ট করুন</p>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-[#00a550] hover:bg-[#008c44] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    Save Configuration
                                </button>
                            </form>

                            <!-- Test SMS Section -->
                            @if($sms_is_active && $sms_api_url)
                            <div class="border-t border-base-200 pt-5 mt-5">
                                <h4 class="font-bold text-base-content mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Test SMS
                                </h4>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="test_sms_phone" class="input input-bordered flex-1 focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550]" placeholder="ফোন নম্বর (যেমন: 01700000000)" />
                                    <button wire:click="sendTestSms" wire:loading.attr="disabled" class="btn bg-amber-500 hover:bg-amber-600 text-white border-none shadow-md">
                                        <span wire:loading.remove>Send Test</span>
                                        <span wire:loading>Sending...</span>
                                    </button>
                                </div>
                                @error('test_sms_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

                
                <!-- ===== 🔧 System Tools Tab ===== -->
                <div x-show="activeTab === 'system_tools'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <!-- ✅ System Tools Sub-Tab Navigation -->
                    <div x-data="{ activeSubTab: 'date_time' }" class="space-y-6">
                        
                        <!-- Sub-Tab Buttons -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            <button @click="activeSubTab = 'date_time'" :class="activeSubTab === 'date_time' ? 'bg-emerald-600 text-white shadow-md' : 'bg-base-200 text-base-content hover:bg-base-300'" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                                Date & Time
                            </button>
                            <button @click="activeSubTab = 'export'" :class="activeSubTab === 'export' ? 'bg-blue-600 text-white shadow-md' : 'bg-base-200 text-base-content hover:bg-base-300'" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                Export Data
                            </button>
                            <button @click="activeSubTab = 'backup'" :class="activeSubTab === 'backup' ? 'bg-indigo-600 text-white shadow-md' : 'bg-base-200 text-base-content hover:bg-base-300'" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                Backup
                            </button>
                            <button @click="activeSubTab = 'activity_log'" :class="activeSubTab === 'activity_log' ? 'bg-purple-600 text-white shadow-md' : 'bg-base-200 text-base-content hover:bg-base-300'" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" /></svg>
                                Activity Log
                            </button>
                            <button @click="activeSubTab = 'danger'" :class="activeSubTab === 'danger' ? 'bg-red-600 text-white shadow-md' : 'bg-red-50 text-red-500 hover:bg-red-100 border border-red-200'" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                Dangerous Zone
                            </button>
                        </div>

                        <!-- ===== 📅 Date & Time Sub-Tab ===== -->
                        <div x-show="activeSubTab === 'date_time'" x-transition>
                            <div class="bg-base-200 rounded-xl border border-base-300 overflow-hidden shadow-sm">
                                
                                <!-- Header -->
                                <div class="flex justify-between items-center p-4 border-b-2 border-dashed border-emerald-100 bg-emerald-50/50">
                                    <h3 class="text-lg font-bold text-base-content flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#00a550]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Date & Time Configuration
                                    </h3>
                                </div>

                                <div class="p-6 space-y-5">
                                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl flex items-start gap-3 text-blue-700 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                                        <span>এই সেটিংস পুরো সিস্টেমের তারিখ এবং সময় দেখানোর ফরম্যাট নিয়ন্ত্রণ করবে। পরিবর্তনের পর সিস্টেম রিফ্রেশ করতে পারে।</span>
                                    </div>

                                    <form wire:submit="saveDateTimeSettings" class="space-y-5">
                                        <!-- Date Format -->
                                        <div>
                                            <label class="block text-sm font-semibold text-base-content/80 mb-2">📅 Date Display Format *</label>
                                            <select wire:model.live="date_format" class="select select-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550] bg-white">
                                                <option value="d M, Y">10 June, 2026 (d M, Y)</option>
                                                <option value="d/m/Y">10/06/2026 (d/m/Y)</option>
                                                <option value="m/d/Y">06/10/2026 (m/d/Y)</option>
                                                <option value="Y-m-d">2026-06-10 (Y-m-d)</option>
                                                <option value="d M Y">10 June 2026 (d M Y)</option>
                                                <option value="jS M, Y">10th June, 2026 (jS M, Y)</option>
                                            </select>
                                            <p class="text-xs text-base-content/50 mt-1">সিস্টেমে তারিখ কীভাবে দেখাবে তা নির্বাচন করুন।</p>
                                        </div>

                                        <!-- Time Format -->
                                        <div>
                                            <label class="block text-sm font-semibold text-base-content/80 mb-2">🕐 Time Display Format *</label>
                                            <select wire:model.live="time_format" class="select select-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550] bg-white">
                                                <option value="h:i A">02:30 PM (h:i A)</option>
                                                <option value="h:i:s A">02:30:15 PM (h:i:s A)</option>
                                                <option value="H:i">14:30 (H:i)</option>
                                                <option value="H:i:s">14:30:15 (H:i:s)</option>
                                            </select>
                                            <p class="text-xs text-base-content/50 mt-1">সিস্টেমে সময় কীভাবে দেখাবে তা নির্বাচন করুন।</p>
                                        </div>

                                        <!-- Timezone -->
                                        <div>
                                            <label class="block text-sm font-semibold text-base-content/80 mb-2">🌍 Timezone *</label>
                                            <select wire:model.live="timezone" class="select select-bordered w-full focus:ring-2 focus:ring-[#00a550] focus:border-[#00a550] bg-white">
                                                <option value="Asia/Dhaka">🇧🇩 Asia/Dhaka (BST +6:00)</option>
                                                <option value="Asia/Kolkata">🇮🇳 Asia/Kolkata (IST +5:30)</option>
                                                <option value="Asia/Karachi">🇵🇰 Asia/Karachi (PKT +5:00)</option>
                                                <option value="Asia/Riyadh">🇸🇦 Asia/Riyadh (AST +3:00)</option>
                                                <option value="Asia/Dubai">🇦🇪 Asia/Dubai (GST +4:00)</option>
                                                <option value="Asia/Singapore">🇸🇬 Asia/Singapore (SGT +8:00)</option>
                                                <option value="America/New_York">🇺🇸 America/New_York (EST -5:00)</option>
                                                <option value="Europe/London">🇬🇧 Europe/London (GMT +0:00)</option>
                                                <option value="UTC">🌐 UTC</option>
                                            </select>
                                            <p class="text-xs text-base-content/50 mt-1">আপনার লোকাল টাইমজোন সিলেক্ট করুন।</p>
                                        </div>

                                        <!-- Live Preview -->
                                        <div class="bg-white p-4 rounded-lg border border-base-200">
                                            <h4 class="text-xs font-bold text-base-content/60 uppercase mb-2">Preview</h4>
                                            <div class="flex gap-4 text-sm">
                                                <div>
                                                    <span class="text-base-content/60">Current Date:</span>
                                                    <span class="font-bold text-[#00a550] ml-1">{{ now()->format($date_format) }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-base-content/60">Time:</span>
                                                    <span class="font-bold text-base-content ml-1">{{ now()->timezone($timezone)->format($time_format) }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="w-full bg-[#00a550] hover:bg-[#008c44] text-white font-bold py-2.5 rounded-xl shadow-md flex items-center justify-center gap-2 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Save Settings
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>


                                                <!-- ===== 📋 Activity Log Sub-Tab ===== -->
                        <div x-show="activeSubTab === 'activity_log'" x-transition>
                            <div class="bg-base-200 rounded-xl border border-base-300 overflow-hidden shadow-sm">
                                
                                <!-- Header -->
                                <div class="flex justify-between items-center p-4 border-b-2 border-dashed border-purple-100 bg-purple-50/50">
                                    <h3 class="text-lg font-bold text-base-content flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" /></svg>
                                        Recent Activity Logs
                                    </h3>
                                    <span class="text-xs text-base-content/50">Showing Latest 50</span>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="table w-full text-sm">
                                        <thead>
                                            <tr class="bg-purple-50 text-purple-800 uppercase text-xs">
                                                <th>Time</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                                <th>Description</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($activityLogs as $log)
                                            <tr class="border-b border-base-200 hover:bg-purple-50/30 transition-colors">
                                                <td class="text-xs text-base-content/60 whitespace-nowrap">{{ formatDateTime($log->created_at) }}</td>
                                                <td>
                                                    @php 
                                                        $color = match($log->log_type) {
                                                            'Loan Disbursement' => 'badge-error',
                                                            'Loan Repayment' => 'badge-info',
                                                            default => 'badge-ghost'
                                                        };
                                                    @endphp
                                                    <span class="badge badge-sm {{ $color }} text-white">{{ $log->log_type }}</span>
                                                </td>
                                                <td class="font-semibold text-base-content">{{ $log->action }}</td>
                                                <td class="text-base-content/80">{{ $log->description }}</td>
                                                <td class="text-xs text-base-content/60">{{ $log->user->name ?? 'System' }}</td>
                                            </tr>
                                            @empty
                                            <tr><td colspan="5" class="text-center py-8 text-base-content/40">No activity logs found.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- ===== 📥 Export Data Sub-Tab ===== -->
                        <div x-show="activeSubTab === 'export'" x-transition>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                
                                <!-- Export Members -->
                                <div class="bg-base-200 rounded-xl border border-base-300 p-5 hover:shadow-md transition-all group">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-emerald-100 p-3 rounded-xl text-[#00a550] group-hover:scale-105 transition-transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-base-content text-sm">Member List</h4>
                                            <p class="text-xs text-base-content/60 mt-1">সকল সদস্যের তথ্য CSV ফরম্যাটে ডাউনলোড করুন</p>
                                            <button wire:click="exportMembers" class="mt-3 btn btn-sm bg-[#00a550] hover:bg-[#008c44] text-white border-none shadow-sm gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                                Download CSV
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Export Deposits -->
                                <div class="bg-base-200 rounded-xl border border-base-300 p-5 hover:shadow-md transition-all group">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-blue-100 p-3 rounded-xl text-blue-600 group-hover:scale-105 transition-transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-base-content text-sm">Deposit History</h4>
                                            <p class="text-xs text-base-content/60 mt-1">মাসিক জমার পুরো ইতিহাস ডাউনলোড করুন</p>
                                            <button wire:click="exportDeposits" class="mt-3 btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-none shadow-sm gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                                Download CSV
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Export Loans -->
                                <div class="bg-base-200 rounded-xl border border-base-300 p-5 hover:shadow-md transition-all group">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-purple-100 p-3 rounded-xl text-purple-600 group-hover:scale-105 transition-transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-base-content text-sm">Loan Data</h4>
                                            <p class="text-xs text-base-content/60 mt-1">সকল লোনের ডাটা ও স্ট্যাটাস ডাউনলোড করুন</p>
                                            <button wire:click="exportLoans" class="mt-3 btn btn-sm bg-purple-600 hover:bg-purple-700 text-white border-none shadow-sm gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                                Download CSV
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Export Account Statement -->
                                <div class="bg-base-200 rounded-xl border border-base-300 p-5 hover:shadow-md transition-all group">
                                    <div class="flex items-start gap-4">
                                        <div class="bg-amber-100 p-3 rounded-xl text-amber-600 group-hover:scale-105 transition-transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-base-content text-sm">Account Statement</h4>
                                            <p class="text-xs text-base-content/60 mt-1">সকল অ্যাকাউন্টের ব্যালেন্স শিট ডাউনলোড করুন</p>
                                            <button wire:click="exportAccountStatement" class="mt-3 btn btn-sm bg-amber-500 hover:bg-amber-600 text-white border-none shadow-sm gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                                Download CSV
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Info Note -->
                            <div class="mt-6 bg-blue-50 border border-blue-200 p-4 rounded-xl flex items-start gap-3 text-blue-700 text-sm">
                                <svg xmlns="http://www.w3.org/2000/XMLSchema" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                                <span>ডাউনলোড করা ফাইলগুলো <strong>CSV ফরম্যাট</strong>-এ সেভ হবে এবং Microsoft Excel বা Google Sheets-এ সরাসরি ওপেন করা যাবে। বাংলা টেক্সট ঠিকভাবে দেখানোর জন্য UTF-8 এনকোডিং ব্যবহার করা হয়েছে।</span>
                            </div>
                        </div>

                        <!-- ===== 💾 Backup Sub-Tab (Placeholder) ===== -->
                        <div x-show="activeSubTab === 'backup'" x-transition>
                            <div class="flex flex-col items-center justify-center py-16 text-center bg-indigo-50/30 rounded-2xl border border-dashed border-indigo-200">
                                <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-indigo-500"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                </div>
                                <h3 class="text-xl font-bold text-indigo-700">Database Backup</h3>
                                <p class="text-sm text-indigo-600/60 mt-2 max-w-sm">ডাটাবেজ ব্যাকআপ নেওয়ার এবং রিস্টোর করার অপশন এখানে থাকবে।</p>
                            </div>
                        </div>

                        <!-- ===== ⚠️ Dangerous Zone Sub-Tab (Placeholder) ===== -->
                        <div x-show="activeSubTab === 'danger'" x-transition>
                            <div class="flex flex-col items-center justify-center py-16 text-center bg-red-50/30 rounded-2xl border border-dashed border-red-200">
                                <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-red-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                </div>
                                <h3 class="text-xl font-bold text-red-700">Dangerous Zone</h3>
                                <p class="text-sm text-red-600/60 mt-2 max-w-sm">ডাটা ডিলিট এবং রিসেট করার মতো ঝুঁকিপূর্ণ কাজ এখানে করা যাবে। সতর্কতার সাথে ব্যবহার করুন!</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>