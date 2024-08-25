<?php

namespace App\DTO\Cnpja;

class PersonDTO
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?string $type,
        public ?string $taxId,
        public ?string $age
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'] ?? null,
            type: $data['type'] ?? null,
            taxId: $data['taxId'] ?? null,
            age: $data['age'] ?? null,
        );
    }
}
