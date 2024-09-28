<?php

namespace App\DTO\Cnpja;

class RegistrationTypeDTO
{
    public function __construct(
        public ?int $id,
        public ?string $text
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            text: $data['text'] ?? null,
        );
    }
}
