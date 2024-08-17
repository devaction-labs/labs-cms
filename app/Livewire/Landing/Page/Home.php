<?php

namespace App\Livewire\Landing\Page;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    #[Layout('components.layouts.home')]
    public function render(): View
    {
        return view('livewire.landing.page.home');
    }
}
