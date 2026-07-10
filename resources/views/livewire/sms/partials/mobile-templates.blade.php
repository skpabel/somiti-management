<div>
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-base-content text-sm">📋 Templates</h3>
        <button wire:click="openTemplateModal()" class="btn btn-xs bg-indigo-600 text-white border-none shadow gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg> Add
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
    <div class="bg-gradient-to-br {{ $tClr['bg'] }} border {{ $tClr['border'] }} rounded-xl p-4 mb-3 hover:shadow-md transition-all group">
        <div class="flex justify-between items-center mb-2">
            <span class="badge badge-sm {{ $tClr['badge'] }} border-0 font-bold">{{ $tpl->category }}</span>
            <div class="flex gap-1">
                <button wire:click="openTemplateModal({{ $tpl->id }})" class="btn btn-xs btn-ghost text-sky-500 hover:bg-sky-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                </button>
                <button wire:click="confirmDeleteTemplate({{ $tpl->id }})" class="btn btn-xs btn-ghost text-red-500 hover:bg-red-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </div>
        </div>
        <h4 class="font-bold text-base-content text-sm mb-1">{{ $tpl->name }}</h4>
        <p class="text-xs text-base-content/60 bg-white/60 p-2.5 rounded-lg border border-dashed border-base-200">{{ $tpl->message }}</p>
    </div>
    @empty
    <div class="text-center py-10 text-base-content/40 text-sm">No templates found.</div>
    @endforelse
</div>