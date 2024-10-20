<?php

namespace App\Http\Integrations\Anexia\Requests;

use App\Utilities\Traits\StringHelpers;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateOnboardingRequest extends Request implements HasBody
{
    use HasJsonBody;
    use StringHelpers;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $tenant_name,
        public string $tenant_domain,
        public string $tenant_slug,
        public string $tenant_tax_id,
    ) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return $this->convertToString(config('services.anexia.onboarding.url'));
    }

    /**
     * Default body data for the request
     */
    protected function defaultBody(): array
    {
        return [
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => $this->password,
            'tenant_name'   => $this->tenant_name,
            'tenant_domain' => $this->tenant_domain,
            'tenant_slug'   => $this->tenant_slug,
            'tenant_tax_id' => $this->tenant_tax_id,
        ];
    }
}
