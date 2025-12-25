<?php

namespace App\Providers;

use App\Services\Countries\Contracts\CountryProviderInterface;
use App\Services\Countries\CountryProviderFactory;
use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CountryProviderInterface::class,
            fn () => CountryProviderFactory::resolve()
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
