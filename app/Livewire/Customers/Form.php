<?php

namespace App\Livewire\Customers;

use App\Actions\Anexia\Onboarding\CreateOnboardingAction;
use App\Enums\Onboarding\StatusEnum;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use JsonException;
use Livewire\Form as BaseForm;
use Saloon\Exceptions\Request\{FatalRequestException, RequestException};

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

    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws JsonException
     */
    public function create(): array
    {
        $this->validate();

        $password = $this->password;
        Customer::query()->create([
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'tenant_name'   => $this->tenant_name,
            'tenant_domain' => $this->tenant_domain,
            'tenant_slug'   => $this->tenant_slug,
            'tenant_tax_id' => $this->tenant_tax_id,
            'password'      => bcrypt($password),
            'status'        => StatusEnum::ONBOARDING_PENDING->value,
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
