<?php

namespace App\Livewire\Customers;

use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;

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
        try {
            $response = $this->form->create();

            $this->info($response['message']);
        } catch (Exception $e) {
            $this->addError('form.onboarding', 'Não foi possível registrar o cliente no sistema externo: ' . $e->getMessage());
        }

        $this->customerCreate = false;
        $this->dispatch('customer::reload')->to('customers.index');
    }
}
