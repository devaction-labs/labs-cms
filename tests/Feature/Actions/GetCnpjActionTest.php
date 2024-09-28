<?php

use App\Actions\Cnpja\GetCnpjAction;
use App\DTO\Cnpja\CnpjDataDTO;
use App\Http\Integrations\Cnpja\Requests\ConsultCnpjRequest;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

it('executes the GetCnpjAction and returns CnpjDataDTO', function () {

    $mockResponseData = [
        'updated' => '2024-08-25T00:00:00.000Z',
        'taxId'   => '12345678000195',
        'company' => [
            'id'     => 12345678,
            'name'   => 'Teste Empresa LTDA',
            'equity' => 1000000,
            'nature' => [
                'id'   => 1234,
                'text' => 'Sociedade Empresária Limitada',
            ],
            'size' => [
                'id'      => 1,
                'acronym' => 'ME',
                'text'    => 'Microempresa',
            ],
            'members' => [],
        ],

    ];

    Saloon::fake([
        ConsultCnpjRequest::class => MockResponse::make($mockResponseData),
    ]);

    $cnpj   = '12.345.678/0001-95';
    $action = new GetCnpjAction();
    $dto    = $action->execute($cnpj);

    expect($dto)->toBeInstanceOf(CnpjDataDTO::class)
        ->and($dto->taxId)->toBe('12345678000195')
        ->and($dto->company->name)->toBe('Teste Empresa LTDA')
        ->and($dto->company->equity)->toBe(1000000)
        ->and($dto->company->nature->text)->toBe('Sociedade Empresária Limitada')
        ->and($dto->company->size->text)->toBe('Microempresa');

});
