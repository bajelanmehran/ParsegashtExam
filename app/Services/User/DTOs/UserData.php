<?php

namespace App\Services\User\DTOs;

class UserData
{

    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $country,
        public ?string $currency,
    )
    {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            country: $data['country'] ?? null,
            currency: $data['currency'] ?? null
        );
    }
}
