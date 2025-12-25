<?php

namespace App\Services\Countries;

use App\Http\Resources\CountryResource;
use App\Services\Countries\Contracts\CountryProviderInterface;
use App\Services\Countries\DTOs\CountryData;

class CountryService
{

    public function __construct(
        private CountryProviderInterface $provider
    )
    {}

    /**
     * @return CountryData[]
     */
    public function all()
    {
        return $this->provider->getAll();
    }

    /**
     * @param string $name
     * @return CountryData[]
     */
    public function getByName(string $name)
    {
        return $this->provider->searchByName($name);
    }

    /**
     * @param string $code
     * @return CountryData[]
     */
    public function getByCode(string $code)
    {
        return $this->provider->searchByCode($code);
    }

    /**
     * @param string $currency
     * @return CountryData[]
     */
    public function getByCurrency(string $currency)
    {
        return $this->provider->searchByCurrency($currency);
    }

    /**
     * @return CountryData
     */
    public function getRandom(): CountryData
    {
        return collect($this->provider->getAll())->random();
    }

}
