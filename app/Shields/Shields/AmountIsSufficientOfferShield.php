<?php

namespace App\Shields\Shields;

use App\DataTransferObjects\OfferDto;
use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Services\Contracts\WalletServiceInterface;
use App\Shields\Contracts\OfferShieldInterface;

class AmountIsSufficientOfferShield implements OfferShieldInterface
{

    protected WalletServiceInterface $service;

    public function __construct(WalletServiceInterface $service)
    {
        $this->service = $service;
    }

    public function handle(OfferDto $offerDto): void
    {
        $wallet = $this->service->find($offerDto->wallet_id);

        $amountIsSufficient = $wallet->amount  >= $offerDto->budget_amount;

        if (!$amountIsSufficient){
            abort(400, 'amount is not sufficient');
        }
    }
}
