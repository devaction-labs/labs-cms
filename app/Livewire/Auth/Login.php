<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\{View};
use Illuminate\Support\Facades\{Auth, RateLimiter};
use Illuminate\Support\Str;
use Livewire\Attributes\{Layout, On};
use Livewire\Component;

class Login extends Component
{
    public bool $showLogin = false;

    public ?string $email = null;

    public ?string $password = null;

    #[Layout('components.layouts.home')]
    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function tryToLogin(): void
    {
        if ($this->ensureIsNotRateLimiting()) {
            return;
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            $this->addError('invalidCredentials', trans('auth.failed'));

            return;
        }

        $this->redirect(route('dashboard'));
    }

    private function ensureIsNotRateLimiting(): bool
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            $this->addError('rateLimiter', trans('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey()),
            ]));

            return true;
        }

        return false;
    }

    private function throttleKey(): string
    {
        $email = $this->email ?? '';

        return Str::transliterate(Str::lower($email) . '|' . request()->ip());
    }

    #[On('auth::showLogin')]
    public function openLogin(): void
    {
        $this->showLogin = true;
    }
}
