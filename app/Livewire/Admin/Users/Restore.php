<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Notifications\UserRestoredAccessNotification;
use App\Traits\User\AuthenticatedUser;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On, Rule};
use Livewire\Component;
use Mary\Traits\Toast;

class Restore extends Component
{
    use Toast;
    use AuthenticatedUser;

    public ?User $user = null;

    public bool $modal = false;

    #[Rule(['required', 'confirmed'])]
    public string $confirmation = 'YODA';

    public ?string $confirmation_confirmation = null;

    public function render(): View
    {
        return view('livewire.admin.users.restore');
    }

    #[On('user::restoring')]
    public function openConfirmationFor(int $userId): void
    {
        $this->user  = User::query()->select('id', 'name')->withTrashed()->find($userId);
        $this->modal = true;
    }

    public function restore(): void
    {
        $this->validate();

        if ($this->user === null) {
            $this->addError('user', 'User not found.');

            return;
        }

        if ($this->user->is($this->getAuthenticatedUser())) {

            $this->addError('confirmation', "You can't restore yourself brow.");

            return;
        }

        $this->user->restore();
        $this->user->restored_at = now();
        $this->user->restored_by = $this->getAuthenticatedUser()->id;
        $this->user->save();

        $this->user->notify(new UserRestoredAccessNotification());
        $this->success('User restored successfully.');
        $this->dispatch('user::restored');
        $this->reset('modal');
    }
}
