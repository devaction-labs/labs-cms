<?php

use App\Http\Integrations\Anexia\Requests\CreateOnboardingRequest;
use App\Livewire\Customers\Create;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

test('check if the create method creates a new customer and does the onboarding', function () {
    // Configurar o mock do Saloon com um array de mapeamento
    Saloon::fake([
        CreateOnboardingRequest::class => MockResponse::make([
            'user' => [
                'id'         => '01jak0p9ek6jmk8378htyc22kq',
                'name'       => 'Alex Nogueira',
                'email'      => 'alex@devaction.com.br',
                'tenant_id'  => '01jak0p98dvn7sgcf89wg1acc0',
                'created_at' => now()->toISOString(),
                'updated_at' => now()->toISOString(),
            ],
            'event'   => 'company.registered',
            'message' => 'Cliente criado com sucesso!', // Adicionando a chave "message"
        ], 200), // 200 é o status HTTP de sucesso
    ]);

    // Agora execute o teste normalmente
    Livewire::test(Create::class)
        ->set('form.name', 'Alex Nogueira')
        ->set('form.email', 'alex@devaction.com.br')
        ->set('form.phone', '123456789')
        ->set('form.tenant_name', 'DevAction')
        ->set('form.tenant_domain', 'devaction.com')
        ->set('form.tenant_slug', 'devaction')
        ->set('form.tenant_tax_id', '12345678000100')
        ->set('form.password', 'password123')
        ->call('save')
        ->assertDispatched('customer::reload')
        ->assertHasNoErrors();

    // Verificar se o cliente foi criado na base de dados
    assertDatabaseHas('customers', [
        'email' => 'alex@devaction.com.br',
        'name'  => 'Alex Nogueira',
    ]);
});
