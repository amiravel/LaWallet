<?php

namespace App\Repositories\Contracts;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;

interface WalletRepositoryInterface extends BaseRepositoryInterface
{

    public function blockAmount(int $walletId, int $amount);

    public function transfer(int $fromId, int $toId, int $amount): void;

    public function transferBlockedAmount(int $fromId, int $toId, int $amount): void;

    public function findByUserId(int $userId): \Illuminate\Database\Eloquent\Builder|Model;

}
