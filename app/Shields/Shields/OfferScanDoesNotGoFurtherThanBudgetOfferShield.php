<?php

namespace App\Shields\Shields;

use App\DataTransferObjects\OfferDto;
use App\Services\Contracts\WalletServiceInterface;
use App\Shields\Contracts\OfferShieldInterface;

class OfferScanDoesNotGoFurtherThanBudgetOfferShield implements OfferShieldInterface
{

    private WalletServiceInterface $walletService;

    public function __construct(WalletServiceInterface $walletService)
    {
        $this->walletService = $walletService;
    }

    public function handle(OfferDto $offerDto)
    {
        $wallet = $this->walletService->find($offerDto->wallet_id);
        $amountSufficient = $wallet->blocked_amount >= $offerDto->amount_per_scan;

        if (!$amountSufficient){
            abort(403, 'wallet amount is not sufficient');
        }
    }
}
