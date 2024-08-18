<?php

namespace App\Livewire\Partials;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TopBar extends Component
{
    public function render(): View
    {
        return view('livewire.partials.top-bar');
    }

    public function showLogin(): void
    {
        $this->dispatch('auth::showLogin');
    }
}
