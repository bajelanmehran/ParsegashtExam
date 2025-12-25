<?php

namespace App\Services\Countries\Providers;

use App\Services\Countries\Contracts\CountryProviderInterface;
use App\Services\Countries\DTOs\CountryData;
use Illuminate\Support\Facades\Http;

class RestCountriesProvider implements CountryProviderInterface
{

    public function getAll(): array
    {
        $data = Http::withoutVerifying()->get("https://restcountries.com/v3.1/all?fields=cca2,name,currencies")->json();

        return $this->handleResponseWithDTO($data);
    }

    public function searchByName(string $name): array
    {
        $data = Http::withoutVerifying()->get("https://restcountries.com/v3.1/name/{$name}?fields=cca2,name,currencies")->json();

        return $this->handleResponseWithDTO($data);
    }

    public function searchByCode(string $code): array
    {
        $data = Http::withoutVerifying()->get("https://restcountries.com/v3.1/alpha/{$code}?fields=cca2,name,currencies")->json();

        return $this->handleResponseWithDTO($data);
    }

    public function searchByCurrency(string $currency): array
    {
        $data = Http::withoutVerifying()->get("https://restcountries.com/v3.1/currency/{$currency}?fields=cca2,name,currencies")->json();

        return $this->handleResponseWithDTO($data);
    }

    public function handleResponseWithDTO(array $data): array
    {
        return array_map(function($item) {
            return new CountryData(
                code: $item['cca2'],
                shortName: $item['name']['common'],
                officialName: $item['name']['official'],
                currency: (string) array_key_first($item['currencies']),
            );
        }, $data);
    }
}
