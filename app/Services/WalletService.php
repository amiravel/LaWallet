<?php

namespace App\Services;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Services\Contracts\CacheServiceInterface;
use App\Services\Contracts\WalletServiceInterface;

class WalletService extends BaseResourceService implements WalletServiceInterface
{

    public function __construct(WalletRepositoryInterface $repository, CacheServiceInterface $cacheService)
    {
        parent::__construct($repository, $cacheService);
    }

    public function doesWalletBelongToUser(int $userId, int $walletId): void
    {
        $doesItBelongToUser = $this->find($walletId)->user_id == $userId;

        if (!$doesItBelongToUser){
            abort(403, 'you cant access the wallet');
        }
    }

    public function blockAmount(int $walletId, int $amount) {
        $this->repository->blockAmount($walletId, $amount);
    }

}
