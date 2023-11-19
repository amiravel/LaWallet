<?php

namespace App\Services\Contracts;

interface WalletServiceInterface
{

    public function doesWalletBelongToUser(int $userId, int $walletId): void;

}
