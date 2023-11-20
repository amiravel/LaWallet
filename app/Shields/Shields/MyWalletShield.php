<?php

namespace App\Shields\Shields;

use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Services\Contracts\WalletServiceInterface;
use App\Shields\Contracts\ShieldInterface;

class MyWalletShield implements ShieldInterface
{

    protected WalletServiceInterface $service;

    public function __construct(WalletServiceInterface $service)
    {
        $this->service = $service;
    }

    public function handle(\Illuminate\Http\Request $request)
    {
        $this->service->doesWalletBelongToUser(
            $request->user()->id,
            $request->get('wallet_id')
        );
    }
}
