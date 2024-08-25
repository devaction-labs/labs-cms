<?php

namespace App\Actions\Cnpja;

use App\DTO\Cnpja\CnpjDataDTO;
use App\Http\Integrations\Cnpja\CnpjaConnector;
use App\Http\Integrations\Cnpja\Requests\ConsultCnpjRequest;
use App\Support\CnpjHelper;
use JsonException;
use Saloon\Exceptions\Request\{FatalRequestException, RequestException};

class GetCnpjAction
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws JsonException
     */
    public function execute(string $cnpj): CnpjDataDTO
    {
        $sanitizedCnpj = CnpjHelper::sanitize($cnpj);

        $request  = new ConsultCnpjRequest($sanitizedCnpj);
        $response = (new CnpjaConnector())->send($request)->json();

        return CnpjDataDTO::fromArray($response);
    }
}
