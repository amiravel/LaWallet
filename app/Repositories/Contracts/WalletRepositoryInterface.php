<?php

namespace App\Repositories\Contracts;

interface WalletRepositoryInterface extends BaseRepositoryInterface
{

    public function blockAmount(int $walletId, int $amount);

}
