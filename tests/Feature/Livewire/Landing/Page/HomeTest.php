<?php

use App\Livewire\Landing\Page\Home;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Home::class)
        ->assertStatus(200);
});
