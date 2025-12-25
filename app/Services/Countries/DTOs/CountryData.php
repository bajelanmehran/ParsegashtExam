<?php

namespace App\Services\Countries\DTOs;

class CountryData
{
    public function __construct(
        public string $code,
        public string $shortName,
        public string $officialName,
        public string $currency,
    ) {}
}
