<?php

namespace App\Services\Countries\Providers;

use App\Services\Countries\Contracts\CountryProviderInterface;

class DBCountriesProvider implements CountryProviderInterface
{

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function searchByName(string $name): array
    {
        // TODO: Implement searchByName() method.
    }

    public function searchByCode(string $code): array
    {
        // TODO: Implement searchByCode() method.
    }

    public function searchByCurrency(string $currency): array
    {
        // TODO: Implement searchByCurrency() method.
    }

    public function handleResponseWithDTO(array $data): array
    {
        // TODO: Implement handleResponseWithDTO() method.
    }
}
