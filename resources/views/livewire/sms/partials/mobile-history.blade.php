<div>
    <!-- ===== Summary Stats ===== -->
    <div class="grid grid-cols-2 gap-3 mb-4">
        <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/20 p-3 rounded-xl shadow-sm flex items-center gap-3">
            <div class="bg-emerald-100 p-2 rounded-full shadow-sm text-emerald-600">✅</div>
            <div>
                <p class="text-[10px] text-emerald-600/70 font-bold uppercase tracking-wider">Delivered</p>
                <p class="text-lg font-extrabold text-emerald-700">{{ $historySuccessCount }}</p>
            </div>
        </div>
        <div class="bg-gradient-to-br from-red-500/10 to-red-500/5 border border-red-500/20 p-3 rounded-xl shadow-sm flex items-center gap-3">
            <div class="bg-red-100 p-2 rounded-full shadow-sm text-red-600">❌</div>
            <div>
                <p class="text-[10px] text-red-600/70 font-bold uppercase tracking-wider">Failed</p>
                <p class="text-lg font-extrabold text-red-700">{{ $historyFailedCount }}</p>
            </div>
        </div>
    </div>

    <!-- ===== Search & Filter ===== -->
    <div class="space-y-2 mb-4">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-2.5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            <input type="text" wire:model.live.debounce.300ms="searchHistory" placeholder="Search name or phone..." class="input input-bordered input-sm w-full pl-9 bg-white dark:bg-base-200 text-xs" />
        </div>
        <div class="flex gap-2">
            <select wire:model.live="filterStatus" class="select select-bordered select-sm flex-1 bg-white dark:bg-base-200 text-xs">
                <option value="">All Status</option>
                <option value="success">✅ Success</option>
                <option value="failed">❌ Failed</option>
            </select>
            <input type="date" wire:model.live="filterDate" class="input input-bordered input-sm flex-1 bg-white dark:bg-base-200 text-xs" />
        </div>
    </div>

    <!-- ===== Scrollable List ===== -->
    <div class="space-y-3 max-h-[60vh] overflow-y-auto pr-1">
        @forelse($history as $log)
        <div class="flex items-start gap-3 relative">
            <!-- Timeline Dot -->
            <div class="flex flex-col items-center mt-1">
                <div class="w-3 h-3 rounded-full {{ str_contains($log->status, 'Success') ? 'bg-emerald-500' : 'bg-red-500' }} shadow-md"></div>
                <div class="w-0.5 h-full bg-base-200 absolute top-4 bottom-0 left-[5px]"></div>
            </div>
            
            <!-- Content Card -->
            <div class="flex-1 bg-white rounded-xl p-3 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-center mb-1">
                    <span class="badge badge-sm text-white {{ str_contains($log->status, 'Success') ? 'bg-emerald-500 border-emerald-500' : 'bg-red-500 border-red-500' }}">{{ $log->sms_type }}</span>
                    <span class="text-[10px] text-base-content/50">{{ $log->sent_at ? formatDateTime($log->sent_at) : '-' }}</span>
                </div>
                <p class="text-xs font-semibold text-base-content">{{ $log->member_name ?? $log->phone }}</p>
                
                <div class="flex justify-between items-center mt-2 border-t border-gray-100 pt-2">
                    @if($log->trxn_id)
                    <p class="text-[10px] text-base-content/40 font-mono">TrxID: {{ $log->trxn_id }}</p>
                    @else
                    <span></span>
                    @endif
                    
                    <button wire:click="openViewMessageModal({{ $log->id }})" class="btn btn-xs btn-ghost text-sky-500 hover:bg-sky-500/10 p-0.5 gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <span class="text-[10px]">View</span>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-10 text-base-content/40 text-sm">No SMS history found.</div>
        @endforelse
    </div>
</div>