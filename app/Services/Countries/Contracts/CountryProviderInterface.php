<?php

namespace App\Services\Countries\Contracts;

use App\Services\Countries\DTOs\CountryData;

interface CountryProviderInterface
{
    /**
     * You must specify the fields you need (up to 10 fields) when calling the all endpoints, otherwise you’ll get a bad request response. Please see this issue for more information. This applies to all versions.
     * @return CountryData[]
     */
    public function getAll(): array;

    /**
     * Search by country name. If you want to get an exact match, use the next endpoint. It can be the common or official value
     * @param string $name
     * @return CountryData[]
     */
    public function searchByName(string $name): array;

    /**
     * Search by cca2, ccn3, cca3 or cioc country code (yes, any!)
     * @param string $code
     * @return CountryData[]
     */
    public function searchByCode(string $code): array;

    /**
     * Search by currency code or name
     * @param string $currency
     * @return CountryData[]
     */
    public function searchByCurrency(string $currency): array;

    /**
     * @return CountryData[]
     */
    public function handleResponseWithDTO(array $data): array;
}
