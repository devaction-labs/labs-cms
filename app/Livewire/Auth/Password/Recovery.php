<?php

namespace App\Livewire\Auth\Password;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\{Layout, On, Rule};
use Livewire\Component;

class Recovery extends Component
{
    public bool $showRecovery = false;

    public ?string $message = null;

    #[Rule(['required', 'email'])]
    public ?string $email = null;

    #[Layout('components.layouts.home')]
    public function render(): View
    {
        return view('livewire.auth.password.recovery');
    }

    public function startPasswordRecovery(): void
    {
        $this->validate();

        Password::sendResetLink($this->only('email'));

        $this->message = 'You will receive an email with the password recovery link.';
    }

    #[On('show::recovery::form')]
    public function showRecoveryForm(): void
    {
        $this->showRecovery = true;
    }
}
