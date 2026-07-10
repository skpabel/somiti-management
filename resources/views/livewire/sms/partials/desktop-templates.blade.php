<div>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-base-content">📋 SMS Templates</h3>
<button wire:click="openTemplateModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-5 rounded-xl shadow-md text-sm flex items-center justify-center gap-2 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            New Template
        </button>
    </div>

    <!-- ✅ এখানে $allTemplates ব্যবহার করা হয়েছে - সব ক্যাটাগরির টেমপ্লেট দেখাবে -->
    @forelse($allTemplates as $tpl)
    @php
                    $tplColors = [
                        'Single SMS' => ['bg' => 'from-sky-500/10 to-sky-500/5', 'border' => 'border-sky-500/20', 'badge' => 'bg-sky-100 text-sky-700'],
                        'Alert SMS' => ['bg' => 'from-red-500/10 to-red-500/5', 'border' => 'border-red-500/20', 'badge' => 'bg-red-100 text-red-700'],
                        'Due SMS' => ['bg' => 'from-amber-500/10 to-amber-500/5', 'border' => 'border-amber-500/20', 'badge' => 'bg-amber-100 text-amber-700'],
                        'Loan SMS' => ['bg' => 'from-emerald-500/10 to-emerald-500/5', 'border' => 'border-emerald-500/20', 'badge' => 'bg-emerald-100 text-emerald-700'],
                        'Group SMS' => ['bg' => 'from-purple-500/10 to-purple-500/5', 'border' => 'border-purple-500/20', 'badge' => 'bg-purple-100 text-purple-700'],
                    ];
                    $tClr = $tplColors[$tpl->category] ?? ['bg' => 'from-gray-500/10 to-gray-500/5', 'border' => 'border-gray-500/20', 'badge' => 'bg-gray-100 text-gray-700'];
                @endphp
    <div class="bg-gradient-to-br {{ $tClr['bg'] }} border {{ $tClr['border'] }} rounded-xl p-5 mb-4 hover:shadow-md transition-all group flex justify-between items-start gap-4">
        <div class="flex-1">
            <div class="flex items-center gap-2 mb-2">
                <span class="badge badge-sm {{ $tClr['badge'] }} border-0 font-bold">{{ $tpl->category }}</span>
                <h4 class="font-bold text-base-content">{{ $tpl->name }}</h4>
            </div>
            <p class="text-sm text-base-content/70 bg-white/60 p-3 rounded-lg border border-dashed border-base-200">{{ $tpl->message }}</p>
        </div>
        <div class="flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <button wire:click="openTemplateModal({{ $tpl->id }})" class="btn btn-xs btn-ghost text-sky-500 hover:bg-sky-500/10 gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg> Edit
            </button>
            <button wire:click="confirmDeleteTemplate({{ $tpl->id }})" class="btn btn-xs btn-ghost text-red-500 hover:bg-red-500/10 gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg> Delete
            </button>
        </div>
    </div>
    @empty
    <div class="text-center py-20 bg-base-50 dark:bg-base-200/30 rounded-2xl border border-dashed border-base-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-base-content/20 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
        <h3 class="font-bold text-base-content/40">No Templates Found</h3>
        <p class="text-sm text-base-content/30 mt-1">Create one to send messages faster!</p>
    </div>
    @endforelse
</div>