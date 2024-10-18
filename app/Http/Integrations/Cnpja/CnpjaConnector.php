<?php

namespace App\Http\Integrations\Cnpja;

use App\Utilities\Traits\StringHelpers;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class CnpjaConnector extends Connector
{
    use AcceptsJson;
    use StringHelpers;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->convertToString(config('services.cnpja.url_base'));
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => config('services.cnpja.token'),
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
