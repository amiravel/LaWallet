<?php

namespace App\Services;

use App\Adapters\Contracts\TransactionAdapterInterface;
use App\Models\Offer;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\OfferRepositoryInterface;
use App\Services\Contracts\CacheServiceInterface;
use App\Services\Contracts\OfferServiceInterface;
use App\Services\Contracts\TransactionServiceInterface;
use App\Services\Contracts\WalletServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OfferService extends BaseResourceService implements OfferServiceInterface
{

    private WalletServiceInterface $walletService;
    private TransactionServiceInterface $transactionService;
    private TransactionAdapterInterface $transactionAdapter;

    public function __construct(
        OfferRepositoryInterface $repository,
        CacheServiceInterface $cacheService,
        WalletServiceInterface $walletService,
        TransactionServiceInterface $transactionService,
        TransactionAdapterInterface $transactionAdapter
    )
    {
        parent::__construct($repository, $cacheService);
        $this->walletService = $walletService;
        $this->transactionService = $transactionService;
        $this->transactionAdapter = $transactionAdapter;
    }

    public function create(array $attributes): Model
    {
        try {
            DB::beginTransaction();

            /**
             * @var Offer $offer
             */
            $offer = parent::create($attributes);

            $this->walletService->blockAmount($offer->wallet_id, $offer->budget_amount);

            $this->transactionService->create(
                $this->transactionAdapter->fromOfferModelToTransaction($offer)->toArray()
            );

            DB::commit();

            return $offer;
        }catch (\Throwable $exception) {
            DB::rollBack();

            throw new $exception;
        }

    }

}
