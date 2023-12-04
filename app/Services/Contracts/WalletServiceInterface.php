<?php

namespace App\Services\Contracts;

use App\Models\Wallet;

interface WalletServiceInterface
{

    public function doesWalletBelongToUser(int $userId, int $walletId): void;

    public function blockAmount(int $walletId, int $amount);

    public function transfer(int $fromId, int $toId, int $amount);

    public function transferBlockedAmount(int $fromId, int $toId, int $amount);

    public function findByUserId(int $userId): Wallet;

}
