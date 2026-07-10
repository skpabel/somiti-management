@props(['label', 'field', 'value', 'type' => 'text', 'options' => []])

<div class="flex items-center py-2.5 border-b border-base-200 hover:bg-base-200/50 px-2 rounded group">
    
    <!-- Label -->
    <div class="w-1/3 text-sm text-base-content/60 font-medium">
        {{ $label }}
    </div>
    
    <!-- Value / Input -->
    <div class="flex-1 flex items-center justify-between gap-2">
        
        @if($editingField === $field)
            <!-- ✏️ Edit Mode -->
            <div class="flex-1 flex items-center gap-2">
                
                @if($type === 'select')
                    <select wire:model="editingValue" class="select select-bordered select-sm flex-1">
                        @foreach($options as $option)
                            <option value="{{ $option }}" {{ $editingValue == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                @elseif($type === 'textarea')
                    <textarea wire:model="editingValue" class="textarea textarea-bordered textarea-sm w-full" rows="2"></textarea>
                @else
                    <input type="{{ $type }}" wire:model="editingValue" class="input input-bordered input-sm flex-1" />
                @endif
                
                <!-- ✅ Save Button -->
                <button wire:click="saveField('{{ $field }}')" class="btn btn-success btn-sm btn-circle" title="Save">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
                
                <!-- ❌ Cancel Button -->
                <button wire:click="cancelEditing" class="btn btn-ghost btn-sm btn-circle" title="Cancel">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            @error('editingValue') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
            
        @else
            <!-- 👁️ View Mode -->
            <span class="text-sm text-base-content @if(!$value) italic text-base-content/40 @endif">
                @if($type === 'date')
                    {{ $field === 'registration_date' ? formatDateTime($value) : formatDate($value) }}
                @else
                    {{ $value ?: 'Not Set' }}
                @endif
            </span>
            
            <!-- ✏️ Edit Icon -->
            <button wire:click="startEditing('{{ $field }}')" 
                    class="opacity-0 group-hover:opacity-100 transition-opacity btn btn-ghost btn-xs text-blue-500 hover:bg-blue-500/10 ml-2"
                    title="Edit {{ $label }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
        @endif
    </div>
</div>