<?php

use App\Enums\Can;
use App\Livewire\Auth\{EmailValidation, Login, Password, Register};
use App\Livewire\{Admin, Customers, Landing\Page\Home, Opportunities, Welcome};
use Illuminate\Support\Facades\Route;

//region Landing
Route::get('/', Home::class)->name('landing.home');

//region Login Flow
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('auth.register');
Route::get('/email-validation', EmailValidation::class)->middleware('auth')->name('auth.email-validation');
Route::get('/logout', static fn () => auth()->logout());
Route::get('/password/recovery', Password\Recovery::class)->name('password.recovery');
Route::get('/password/reset', Password\Reset::class)->name('password.reset');

//region Onboarding
Route::webhooks('/webhooks/onboarding', 'grok_onboarding');
//endregion

//region Authenticated
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Welcome::class)->name('dashboard');

    //region Customers
    Route::get('/customers', Customers\Index::class)->name('customers');
    Route::get('/customers/{customer}/{tab?}', Customers\Show::class)->name('customers.show');

    //endregion

    //region Opportunities
    Route::get('/opportunities', Opportunities\Index::class)->name('opportunities');
    //endregion

    //region Admin
    Route::prefix('/admin')->middleware('can:' . Can::BE_AN_ADMIN->value)->group(function () {
        Route::get('/dashboard', Admin\Dashboard::class)->name('admin.dashboard');

        Route::get('/users', Admin\Users\Index::class)->name('admin.users');
    });
    //endregion

});
//endregion
