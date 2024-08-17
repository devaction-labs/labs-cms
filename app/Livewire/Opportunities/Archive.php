<?php

namespace App\Livewire\Opportunities;

use App\Models\Opportunity;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Archive extends Component
{
    public Opportunity $opportunity;

    public bool $opportunitiesArchive = false;

    public function render(): View
    {
        return view('livewire.opportunities.archive');
    }

    #[On('opportunity::archive')]
    public function confirmAction(int $id): void
    {
        $this->opportunity          = Opportunity::findOrFail($id);
        $this->opportunitiesArchive = true;
    }

    public function archive(): void
    {
        $this->opportunity->delete();
        $this->opportunitiesArchive = false;
        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }
}
