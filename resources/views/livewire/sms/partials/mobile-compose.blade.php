<form wire:submit="sendSms" class="space-y-4 pb-20">
    
    <!-- Category Selection Card -->
    <div class="bg-white dark:bg-base-100 rounded-2xl shadow-sm p-4 border border-base-200 dark:border-base-300">
        <label class="block text-xs font-bold text-base-content/80 mb-2 uppercase">Category & Group</label>
        <select wire:model.live="selectedCategory" class="select select-bordered select-sm w-full bg-base-50 dark:bg-base-200 text-base-content">
            @foreach($smsCategories as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
        </select>
        
        @if($selectedCategory === 'Group SMS' || $selectedCategory === 'Alert SMS')
        <select wire:model.live="targetGroup" class="select select-bordered select-sm w-full bg-base-50 dark:bg-base-200 text-base-content mt-2">
            <option value="all">🌍 All Members</option>
            <option value="bd">🇧🇩 BD Only</option>
            <option value="abroad">✈️ Abroad Only</option>
        </select>
        @endif
    </div>

    <!-- Member Selection Card -->
    <div class="bg-white dark:bg-base-100 rounded-2xl shadow-sm p-4 border border-base-200 dark:border-base-300">
        <div class="flex justify-between items-center mb-2">
            <label class="text-xs font-bold text-base-content/80 uppercase">Select Members</label>
            <span class="badge badge-primary badge-sm text-white">{{ count($selectedMembers) }}</span>
        </div>
        
        <!-- ✅ Select All Checkbox -->
        <label class="flex items-center gap-2 cursor-pointer bg-sky-50 dark:bg-sky-900/20 p-2 rounded-lg border border-sky-200 dark:border-sky-800 mb-2 hover:bg-sky-100 dark:hover:bg-sky-900/30 transition-colors">
            <input type="checkbox" wire:model.live="selectAll" class="checkbox checkbox-xs checkbox-primary rounded" />
            <span class="text-xs font-bold text-sky-700 dark:text-sky-400">✅ Select All</span>
        </label>

        <div class="bg-base-50 dark:bg-base-200 rounded-xl p-2 max-h-40 overflow-y-auto border border-base-100 dark:border-base-300">
            @foreach($availableMembers as $m)
                <label class="flex items-center gap-2 p-2 hover:bg-sky-50 dark:hover:bg-sky-900/20 rounded-lg cursor-pointer">
                    <input type="checkbox" value="{{ $m->id }}" wire:model="selectedMembers" class="checkbox checkbox-xs checkbox-primary rounded" />
                    <span class="text-xs text-base-content font-medium truncate">{{ $m->name_english }} ({{ $m->mobile }})</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Compose Card -->
    <div class="bg-white dark:bg-base-100 rounded-2xl shadow-sm p-4 border border-base-200 dark:border-base-300">
        <div class="flex justify-between items-center mb-2">
            <label class="text-xs font-bold text-base-content/80 uppercase">Message</label>
            <select wire:model.live="selectedTemplate" class="select select-bordered select-xs w-32 bg-base-50 dark:bg-base-200 text-base-content text-xs">
                <option value="">📝 Template</option>
                @foreach($templates as $tpl)
                    <option value="{{ $tpl->id }}">{{ $tpl->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="p-3 rounded-lg text-[11px] mb-3 border border-sky-500/20 bg-sky-500/5 text-sky-800">
            <p>💡 আপনার মেসেজের শুরুতে অটোমেটিক মেম্বারের নাম যোগ হবে:</p>
            <div class="mt-1.5 p-1.5 rounded bg-white border border-dashed border-sky-300 font-mono text-[10px] text-sky-900">
                <span class="font-bold">Dear MD. Sobuj (Acc#1)</span> আপনার মেসেজ...
            </div>
        </div>

        <textarea wire:model="message" class="textarea textarea-bordered w-full text-sm bg-base-50 dark:bg-base-200 text-base-content focus:ring-2 focus:ring-sky-500" rows="4" maxlength="1000" placeholder="Type your message..."></textarea>
        
        <div class="flex justify-between items-center mt-1 px-1">
            <p class="text-[10px] text-base-content/50">Auto-prefix enabled</p>
            <span class="text-[10px] font-mono {{ strlen($message) > 900 ? 'text-red-500 font-bold' : 'text-base-content/60' }}">{{ strlen($message) }}/1000</span>
        </div>
    </div>

    <!-- Sticky Send Button -->
    <button type="submit" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 rounded-xl shadow-lg flex items-center justify-center gap-2 transition-all text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
        Send SMS
    </button>
</form>