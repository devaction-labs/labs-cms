<?php

namespace App\Actions\Anexia\Onboarding;

use App\Http\Integrations\Anexia\AnexiaConnector;
use App\Http\Integrations\Anexia\Requests\CreateOnboardingRequest;
use JsonException;
use Saloon\Exceptions\Request\{FatalRequestException, RequestException};

class CreateOnboardingAction
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws JsonException
     */
    public function execute(
        string $name,
        string $email,
        string $password,
        string $tenant_name,
        string $tenant_domain,
        string $tenant_slug,
        string $tenant_tax_id
    ): array {
        $connector = (new AnexiaConnector())->send(
            new CreateOnboardingRequest(
                name: $name,
                email: $email,
                password: $password,
                tenant_name: $tenant_name,
                tenant_domain: $tenant_domain,
                tenant_slug: $tenant_slug,
                tenant_tax_id: $tenant_tax_id
            )
        );

        return $connector->json();
    }
}
