<?php

namespace App\Livewire\User;

use App\Models\Deposit;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.guest')] 
class History extends Component
{
    use WithPagination;

    public $member;

    public function mount()
    {
        $this->member = auth()->user()->member;

        if (!$this->member) {
            return redirect()->route('logout');
        }
    }

    public function render()
    {
        // মেম্বারের সব ডিপোজিট সর্বশেষ মাস অনুযায়ী সাজিয়ে পেজিনেশন সহ আনা
        $deposits = Deposit::where('member_id', $this->member->id)
            ->orderBy('month_year', 'desc')
            ->paginate(10);

        return view('livewire.user.history', compact('deposits'));
    }
}