<?php

namespace App\Livewire\Customers;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Create extends Component
{
    public Form $form;

    public bool $customerCreate = false;

    public function render(): View
    {
        return view('livewire.customers.create');
    }

    #[On('customer::create')]
    public function open(): void
    {
        $this->form->resetErrorBag();
        $this->customerCreate = true;
    }

    public function save(): void
    {
        $this->form->create();

        $this->customerCreate = false;
        $this->dispatch('customer::reload')->to('customers.index');
    }
}
