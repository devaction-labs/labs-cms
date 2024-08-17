<?php

namespace App\Livewire\Opportunities;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public Form $form;

    public bool $opportunitiesCreate = false;

    public function render(): View
    {
        return view('livewire.opportunities.create');
    }

    #[On('opportunity::create')]
    public function open(): void
    {
        $this->form->resetErrorBag();
        $this->form->searchCustomers();
        $this->opportunitiesCreate = true;
    }

    public function save(): void
    {
        $this->form->create();

        $this->opportunitiesCreate = false;
        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }

    public function search(string $value = ''): void
    {
        $this->form->searchCustomers($value);
    }
}
