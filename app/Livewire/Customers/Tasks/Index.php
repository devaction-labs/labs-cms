<?php

namespace App\Livewire\Customers\Tasks;

use App\Actions\DataSort;
use App\Models\{Customer, Task};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    public Customer $customer;

    public function mount(Customer $customer): void
    {
        $this->customer = $customer;
    }

    #[On(['task::created', 'task::updated', 'task::deleted'])]
    public function render(): View
    {
        return view('livewire.customers.tasks.index');
    }

    #[Computed]
    public function notDoneTasks(): mixed
    {
        return $this->customer->tasks()->notDone()
            ->orderBy('sort_order')
            ->get();
    }

    #[Computed]
    public function doneTasks(): mixed
    {
        return $this->customer->tasks()->done()->get();
    }

    public function updateTaskOrder(array $items): void
    {
        (new DataSort('tasks', $items, 'value'))->run();
    }

    public function toggleCheck(int $id, string $status): void
    {
        Task::whereId($id)
            ->when(
                $status === 'done',
                fn (Builder $q) => $q->update(['done_at' => now()]),
                fn (Builder $q) => $q->update(['done_at' => null])
            );
    }

    public function deleteTask(int $id): void
    {
        Task::whereId($id)->delete();
    }
}
