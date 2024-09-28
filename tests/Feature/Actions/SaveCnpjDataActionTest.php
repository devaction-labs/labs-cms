<?php

use App\Actions\Customer\SaveCnpjDataAction;
use App\DTO\Cnpja\CnpjDataDTO;
use App\Models\{Activity, Address, Company, Customer, Email, Member, Phone, Registration};

beforeEach(function () {
    global $dtoData;

    $dtoData = [
        'customerId' => null,
        'taxId'      => '12345678000195',
        'company'    => [
            'name'   => 'Teste Empresa LTDA',
            'equity' => 1000000,
            'nature' => [
                'id'   => '1234',
                'text' => 'Sociedade Empresária Limitada',
            ],
            'size' => [
                'id'      => '1',
                'acronym' => 'ME',
                'text'    => 'Microempresa',
            ],
            'members' => [
                [
                    'since' => '2020-01-01',
                    'role'  => [
                        'id'   => '49',
                        'text' => 'Sócio-Administrador',
                    ],
                    'person' => [
                        'id'    => 'person-id-1',
                        'name'  => 'Cledson Nunes Ribeiro',
                        'type'  => 'NATURAL',
                        'taxId' => '12345678900',
                        'age'   => '41-50',
                    ],
                ],
            ],
        ],
        'address' => [
            'street'   => 'Rua Teste',
            'number'   => '123',
            'details'  => 'Apto 101',
            'district' => 'Centro',
            'city'     => 'São Paulo',
            'state'    => 'SP',
            'zip'      => '12345678',
            'country'  => [
                'id'   => 1,
                'name' => 'Brasil',
            ],
        ],
        'emails' => [
            [
                'address' => 'contact@empresa.com.br',
                'domain'  => 'empresa.com.br',
            ],
        ],
        'phones' => [
            [
                'number' => '40041234',
                'area'   => '11',
            ],
        ],
        'sideActivities' => [
            [
                'id'   => '9511800',
                'text' => 'Reparação e manutenção de computadores e de equipamentos periféricos',
            ],
        ],
        'registrations' => [
            [
                'state'      => 'SP',
                'number'     => '123456',
                'enabled'    => true,
                'statusDate' => '2024-08-25',
                'status'     => [
                    'id'   => '1',
                    'text' => 'Ativo',
                ],
                'type' => [
                    'id'   => '2',
                    'text' => 'IE Substituto Tributário',
                ],
            ],
        ],
    ];

});

it('saves CNPJ data correctly using SaveCnpjDataAction', function () {
    global $dtoData;

    $dto = CnpjDataDTO::fromArray($dtoData);

    $action   = new SaveCnpjDataAction();
    $company  = $action->execute($dto, $dtoData);
    $customer = Customer::find($company->customer_id);

    expect(Customer::query()->where('id', $customer?->getKey())->exists())->toBeTrue()
        ->and(Company::query()->where('customer_id', $customer?->getKey())->exists())->toBeTrue()
        ->and(Address::query()->where('customer_id', $customer?->getKey())->exists())->toBeTrue()
        ->and(Email::query()->where('customer_id', $customer?->getKey())->exists())->toBeTrue()
        ->and(Phone::query()->where('customer_id', $customer?->getKey())->exists())->toBeTrue()
        ->and(Activity::query()->where('customer_id', $customer?->getKey())->exists())->toBeTrue()
        ->and(Member::query()->where('company_id', $company->id)->exists())->toBeTrue()
        ->and(Registration::query()->where('customer_id', $customer?->getKey())->exists())->toBeTrue();
});
