<?php

use App\Http\Integrations\Anexia\Requests\CreateOnboardingRequest;
use App\Livewire\Customers;
use App\Models\{Customer, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas};

use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);

    Saloon::fake([
        CreateOnboardingRequest::class => MockResponse::make([
            'user' => [
                'id'         => '01jak0p9ek6jmk8378htyc22kq',
                'name'       => 'John Doe',
                'email'      => 'joe@doe.com',
                'tenant_id'  => 'tenant123',
                'created_at' => now()->toISOString(),
                'updated_at' => now()->toISOString(),
            ],
            'event'   => 'company.registered',
            'message' => 'Cliente criado com sucesso!',
        ], 200),
    ]);
});

it('should be able to create a customer', function () {
    Livewire::test(Customers\Create::class)
        ->set('form.name', 'John Doe')
        ->assertPropertyWired('form.name')
        ->set('form.email', 'joe@doe.com')
        ->assertPropertyWired('form.email')
        ->set('form.phone', '123456789')
        ->assertPropertyWired('form.phone')
        ->call('save')
        ->assertMethodWiredToForm('save')
        ->assertHasNoErrors();

    assertDatabaseHas('customers', [
        'name'  => 'John Doe',
        'email' => 'joe@doe.com',
        'phone' => '123456789',
        'type'  => 'customer',
    ]);
});

describe('validations', function () {
    test('name', function ($rule, $value) {
        Livewire::test(Customers\Create::class)
            ->set('form.name', $value)
            ->call('save')
            ->assertHasErrors(['form.name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min', 'Jo'],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('email should be required if we dont have a phone number', function () {
        Livewire::test(Customers\Create::class)
            ->set('form.email', '')
            ->set('form.phone', '')
            ->call('save')
            ->assertHasErrors(['form.email' => 'required_without']);

        Livewire::test(Customers\Create::class)
            ->set('form.email', '')
            ->set('form.phone', '1232132')
            ->call('save')
            ->assertHasNoErrors(['form.email' => 'required_without']);
    });

    test('email should be valid', function () {
        Livewire::test(Customers\Create::class)
            ->set('form.email', 'invalid-email')
            ->call('save')
            ->assertHasErrors(['form.email' => 'email']);

        Livewire::test(Customers\Create::class)
            ->set('form.email', 'joe@doe.com')
            ->call('save')
            ->assertHasNoErrors(['form.email' => 'email']);
    });

    test('email should be unique', function () {
        Customer::factory()->create(['email' => 'joe@doe.com']);

        Livewire::test(Customers\Create::class)
            ->set('form.email', 'joe@doe.com')
            ->call('save')
            ->assertHasErrors(['form.email' => 'unique']);
    });

    test('phone should be required if email is empty', function () {
        Livewire::test(Customers\Create::class)
            ->set('form.email', '')
            ->set('form.phone', '')
            ->call('save')
            ->assertHasErrors(['form.phone' => 'required_without']);

        Livewire::test(Customers\Create::class)
            ->set('form.email', 'joe@doe.com')
            ->set('form.phone', '')
            ->call('save')
            ->assertHasNoErrors(['form.phone' => 'required_without']);
    });

    test('phone should be unique', function () {
        Customer::factory()->create(['phone' => '123456789']);

        Livewire::test(Customers\Create::class)
            ->set('form.phone', '123456789')
            ->call('save')
            ->assertHasErrors(['form.phone' => 'unique']);

    });
});

test('check if component is in the page', function () {
    Livewire::test(Customers\Index::class)
        ->assertContainsLivewireComponent('customers.create');
});
