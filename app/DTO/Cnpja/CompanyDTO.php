<?php

namespace App\DTO\Cnpja;

class CompanyDTO
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?int $equity,
        public NatureDTO $nature,
        public SizeDTO $size,
        public array $members,
        public ?int $customerId = null
    ) {}

    public static function fromArray(array $data, ?int $customerId = null): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'] ?? null,
            equity: $data['equity'] ?? null,
            nature: NatureDTO::fromArray($data['nature'] ?? []),
            size: SizeDTO::fromArray($data['size'] ?? []),
            members: array_map(fn ($member) => MemberDTO::fromArray($member), $data['members'] ?? []),
            customerId: $customerId,
        );
    }
}
