<?php

use App\Livewire\Component\Breadcrumb;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Breadcrumb::class)
        ->assertStatus(200);
});
