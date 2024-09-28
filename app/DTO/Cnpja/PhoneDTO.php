<?php

namespace App\DTO\Cnpja;

class PhoneDTO
{
    public function __construct(
        public ?string $area,
        public ?string $number
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            area: $data['area'] ?? null,
            number: $data['number'] ?? null,
        );
    }
}
