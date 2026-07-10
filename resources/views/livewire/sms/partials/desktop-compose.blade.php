<form wire:submit="sendSms" class="grid grid-cols-5 gap-6 h-full">
    
    <!-- ===== Left: Target & Settings ===== -->
    <div class="col-span-2 bg-base-50 dark:bg-base-200/30 rounded-2xl p-5 border border-base-200 dark:border-base-300 flex flex-col gap-4 overflow-y-auto">
        <h3 class="font-bold text-base-content flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
            Target Audience
        </h3>

        <!-- Category Selection -->
        <div>
            <label class="block text-xs font-bold text-base-content/60 mb-1 uppercase tracking-wider">Category</label>
            <select wire:model.live="selectedCategory" class="select select-bordered select-sm w-full bg-white dark:bg-base-100">
                @foreach($smsCategories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        @if($selectedCategory === 'Group SMS' || $selectedCategory === 'Alert SMS')
        <div>
            <label class="block text-xs font-bold text-base-content/60 mb-1 uppercase tracking-wider">Target Group</label>
            <select wire:model.live="targetGroup" class="select select-bordered select-sm w-full bg-white dark:bg-base-100">
                <option value="all">🌍 All Members</option>
                <option value="bd">🇧🇩 BD Only</option>
                <option value="abroad">✈️ Abroad Only</option>
            </select>
        </div>
        @endif

        <!-- Member Selection -->
        <div class="flex-1 flex flex-col">
            <div class="flex justify-between items-center mb-2">
                <label class="text-xs font-bold text-base-content/60 uppercase tracking-wider">Select Members</label>
                <span class="badge badge-primary badge-sm text-white">{{ count($selectedMembers) }} selected</span>
            </div>
            
            <!-- ✅ Select All Checkbox -->
            <label class="flex items-center gap-2 cursor-pointer bg-sky-50 dark:bg-sky-900/20 p-2 rounded-lg border border-sky-200 dark:border-sky-800 mb-2 hover:bg-sky-100 dark:hover:bg-sky-900/30 transition-colors">
                <input type="checkbox" wire:model.live="selectAll" class="checkbox checkbox-sm checkbox-primary rounded-md" />
                <span class="text-xs font-bold text-sky-700 dark:text-sky-400">✅ Select All Members</span>
            </label>

            <div class="bg-white dark:bg-base-100 rounded-xl border border-base-200 dark:border-base-300 p-2 flex-1 overflow-y-auto max-h-[40vh] shadow-inner">
                @foreach($availableMembers as $m)
                    <label class="flex items-center gap-3 cursor-pointer p-2 hover:bg-sky-50 dark:hover:bg-sky-900/20 rounded-lg transition-colors">
                        <input type="checkbox" value="{{ $m->id }}" wire:model="selectedMembers" class="checkbox checkbox-sm checkbox-primary rounded-md" />
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-base-content truncate">#{{ $m->account_no }} - {{ $m->name_english }}</p>
                            <p class="text-[10px] text-base-content/50">{{ $m->mobile }}</p>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ===== Right: Message Compose ===== -->
    <div class="col-span-3 bg-white dark:bg-base-100 rounded-2xl p-5 border border-base-200 dark:border-base-300 flex flex-col shadow-sm">
        
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-base-content flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                Compose Message
            </h3>
        </div>

        <!-- Info Note -->
        <div class="p-3 rounded-lg text-xs mb-4 border border-sky-500/20 bg-sky-500/5 text-sky-800">
            <p class="flex items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 flex-shrink-0 text-sky-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                <span>আপনার লেখা মেসেজের শুরুতে সিস্টেম অটোমেটিক মেম্বারের নাম ও একাউন্ট নম্বর যোগ করবে। বাম সাইডবার থেকে টেমপ্লেট সিলেক্ট করুন।</span>
            </p>
            <div class="mt-2 bg-white p-2 rounded border border-dashed border-sky-300 font-mono text-[11px] text-sky-900">
                উদাহরণ: <span class="font-bold">Dear MD. Sobuj (Acc#1, Share#3)</span> আপনার মেসেজ...
            </div>
        </div>

        <!-- Message Area -->
        <div class="flex-1 flex flex-col">
            <textarea wire:model="message" class="textarea textarea-bordered w-full flex-1 min-h-[200px] text-base bg-base-50 dark:bg-base-200 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all" placeholder="Write your message here..." maxlength="1000"></textarea>
            
            <div class="flex justify-between items-center mt-2 px-1">
                <div class="flex-1 mr-4">
                    <div class="w-full bg-base-200 rounded-full h-1.5">
                        <div class="h-1.5 rounded-full transition-all {{ strlen($message) > 900 ? 'bg-red-500' : (strlen($message) > 700 ? 'bg-yellow-500' : 'bg-sky-500') }}" style="width: {{ min((strlen($message) / 1000) * 100, 100) }}%"></div>
                    </div>
                </div>
                <span class="text-xs font-mono {{ strlen($message) > 900 ? 'text-red-500 font-bold' : 'text-base-content/50' }}">{{ strlen($message) }} / 1000</span>
            </div>
        </div>

        <!-- Send Button -->
        <div class="mt-4 pt-4 border-t border-base-100 dark:border-base-300">
            <button type="submit" wire:loading.attr="disabled" class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold py-3 rounded-xl shadow-md flex items-center justify-center gap-2 transition-all transform hover:scale-[1.01]">
                <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                <svg wire:loading class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span wire:loading.remove>🚀 Send SMS Now</span>
                <span wire:loading>Sending...</span>
            </button>
        </div>
    </div>
</form>