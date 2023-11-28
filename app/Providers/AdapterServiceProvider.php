<?php

namespace App\Providers;

use App\Adapters\Contracts\OfferAdapterInterface;
use App\Adapters\Contracts\TransactionAdapterInterface;
use App\Adapters\OfferAdapter;
use App\Adapters\TransactionAdapter;
use Illuminate\Support\ServiceProvider;

class AdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TransactionAdapterInterface::class, TransactionAdapter::class);
        $this->app->bind(OfferAdapterInterface::class, OfferAdapter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
