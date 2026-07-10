<div>
    <!-- ===== Summary Stats ===== -->
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 border border-emerald-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
            <div class="bg-emerald-100 p-3 rounded-full shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-[10px] text-emerald-600/70 font-bold uppercase tracking-wider">Delivered</p>
                <p class="text-2xl font-extrabold text-emerald-700">{{ $historySuccessCount }}</p>
            </div>
        </div>
        <div class="bg-gradient-to-br from-red-500/10 to-red-500/5 border border-red-500/20 p-4 rounded-xl shadow-sm flex items-center gap-4">
            <div class="bg-red-100 p-3 rounded-full shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <div>
                <p class="text-[10px] text-red-600/70 font-bold uppercase tracking-wider">Failed</p>
                <p class="text-2xl font-extrabold text-red-700">{{ $historyFailedCount }}</p>
            </div>
        </div>
    </div>

    <!-- ===== Search & Filter Bar ===== -->
    <div class="flex gap-3 mb-6">
        <div class="flex-1 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            <input type="text" wire:model.live.debounce.300ms="searchHistory" placeholder="Search by name, phone or acc no..." class="input input-bordered input-sm w-full pl-10 bg-white dark:bg-base-200 focus:ring-2 focus:ring-sky-500 focus:border-sky-500" />
        </div>
        <select wire:model.live="filterStatus" class="select select-bordered select-sm bg-white dark:bg-base-200 focus:ring-2 focus:ring-sky-500">
            <option value="">All Status</option>
            <option value="success">✅ Success</option>
            <option value="failed">❌ Failed</option>
        </select>
        <input type="date" wire:model.live="filterDate" class="input input-bordered input-sm bg-white dark:bg-base-200 focus:ring-2 focus:ring-sky-500" />
        @if($searchHistory || $filterStatus || $filterDate)
            <button wire:click="$set('searchHistory', ''); $set('filterStatus', ''); $set('filterDate', ''); loadHistory" class="btn btn-sm btn-ghost text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20" title="Clear Filters">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        @endif
    </div>

    <!-- ===== Scrollable History Table ===== -->
    <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm max-h-[60vh] overflow-y-auto">
        <table class="table w-full text-sm">
            <thead class="bg-sky-600 text-white uppercase text-xs sticky top-0 z-10">
                <tr>
                    <th class="py-3 px-3 text-left">Time</th>
                    <th class="py-3 px-3 text-center">Type</th>
                    <th class="py-3 px-3 text-left">Recipient</th>
                    <th class="py-3 px-3 text-center">Status</th>
                    <th class="py-3 px-3 text-left">TrxID</th>
                    <th class="py-3 px-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $log)
                <tr class="border-b border-base-200 hover:bg-sky-500/20 transition-colors">
                    <td class="text-xs text-base-content/60 whitespace-nowrap">{{ $log->sent_at ? formatDateTime($log->sent_at) : '-' }}</td>
                    <td><span class="badge badge-outline badge-primary badge-sm">{{ $log->sms_type }}</span></td>
                    <td class="font-medium text-base-content text-xs">{{ $log->member_name ?? $log->phone }}</td>
                    <td>
                        @if(str_contains($log->status, 'Success'))
                            <span class="inline-flex items-center gap-1 text-green-600 font-bold text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Delivered
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-red-500 font-bold text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                Failed
                            </span>
                        @endif
                    </td>
                    <td class="text-xs font-mono text-base-content/50">{{ $log->trxn_id ?? 'N/A' }}</td>
                        <td class="text-center">
                            <!-- ✅ Click Event Added -->
                            <button wire:click="openViewMessageModal({{ $log->id }})" class="btn btn-xs btn-ghost text-sky-500 hover:bg-sky-50 dark:hover:bg-sky-900/20 p-1" title="View Message">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </button>
                        </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-10 text-base-content/40">No history found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>