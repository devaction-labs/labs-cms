<?php

namespace App\Providers;

use App\Livewire\Support\Modal\SimpleModal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::unguard();

        Blade::component('simple-modal', SimpleModal::class);
    }
}
