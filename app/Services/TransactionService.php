<?php

namespace App\Services;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Services\Contracts\CacheServiceInterface;
use App\Services\Contracts\TransactionServiceInterface;
use App\Services\Contracts\WalletServiceInterface;

class TransactionService extends BaseResourceService implements TransactionServiceInterface
{

    public function __construct(TransactionRepositoryInterface $repository, CacheServiceInterface $cacheService)
    {
        parent::__construct($repository, $cacheService);
    }

}
