<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Profile extends Component
{
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
        return view('livewire.user.profile');
    }
}
