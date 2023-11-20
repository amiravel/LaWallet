<?php

namespace App\Providers;

use App\Responses\Contracts\ResponseInterface;
use App\Responses\Response;
use App\Services\CacheService;
use App\Services\Contracts\CacheServiceInterface;
use App\Services\Contracts\OfferServiceInterface;
use App\Services\Contracts\TransactionServiceInterface;
use App\Services\Contracts\WalletServiceInterface;
use App\Services\OfferService;
use App\Services\TransactionService;
use App\Services\WalletService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ResponseInterface::class, Response::class);
        $this->app->bind(OfferServiceInterface::class, OfferService::class);
        $this->app->bind(CacheServiceInterface::class, CacheService::class);
        $this->app->bind(WalletServiceInterface::class, WalletService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
