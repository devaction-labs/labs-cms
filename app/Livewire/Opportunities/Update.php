<?php

namespace App\Livewire\Opportunities;

use App\Models\{Opportunity};
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;
use Mary\Traits\Toast;

class Update extends Component
{
    use Toast;

    public Form $form;

    public bool $opportunitiesUpdate = false;

    public function render(): View
    {
        return view('livewire.opportunities.update');
    }

    #[On('opportunity::update')]
    public function load(int $id): void
    {
        $opportunity = Opportunity::query()->find($id);

        if ($opportunity === null) {
            return;
        }

        $this->form->setOpportunity($opportunity);

        $this->form->resetErrorBag();
        $this->opportunitiesUpdate = true;
        $this->success('Opportunity loaded successfully');
    }

    public function save(): void
    {
        $this->form->update();

        $this->opportunitiesUpdate = false;
        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }

    public function search(string $value = ''): void
    {
        $this->form->searchCustomers($value);
    }
}
