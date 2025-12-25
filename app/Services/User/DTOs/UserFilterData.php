<?php

namespace App\Services\User\DTOs;

class UserFilterData
{

    public function __construct(
        public ?string $country,
        public ?string $currency,
        public ?string $orderBy,
        public ?string $orderDirection,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            country: $data['country'] ?? null,
            currency: $data['currency'] ?? null,
            orderBy: $data['orderBy'] ?? "id",
            orderDirection: $data['orderDirection'] ?? "ASC"
        );
    }
}
