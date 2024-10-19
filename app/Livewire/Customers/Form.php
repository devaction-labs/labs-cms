<?php

namespace App\Livewire\Customers;

use App\Actions\Anexia\Onboarding\CreateOnboardingAction;
use App\Models\Customer;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Form as BaseForm;
use Log;

class Form extends BaseForm
{
    public ?Customer $customer = null;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $tenant_name = '';

    public string $tenant_domain = '';

    public string $tenant_slug = '';

    public string $tenant_tax_id = '';

    public string $password = '';

    public function rules(): array
    {
        return [
            'name'  => ['required', 'min:3', 'max:255'],
            'email' => ['required_without:phone', 'email', Rule::unique('customers')->ignore($this->customer?->id)],
            'phone' => ['required_without:email', Rule::unique('customers')->ignore($this->customer?->id)],
        ];
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;

        $this->name          = (string)$customer->name;
        $this->email         = (string)$customer->email;
        $this->phone         = (string)$customer->phone;
        $this->tenant_name   = (string)$customer->tenant_name;
        $this->tenant_domain = (string)$customer->tenant_domain;
        $this->tenant_slug   = (string)$customer->tenant_slug;
        $this->tenant_tax_id = (string)$customer->tenant_tax_id;
    }

    public function create(): array
    {
        $this->validate();

        $password = $this->password;

        try {
            Customer::query()->create([
                'name'          => $this->name,
                'email'         => $this->email,
                'phone'         => $this->phone,
                'tenant_name'   => $this->tenant_name,
                'tenant_domain' => $this->tenant_domain,
                'tenant_slug'   => $this->tenant_slug,
                'tenant_tax_id' => $this->tenant_tax_id,
                'password'      => bcrypt($password),
                'status'        => 'pending',
            ]);

            $response = (new CreateOnboardingAction())->execute(
                $this->name,
                $this->email,
                $password,
                $this->tenant_name,
                $this->tenant_domain,
                $this->tenant_slug,
                $this->tenant_tax_id
            );

            $this->reset();

            return [
                'status'  => 'success',
                'message' => $response['message'],
            ];

        } catch (Exception $e) {
            Log::info('Error: ' . $e->getMessage());

            return [
                'status'  => 'error',
                'message' => 'Não foi possível registrar o cliente no sistema externo: ' . $e->getMessage(),
            ];
        }
    }

    public function update(): void
    {
        $this->validate();

        if ($this->customer === null) {
            return;
        }

        $this->customer->name  = $this->name;
        $this->customer->email = $this->email;
        $this->customer->phone = $this->phone;

        $this->customer->update();
    }
}
