<?php

namespace App\Http\Integrations\Anexia;

use App\Utilities\Traits\StringHelpers;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class AnexiaConnector extends Connector
{
    use AcceptsJson;
    use StringHelpers;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->convertToString(config('services.anexia.url_base'));
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->convertToString(config('services.anexia.token')),
            'Accept'        => 'application/json',
        ];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
