<?php

namespace App\Services\Countries;

use App\Services\Countries\Contracts\CountryProviderInterface;
use App\Services\Countries\Providers\DBCountriesProvider;
use App\Services\Countries\Providers\RestCountriesProvider;
use RuntimeException;

class CountryProviderFactory
{

    private const PROVIDERS = [
        'rest'  => RestCountriesProvider::class,
        'db'    => DBCountriesProvider::class,
    ];

    public static function resolve(): CountryProviderInterface
    {
        return app(self::PROVIDERS[config('country.provider')])
            ?? throw new RuntimeException("Unsupported provider");
    }
}
