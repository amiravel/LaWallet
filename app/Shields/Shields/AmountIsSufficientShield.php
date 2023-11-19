<?php

namespace App\Shields\Shields;

use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Services\Contracts\WalletServiceInterface;
use App\Shields\Contracts\ShieldInterface;

class AmountIsSufficientShield implements ShieldInterface
{

    protected WalletServiceInterface $service;

    public function __construct(WalletServiceInterface $service)
    {
        $this->service = $service;
    }

    public function handle(\Illuminate\Http\Request $request)
    {
        $wallet = $this->service->find($request->get('wallet_id'));

        $amountIsSufficient = $wallet->amount  >= $request->get('amount');

        if (!$amountIsSufficient){
            abort(400, 'amount is not sufficient');
        }
    }
}
