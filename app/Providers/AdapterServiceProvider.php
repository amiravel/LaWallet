<?php

namespace App\Providers;

use App\Adapters\Contracts\TransactionAdapterInterface;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
