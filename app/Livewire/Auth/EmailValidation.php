<?php

namespace App\Livewire\Auth;

use App\Events\SendNewCode;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use App\Traits\User\AuthenticatedUser;
use Closure;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EmailValidation extends Component
{
    use AuthenticatedUser;

    public ?string $code = null;

    public ?string $sendNewCodeMessage = null;

    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.email-validation');
    }

    public function handle(): void
    {
        $this->reset('sendNewCodeMessage');

        $this->validate([
            'code' => function (string $attribute, mixed $value, Closure $fail) {
                if ($value != $this->getAuthenticatedUser()->validation_code) {
                    $fail('Invalid code');
                }
            },
        ]);

        $user                    = $this->getAuthenticatedUser();
        $user->validation_code   = null;
        $user->email_verified_at = now();
        $user->save();

        $user->notify(new WelcomeNotification());
        $this->redirect(RouteServiceProvider::HOME);
    }

    public function sendNewCode(): void
    {
        SendNewCode::dispatch(
            $this->getAuthenticatedUser()
        );

        $this->sendNewCodeMessage = 'Code was sent to you. Check your mailbox.';
    }
}
