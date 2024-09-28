<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    public Form $form;

    public bool $customerUpdate = false;

    public function render(): View
    {
        return view('livewire.customers.update');
    }

    #[On('customer::update')]
    public function load(int $id): void
    {
        $customer = Customer::query()->find($id);

        if ($customer === null) {
            return;
        }

        $this->form->setCustomer($customer);

        $this->form->resetErrorBag();
        $this->customerUpdate = true;
    }

    public function save(): void
    {
        $this->form->update();

        $this->customerUpdate = false;
        $this->dispatch('customer::reload')->to('customers.index');
    }
}
