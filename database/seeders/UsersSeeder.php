<?php

namespace Database\Seeders;

use App\Enums\Can;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()
            ->withPermission(Can::BE_AN_ADMIN)
            ->create([
                'name'     => 'Alex Nogueira',
                'email'    => 'alex@devaction.com.br',
                'password' => 'Bruna@@2012**',
            ]);

        User::factory()
            ->withPermission(Can::BE_AN_ADMIN)
            ->create([
                'name'     => 'Carlos Andre',
                'email'    => 'Carlos Andre',
                'password' => 'CarlosAndre@@2012**',
            ]);

        if (app()->environment('local')) {
            $this->normalUsers();
            $this->deletedUsers($admin);
        }
    }

    private function normalUsers(): void
    {
        User::query()->insert(
            array_map(
                fn () => $this->defaultDefinition(),
                range(1, 50)
            )
        );
    }

    private function defaultDefinition(): array
    {
        return array_merge((new UserFactory())->definition(), ['password' => '$2y$10$Ybe7g6ojOtQLVDmX914YUeCqdpfKmuOkPlA9n0zvH.3HLO0u0PA56']);
    }

    private function deletedUsers(User $admin): void
    {
        User::query()->insert(
            array_map(
                fn () => array_merge(
                    $this->defaultDefinition(),
                    [
                        'deleted_at' => now(),
                        'deleted_by' => $admin->id,
                    ]
                ),
                range(1, 50)
            )
        );
    }
}
