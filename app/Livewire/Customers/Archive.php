<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Archive extends Component
{
    public Customer $customer;

    public bool $archiveModal = false;

    public function render(): View
    {
        return view('livewire.customers.archive');
    }

    #[On('customer::archive')]
    public function confirmAction(int $id): void
    {
        $this->customer     = Customer::findOrFail($id);
        $this->archiveModal = true;
    }

    public function archive(): void
    {
        $this->customer->delete();
        $this->archiveModal = false;
        $this->dispatch('customer::reload')->to('customers.index');
    }
}
