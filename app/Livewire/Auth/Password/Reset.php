<?php

namespace App\Livewire\Auth\Password;

use App\Models\User;
use App\Utilities\Traits\StringHelpers;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{DB, Hash, Password};
use Illuminate\Support\Str;
use Livewire\Attributes\{Computed, Layout, Rule};
use Livewire\Component;

class Reset extends Component
{
    use StringHelpers;

    public ?string $token = null;

    #[Rule(['required', 'email', 'confirmed'])]
    public ?string $email = null;

    public ?string $email_confirmation = null;

    #[Rule(['required', 'confirmed'])]
    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function mount(?string $token = null, ?string $email = null): void
    {
        $this->token = $this->convertToString(request('token', $token));
        $this->email = $this->convertToString(request('email', $email));

        if ($this->tokenNotValid()) {

            session()->flash('status', 'Token Invalid');

            $this->redirectRoute('login');
        }
    }

    private function tokenNotValid(): bool
    {
        $tokens = DB::table('password_reset_tokens')
            ->get(['token']);

        $token = $this->convertToString($this->token);

        foreach ($tokens as $t) {
            if (is_object($t) && property_exists($t, 'token') && Hash::check($token, $t->token)) {
                return false;
            }
        }

        return true;
    }

    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.password.reset');
    }

    public function updatePassword(): void
    {
        $this->validate();

        $statusPassword = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->password       = $password;
                $user->remember_token = Str::random(60);
                $user->save();

                event(new PasswordReset($user));
            }
        );

        $status = $this->convertToString($statusPassword);

        session()->flash('status', __($status));

        if ($status !== Password::PASSWORD_RESET) {
            return;
        }

        $this->redirect(route('login'));
    }

    #[Computed]
    public function obfuscatedEmail(): string
    {
        return obfuscate_email($this->email);
    }
}
