<?php

use App\Livewire\Customers\Show;
use App\Models\Customer;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Show::class, ['customer' => Customer::factory()->create()])
        ->assertStatus(200);
});
