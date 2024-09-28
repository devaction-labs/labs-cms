<?php

use App\Livewire\Customers;
use App\Models\Customer;
use Livewire\Livewire;

use function Pest\Laravel\assertNotSoftDeleted;

it('should be able to restore a customer', function () {
    /** @var Customer $customer */
    $customer = Customer::factory()->deleted()->create();

    Livewire::test(Customers\Restore::class)
        ->set('customer', $customer)
        ->call('restore');

    assertNotSoftDeleted('customers', [
        'id' => $customer->id,
    ]);
});

test('when confirming we should load the customer and set modal to true', function () {
    /** @var Customer $customer */
    $customer = Customer::factory()->deleted()->create();

    Livewire::test(Customers\Restore::class)
        ->call('confirmAction', $customer->id)
        ->assertSet('customer.id', $customer->id)
        ->assertSet('restoreModal', true)
        ->assertPropertyEntangled('restoreModal');
});

test('after restoring we should dispatch an event to tell the list to reload', function () {
    $customer = Customer::factory()->deleted()->create();

    Livewire::test(Customers\Restore::class)
        ->set('customer', $customer)
        ->call('restore')
        ->assertDispatched('customer::reload');
});

test('after restoring we should close the modal', function () {
    $customer = Customer::factory()->deleted()->create();

    Livewire::test(Customers\Restore::class)
        ->set('customer', $customer)
        ->call('restore')
        ->assertSet('modal', false);
});

test('making sure restore method is wired', function () {
    Livewire::test(Customers\Restore::class)
        ->assertMethodWired('restore');
});

test('check if component is in the page', function () {
    Livewire::test(Customers\Index::class)
        ->assertContainsLivewireComponent('customers.restore');
});
