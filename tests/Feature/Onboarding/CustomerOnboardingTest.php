<?php

use App\Livewire\Customers\Create;
use Livewire\Livewire;

use function Pest\Laravel\{assertDatabaseHas};

test('check if the create method creates a new customer and does the onboarding', function () {
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
