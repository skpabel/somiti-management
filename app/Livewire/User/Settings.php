<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Settings extends Component
{
    public $member;
    public $theme = 'light';
    public $language = 'bn';

    public function mount()
    {
        $this->member = auth()->user()->member;

        if (!$this->member) {
            return redirect()->route('logout');
        }

        $this->theme = auth()->user()->theme ?? 'light';
        $this->language = auth()->user()->language ?? 'bn';
    }

    public function setTheme($value)
    {
        if (!in_array($value, ['light', 'dark'])) {
            return;
        }

        $this->theme = $value;
        auth()->user()->update(['theme' => $value]);

        $this->dispatch('theme-updated', theme: $value);
    }

    public function setLanguage($value)
    {
        if (!in_array($value, ['bn', 'en'])) {
            return;
        }

        $this->language = $value;
        auth()->user()->update(['language' => $value]);
        $this->dispatch('language-updated', language: $value);
        
        // Success message using Helper function
        session()->flash('settings_success', __lang('ভাষা সফলভাবে পরিবর্তন করা হয়েছে।', 'Language changed successfully.'));
    }

    public function render()
    {
        return view('livewire.user.settings');
    }
}
