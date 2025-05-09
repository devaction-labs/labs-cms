<?php

namespace App\Livewire\Admin\Users;

use App\Enums\Can;
use Livewire\Attributes\On;
use Livewire\Component;
use RuntimeException;

class Impersonate extends Component
{
    public function render(): string
    {
        return <<<'HTML'
        <div></div>
        HTML;
    }

    #[On('user::impersonation')]
    public function impersonate(int $userId): void
    {
        $this->authorize(Can::BE_AN_ADMIN->value);

        if (auth()->id() === $userId) {
            throw new RuntimeException('You can not impersonate yourself.');
        }

        session()->put('impersonator', auth()->id());
        session()->put('impersonate', $userId);

        $this->redirect(route('dashboard'));
    }

}
