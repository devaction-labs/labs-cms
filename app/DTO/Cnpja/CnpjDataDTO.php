<?php

namespace App\DTO\Cnpja;

class CnpjDataDTO
{
    public function __construct(
        public ?string $updated,
        public ?string $taxId,
        public CompanyDTO $company,
        public ?string $alias,
        public ?string $founded,
        public ?bool $head,
        public ?string $statusDate,
        public StatusDTO $status,
        public AddressDTO $address,
        public array $phones,
        public array $emails,
        public ActivityDTO $mainActivity,
        public array $sideActivities,
        public array $registrations,
        public int $customerId
    ) {}

    public static function fromArray(array $response, int $customerId): self
    {
        return new self(
            updated: $response['updated'] ?? null,
            taxId: $response['taxId'] ?? null,
            company: CompanyDTO::fromArray($response['company'] ?? [], $customerId),
            alias: $response['alias'] ?? null,
            founded: $response['founded'] ?? null,
            head: $response['head'] ?? null,
            statusDate: $response['statusDate'] ?? null,
            status: StatusDTO::fromArray($response['status'] ?? []),
            address: AddressDTO::fromArray($response['address'] ?? []),
            phones: array_map(fn ($phone) => PhoneDTO::fromArray($phone), $response['phones'] ?? []),
            emails: array_map(fn ($email) => EmailDTO::fromArray($email), $response['emails'] ?? []),
            mainActivity: ActivityDTO::fromArray($response['mainActivity'] ?? []),
            sideActivities: array_map(fn ($activity) => ActivityDTO::fromArray($activity), $response['sideActivities'] ?? []),
            registrations: array_map(fn ($registration) => RegistrationDTO::fromArray($registration), $response['registrations'] ?? []),
            customerId: $customerId,
        );
    }
}
