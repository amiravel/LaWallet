<?php

namespace App\Shields\Shields;

use App\DataTransferObjects\Dto;
use App\DataTransferObjects\OfferDto;
use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Services\Contracts\WalletServiceInterface;
use App\Shields\Contracts\OfferShieldInterface;

class MyWalletOfferShield implements OfferShieldInterface
{

    protected WalletServiceInterface $service;

    public function __construct(WalletServiceInterface $service)
    {
        $this->service = $service;
    }

    public function handle(OfferDto $offerDto): void
    {
        $this->service->doesWalletBelongToUser(
            auth()->id(),
            $offerDto->wallet_id
        );
    }
}
