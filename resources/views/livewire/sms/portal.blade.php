<div>
    <!-- Success/Error Message -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
             class="fixed top-5 left-1/2 -translate-x-1/2 z-[100] bg-white dark:bg-base-100 shadow-2xl border-l-4 border-green-500 text-green-700 px-5 py-4 rounded-xl flex items-center gap-3 max-w-sm text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-sm font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <!-- ===== Modern Gradient Header ===== -->
    <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 via-blue-600 to-indigo-700 p-6 sm:p-8 rounded-t-2xl shadow-lg text-white">
        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">SMS Portal</h1>
                    <p class="text-sm text-blue-100 mt-1">Instant messaging hub for your organization</p>
                </div>
            </div>
            <div class="flex gap-3 w-full sm:w-auto">
                @if($smsActive)
                    <button wire:click="checkBalance" class="flex-1 sm:flex-none bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/30 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>
                        💳 Balance
                    </button>
                @endif
                <a href="{{ route('settings.index', ['tab' => 'sms']) }}" class="flex-1 sm:flex-none bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-medium py-2.5 px-5 rounded-xl shadow text-sm flex items-center justify-center gap-2 border border-white/20 transition-all">
                    ⚙️ Settings
                </a>
            </div>
        </div>
        
        <!-- Balance Display -->
        @if($balanceMessage)
            <div class="relative z-10 mt-4 bg-white/10 backdrop-blur-md p-3 rounded-xl text-sm font-medium border border-white/20 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                {{ $balanceMessage }}
            </div>
        @endif
    </div>

    <!-- ===== Body Section ===== -->
    <div class="bg-base-100 p-2 sm:p-0 rounded-b-2xl shadow-xl border border-t-0 border-base-300">

        @if(!$smsActive)
            <div class="p-8 text-center">
                <div class="bg-red-500/10 border-l-4 border-red-500 text-red-500 p-6 rounded-xl shadow-sm max-w-lg mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                    <h3 class="text-lg font-bold text-red-600">SMS Gateway Inactive</h3>
                    <p class="text-sm text-red-400 mt-1">Please configure and activate your gateway from settings.</p>
                    <a href="{{ route('settings.index') }}" class="btn btn-sm btn-outline btn-error mt-4">Go to Settings</a>
                </div>
            </div>
        @else
            
            <!-- ========================================== -->
            <!-- ===== 📱 MOBILE VIEW (App-like UI) ===== -->
            <!-- ========================================== -->
            <div class="md:hidden">
                
                <!-- Mobile FAB (Floating Action Button) -->
                <div class="fixed bottom-24 right-5 z-40" x-data="{ open: false }">
                    <div x-show="open" x-transition class="absolute bottom-16 right-0 space-y-2 w-48">
                        <button wire:click="$set('activeTab', 'send')" @click="open = false" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg shadow-lg text-sm font-bold flex items-center gap-2 hover:bg-blue-700">
                            ✉️ Compose
                        </button>
                        <button wire:click="$set('activeTab', 'templates')" @click="open = false" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg shadow-lg text-sm font-bold flex items-center gap-2 hover:bg-purple-700">
                            📋 Templates
                        </button>
                    </div>
                    <button @click="open = !open" class="bg-sky-600 hover:bg-sky-700 text-white p-4 rounded-full shadow-2xl transition-all transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    </button>
                </div>

                <!-- Mobile Tab Content -->
                <div class="min-h-[60vh] p-4">
                    @if($activeTab === 'send')
                        @include('livewire.sms.partials.mobile-compose')
                    @elseif($activeTab === 'templates')
                        @include('livewire.sms.partials.mobile-templates')
                    @elseif($activeTab === 'history')
                        @include('livewire.sms.partials.mobile-history')
                    @endif
                </div>

                <!-- Mobile Bottom Navigation -->
                <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-base-100 border-t border-base-200 flex justify-around items-center h-16 z-40 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                    <button wire:click="$set('activeTab', 'send')" class="flex flex-col items-center pt-1 {{ $activeTab === 'send' ? 'text-sky-600' : 'text-gray-400 hover:text-gray-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                        <span class="text-[10px] font-bold mt-0.5">Compose</span>
                    </button>
                    <button wire:click="$set('activeTab', 'templates')" class="flex flex-col items-center pt-1 {{ $activeTab === 'templates' ? 'text-indigo-600' : 'text-gray-400 hover:text-gray-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        <span class="text-[10px] font-bold mt-0.5">Templates</span>
                    </button>
                    <button wire:click="$set('activeTab', 'history')" class="flex flex-col items-center pt-1 {{ $activeTab === 'history' ? 'text-emerald-600' : 'text-gray-400 hover:text-gray-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-[10px] font-bold mt-0.5">History</span>
                    </button>
                </div>
            </div>

            <!-- ================================================= -->
            <!-- ===== 💻 DESKTOP VIEW (Split Dashboard UI) ===== -->
            <!-- ================================================= -->
            <div class="hidden md:grid md:grid-cols-3 gap-0 min-h-[70vh]">
                
                <!-- ===== Left Sidebar (Workspace) ===== -->
                <div class="col-span-1 bg-base-50 dark:bg-base-200/30 border-r border-base-200 p-6 flex flex-col gap-6 overflow-y-auto">
                    
                    <!-- Quick Stats -->
                    <div class="space-y-3">
                        <h3 class="text-xs font-bold text-base-content/50 uppercase tracking-wider">Dashboard</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/20 p-3 rounded-xl shadow-sm flex items-center gap-3">
                                <div class="bg-emerald-100 p-2.5 rounded-full text-emerald-600 shadow-sm">✅</div>
                                <div>
                                    <p class="text-[10px] text-emerald-600/70 font-bold uppercase tracking-wider">Sent</p>
                                    <p class="text-xl font-extrabold text-emerald-700">{{ $history->where('status', 'Success')->count() }}</p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-red-500/10 to-red-500/5 border border-red-500/20 p-3 rounded-xl shadow-sm flex items-center gap-3">
                                <div class="bg-red-100 p-2.5 rounded-full text-red-600 shadow-sm">❌</div>
                                <div>
                                    <p class="text-[10px] text-red-600/70 font-bold uppercase tracking-wider">Failed</p>
                                    <p class="text-xl font-extrabold text-red-700">{{ $history->where('status', '!=', 'Success')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SMS Categories -->
                    <div class="space-y-2">
                        <h3 class="text-xs font-bold text-base-content/50 uppercase tracking-wider flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" /></svg>
                            Categories
                        </h3>
                        <div class="space-y-2">
                            @foreach([
                                'Single SMS' => ['icon' => '👤', 'bg' => 'from-sky-500/10 to-sky-500/5', 'border' => 'border-sky-500/20', 'iconBg' => 'bg-sky-100', 'text' => 'text-sky-700'],
                                'Alert SMS' => ['icon' => '🚨', 'bg' => 'from-red-500/10 to-red-500/5', 'border' => 'border-red-500/20', 'iconBg' => 'bg-red-100', 'text' => 'text-red-700'],
                                'Due SMS' => ['icon' => '⏳', 'bg' => 'from-amber-500/10 to-amber-500/5', 'border' => 'border-amber-500/20', 'iconBg' => 'bg-amber-100', 'text' => 'text-amber-700'],
                                'Loan SMS' => ['icon' => '💰', 'bg' => 'from-emerald-500/10 to-emerald-500/5', 'border' => 'border-emerald-500/20', 'iconBg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
                                'Group SMS' => ['icon' => '👥', 'bg' => 'from-purple-500/10 to-purple-500/5', 'border' => 'border-purple-500/20', 'iconBg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                                'Meeting SMS' => ['icon' => '📅', 'bg' => 'from-indigo-500/10 to-indigo-500/5', 'border' => 'border-indigo-500/20', 'iconBg' => 'bg-indigo-100', 'text' => 'text-indigo-700'],
                            ] as $cat => $config)
                            <button wire:click="$set('selectedCategory', '{{ $cat }}')" 
                                    class="w-full text-left bg-gradient-to-br {{ $config['bg'] }} border {{ $config['border'] }} p-3 rounded-xl shadow-sm flex items-center gap-3 transition-all {{ $selectedCategory === $cat ? 'ring-2 ring-offset-1 ring-' . explode('-', $config['text'])[1] . '-400 shadow-md' : 'hover:shadow-md' }}">
                                <div class="{{ $config['iconBg'] }} p-2 rounded-full text-sm shadow-sm">
                                    {{ $config['icon'] }}
                                </div>
                                <span class="text-sm font-bold {{ $config['text'] }}">{{ $cat }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- ✅ বাম সাইডবার: শুধুমাত্র সিলেক্টেড ক্যাটাগরির টেমপ্লেট ($templates) -->
                    <div class="space-y-2 flex-1 overflow-y-auto">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xs font-bold text-base-content/50 uppercase tracking-wider flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                {{ $selectedCategory }} Templates
                            </h3>
                            <button wire:click="openTemplateModal()" class="bg-sky-100 hover:bg-sky-200 text-sky-700 p-1.5 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            </button>
                        </div>
                        <div class="space-y-2">
                            @php
                                $sideTplColors = [
                                    'Single SMS' => ['bg' => 'from-sky-500/10 to-sky-500/5', 'border' => 'border-sky-500/20', 'hover' => 'hover:border-sky-400', 'badge' => 'bg-sky-100 text-sky-700'],
                                    'Alert SMS' => ['bg' => 'from-red-500/10 to-red-500/5', 'border' => 'border-red-500/20', 'hover' => 'hover:border-red-400', 'badge' => 'bg-red-100 text-red-700'],
                                    'Due SMS' => ['bg' => 'from-amber-500/10 to-amber-500/5', 'border' => 'border-amber-500/20', 'hover' => 'hover:border-amber-400', 'badge' => 'bg-amber-100 text-amber-700'],
                                    'Loan SMS' => ['bg' => 'from-emerald-500/10 to-emerald-500/5', 'border' => 'border-emerald-500/20', 'hover' => 'hover:border-emerald-400', 'badge' => 'bg-emerald-100 text-emerald-700'],
                                    'Group SMS' => ['bg' => 'from-purple-500/10 to-purple-500/5', 'border' => 'border-purple-500/20', 'hover' => 'hover:border-purple-400', 'badge' => 'bg-purple-100 text-purple-700'],
                                ];
                            @endphp
                            @forelse($templates as $tpl)
                            @php $sClr = $sideTplColors[$tpl->category] ?? ['bg' => 'from-gray-500/10 to-gray-500/5', 'border' => 'border-gray-500/20', 'hover' => 'hover:border-gray-400', 'badge' => 'bg-gray-100 text-gray-700']; @endphp
                            <button wire:click="$set('selectedTemplate', {{ $tpl->id }})" wire:click="$set('activeTab', 'send')"
                                    class="w-full text-left bg-gradient-to-br {{ $sClr['bg'] }} p-3 rounded-xl border {{ $sClr['border'] }} {{ $sClr['hover'] }} transition-all group shadow-sm">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-bold text-sm text-base-content truncate">{{ $tpl->name }}</h4>
                                    <span class="badge badge-sm {{ $sClr['badge'] }} border-0 text-[10px] font-bold">{{ $tpl->category }}</span>
                                </div>
                                <p class="text-xs text-base-content/60 mt-1 line-clamp-1">{{ $tpl->message }}</p>
                            </button>
                            @empty
                            <p class="text-xs text-center text-base-content/40 py-4">No templates in this category.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- ===== Right Content Area ===== -->
                <div class="col-span-2 bg-base-100 p-6 flex flex-col overflow-y-auto">
                    
                    <!-- Desktop Top Tabs -->
                    <div class="flex gap-1 mb-6 border-b border-base-200 dark:border-base-300 pb-0">
                        <button wire:click="$set('activeTab', 'send')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'send' ? 'bg-sky-600 text-white shadow-md' : 'bg-sky-50 text-sky-600 hover:bg-sky-100 border border-sky-200' }}">
                            ✉️ Compose
                        </button>
                        <button wire:click="$set('activeTab', 'templates')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'templates' ? 'bg-indigo-600 text-white shadow-md' : 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border border-indigo-200' }}">
                            📋 Templates
                        </button>
                        <button wire:click="$set('activeTab', 'history')" class="px-4 py-2 text-sm font-bold rounded-t-lg transition-all duration-200 flex items-center gap-2 {{ $activeTab === 'history' ? 'bg-emerald-600 text-white shadow-md' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100 border border-emerald-200' }}">
                            📜 History
                        </button>
                    </div>

                    <!-- Desktop Tab Content -->
                    @if($activeTab === 'send')
                        @include('livewire.sms.partials.desktop-compose')
                    @elseif($activeTab === 'templates')
                        @include('livewire.sms.partials.desktop-templates')
                    @elseif($activeTab === 'history')
                        @include('livewire.sms.partials.desktop-history')
                    @endif

                </div>
            </div>
        @endif
    </div>

    <!-- ===== Add/Edit Template Modal ===== -->
    @if($showTemplateModal)
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[100] p-4" wire:click="$set('showTemplateModal', false)">
        <div class="bg-white dark:bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-0 relative border border-base-200 dark:border-base-300" wire:click.stop>
            <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-5 rounded-t-2xl text-white flex justify-between items-center">
                <h2 class="text-lg font-bold flex items-center gap-2">{{ $templateId ? '✏️ Edit Template' : '➕ New Template' }}</h2>
                <button wire:click="$set('showTemplateModal', false)" class="text-white/70 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-base-content/80 mb-1">Template Name *</label>
                    <input type="text" wire:model="templateName" class="input input-bordered w-full focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all" placeholder="e.g., Due Reminder - Final" />
                    @error('templateName') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-base-content/80 mb-1">Category *</label>
                    <select wire:model="templateCategory" class="select select-bordered w-full focus:ring-2 focus:ring-sky-500">
                        @foreach($smsCategories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-base-content/80 mb-1">Message Body *</label>
                    <textarea wire:model="templateMessage" class="textarea textarea-bordered w-full focus:ring-2 focus:ring-sky-500 transition-all" rows="4" placeholder="Write your message body here..."></textarea>
                    @error('templateMessage') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>{{ $message }}</span> @enderror
                </div>
                <div class="flex gap-3 pt-2">
                    <button wire:click="$set('showTemplateModal', false)" class="flex-1 py-2.5 border border-base-300 rounded-xl hover:bg-base-100 dark:hover:bg-base-200 font-medium text-sm transition-all">Cancel</button>
                    <button wire:click="saveTemplate" class="flex-1 bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 rounded-xl shadow-md text-sm transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Save Template
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== Delete Confirmation Modal ===== -->
    @if($confirmDelete)
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[100] p-4" wire:click="$set('confirmDelete', false)">
        <div class="bg-white dark:bg-base-100 rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center border border-base-200 dark:border-base-300" wire:click.stop>
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900/30 mb-5">
                <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <h3 class="text-xl font-bold text-base-content mb-2">Delete Template?</h3>
            <p class="text-sm text-base-content/60 mb-8">Are you sure? This action cannot be undone.</p>
            <div class="flex gap-4">
                <button wire:click="$set('confirmDelete', false)" class="w-1/2 py-2.5 border border-base-300 rounded-xl text-base-content font-medium hover:bg-base-100 dark:hover:bg-base-200 text-sm transition-all">Cancel</button>
                <button wire:click="deleteTemplate" class="w-1/2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl shadow-md text-sm transition-all">Yes, Delete</button>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== 📬 Delivery Options Modal (Alert SMS) ===== -->
    @if($showDeliveryModal)
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[100] p-4" wire:click="$set('showDeliveryModal', false)">
        <div class="bg-white dark:bg-base-100 rounded-2xl shadow-2xl max-w-md w-full p-0 relative border border-base-200 dark:border-base-300" wire:click.stop>
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-5 rounded-t-2xl text-white flex justify-between items-center">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    @if($selectedCategory === 'Alert SMS') 🚨
                    @elseif($selectedCategory === 'Due SMS') ⏳
                    @elseif($selectedCategory === 'Loan SMS') 💰
                    @elseif($selectedCategory === 'Group SMS') 👥
                    @elseif($selectedCategory === 'Meeting SMS') 📅
                    @else 📱
                    @endif
                    {{ $selectedCategory }} - Delivery Options
                </h2>
                <button wire:click="$set('showDeliveryModal', false)" class="text-white/70 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <p class="text-sm text-base-content/70">
                    Choose how to send this 
                    @if($selectedCategory === 'Alert SMS') alert
                    @elseif($selectedCategory === 'Due SMS') due reminder
                    @elseif($selectedCategory === 'Loan SMS') loan update
                    @elseif($selectedCategory === 'Group SMS') group message
                    @elseif($selectedCategory === 'Meeting SMS') meeting notice
                    @else message
                    @endif
                    to {{ count($selectedMembers) }} member(s):
                </p>
                
                <!-- Delivery Checkboxes -->
                <div class="space-y-3">
                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition-all {{ $sendViaSMS ? 'border-sky-500 bg-sky-50' : 'border-base-300 hover:border-sky-300' }}">
                        <input type="checkbox" wire:model="sendViaSMS" class="checkbox checkbox-primary mt-0.5" />
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">📱</span>
                                <span class="font-bold text-base">Send via SMS</span>
                            </div>
                            <p class="text-xs text-base-content/60 mt-1">Message will be sent to mobile numbers (charges apply)</p>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition-all {{ $sendViaNotification ? 'border-emerald-500 bg-emerald-50' : 'border-base-300 hover:border-emerald-300' }}">
                        <input type="checkbox" wire:model="sendViaNotification" class="checkbox checkbox-success mt-0.5" />
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">🔔</span>
                                <span class="font-bold text-base">Send as Notification</span>
                            </div>
                            <p class="text-xs text-base-content/60 mt-1">Alert will appear in mobile app (free)</p>
                        </div>
                    </label>
                </div>

                <!-- Notification Title (only if notification checked) -->
                @if($sendViaNotification)
                <div x-show="true" x-transition class="space-y-2">
                    <label class="block text-sm font-semibold text-base-content/80">Notification Title</label>
                    <input type="text" wire:model="noticeTitle" class="input input-bordered w-full focus:ring-2 focus:ring-emerald-500" placeholder="e.g., Important Alert" />
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4">
                    <button wire:click="$set('showDeliveryModal', false)" class="flex-1 py-2.5 border border-base-300 rounded-xl hover:bg-base-100 dark:hover:bg-base-200 font-medium text-sm transition-all">Cancel</button>
                    <button wire:click="confirmAndSend" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl shadow-md text-sm transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                        Send Alert
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ===== ✅ View Message Detail Modal (New Design) ===== -->
    @if($showViewMessageModal && $viewMessageData)
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[100] p-4" wire:click="closeViewMessageModal">
        <div class="bg-white dark:bg-base-100 rounded-2xl shadow-2xl max-w-lg w-full p-0 relative border border-base-200 dark:border-base-300" wire:click.stop>
            
            <!-- Header -->
            <div class="p-5 border-b border-sky-100 flex justify-between items-center bg-sky-500/5 rounded-t-2xl">
                <h2 class="text-lg font-bold text-sky-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                    SMS Delivery Details
                </h2>
                <button wire:click="closeViewMessageModal" class="text-sky-400 hover:text-sky-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">
                
                <!-- Recipient Profile Card -->
                <div class="flex items-center gap-4 bg-sky-500/5 p-4 rounded-xl border border-sky-500/20">
                    <!-- Avatar -->
                    <div class="avatar placeholder">
                        <div class="bg-gradient-to-br from-sky-500 to-blue-600 text-white w-14 h-14 rounded-full shadow-md flex items-center justify-center">
                            @if($viewMessageData->member && $viewMessageData->member->photo)
                                <img src="{{ asset('storage/' . $viewMessageData->member->photo) }}" class="w-14 h-14 rounded-full object-cover" />
                            @else
                                <span class="text-xl font-bold">{{ strtoupper($viewMessageData->member_name[0] ?? 'U') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-base-content text-base truncate">{{ $viewMessageData->member_name ?? 'Unknown' }}</h3>
                        <p class="text-sm text-sky-600 font-mono font-semibold">{{ $viewMessageData->phone }}</p>
                    </div>
                    <!-- Type Badge -->
                    <span class="badge bg-sky-100 text-sky-700 badge-md border-0 font-bold">{{ $viewMessageData->sms_type }} SMS</span>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <!-- Account -->
                    <div class="bg-sky-500/5 p-3 rounded-lg border border-sky-500/20">
                        <p class="text-xs font-bold text-sky-600/70 uppercase">Account</p>
                        <p class="font-bold text-sky-700 mt-0.5">#{{ $viewMessageData->acc_no ?? 'N/A' }}</p>
                    </div>
                    <!-- Shares -->
                    <div class="bg-sky-500/5 p-3 rounded-lg border border-sky-500/20">
                        <p class="text-xs font-bold text-sky-600/70 uppercase">Shares</p>
                        <p class="font-bold text-base-content mt-0.5">{{ $viewMessageData->member->shares ?? 'N/A' }}</p>
                    </div>
                    <!-- Send Status -->
                    <div class="bg-sky-500/5 p-3 rounded-lg border border-sky-500/20">
                        <p class="text-xs font-bold text-sky-600/70 uppercase">Send Status</p>
                        <div class="mt-1">
                            @if(str_contains($viewMessageData->status, 'Success'))
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Success
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-red-600 font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                    Failed
                                </span>
                            @endif
                        </div>
                    </div>
                        <!-- Delivery Status -->
                        <div class="bg-sky-500/5 p-3 rounded-lg border border-sky-500/20">
                            <p class="text-xs font-bold text-sky-600/70 uppercase">Delivery Status</p>
                            <p class="font-bold mt-0.5">
                                @if(str_contains($viewMessageData->status, 'Success'))
                                    <span class="text-emerald-600">✅ Accepted by Gateway</span>
                                @else
                                    <span class="text-red-600">❌ Gateway Rejected</span>
                                @endif
                            </p>
                        </div>
                    <!-- Transaction ID -->
                    <div class="bg-sky-500/5 p-3 rounded-lg border border-sky-500/20 col-span-2">
                        <p class="text-xs font-bold text-sky-600/70 uppercase">Transaction ID</p>
                        <p class="font-mono text-xs bg-sky-100 px-2 py-1 rounded inline-block mt-0.5 text-sky-800">{{ $viewMessageData->trxn_id ?? 'N/A' }}</p>
                    </div>
                    <!-- Sent At -->
                    <div class="bg-sky-500/5 p-3 rounded-lg border border-sky-500/20 col-span-2">
                        <p class="text-xs font-bold text-sky-600/70 uppercase">Sent At</p>
                        <p class="font-semibold text-base-content mt-0.5">{{ $viewMessageData->sent_at ? formatDateTime($viewMessageData->sent_at) : 'N/A' }}</p>
                    </div>
                </div>

                <!-- Message Content Box -->
                <div>
                    <h4 class="text-xs font-bold text-sky-600/70 uppercase mb-2">Message Content</h4>
                    <div class="bg-sky-500/5 p-4 rounded-xl border border-sky-500/20 text-sm text-base-content whitespace-pre-wrap leading-relaxed shadow-sm">
                        {{ $viewMessageData->message }}
                    </div>
                </div>

                <!-- Close Button -->
                <div class="pt-2">
                    <button wire:click="closeViewMessageModal" class="w-full py-2.5 bg-sky-100 hover:bg-sky-200 text-sky-800 font-bold rounded-xl text-sm transition-all shadow-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div> {{-- Main div closing --}}