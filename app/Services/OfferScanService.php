<?php

namespace App\Services;

use App\Adapters\Contracts\TransactionAdapterInterface;
use App\Models\Offer;
use App\Repositories\Contracts\OfferRepositoryInterface;
use App\Services\Contracts\BaseResourceServiceInterface;
use App\Services\Contracts\CacheServiceInterface;
use App\Services\Contracts\OfferScanServiceInterface;
use App\Services\Contracts\TransactionServiceInterface;
use App\Services\Contracts\WalletServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OfferScanService extends BaseResourceService implements OfferScanServiceInterface
{

    private WalletServiceInterface $walletService;
    private TransactionServiceInterface $transactionService;
    private TransactionAdapterInterface $transactionAdapter;

    public function __construct(
        OfferRepositoryInterface $repository,
        CacheServiceInterface $cacheService,
        WalletServiceInterface $walletService,
        TransactionServiceInterface $transactionService,
        TransactionAdapterInterface $transactionAdapter,
    )
    {
        parent::__construct($repository, $cacheService);
        $this->walletService = $walletService;
        $this->transactionService = $transactionService;
        $this->transactionAdapter = $transactionAdapter;
    }

    public function offerScannedByUser(int $offerId, int $userId): bool
    {
        return $this->repository->offerScannedByUser($offerId, $userId);
    }

    public function findByCode(string $code): Model
    {
        return $this->cacheService->setItem(
            $this->repository,
            $this->repository->findByCode($code)
        );
    }

    public function scanByUser(int $offerId, int $userId)
    {
        try {
            DB::beginTransaction();

            /**
             * @var Offer $offer
             */
            $offer = $this->find($offerId);

            $this->repository->scan($offer, $userId);
            $scannerWallet = $this->walletService->findByUserId($userId);

            $this->walletService->transferBlockedAmount(
                $offerId->wallet_id,
                $scannerWallet->id,
                $offer->amount_per_scan
            );

            $this->transactionService->create(
                $this->transactionAdapter->scanOfferDataToTransaction($offer, $scannerWallet)->toArray()
            );

            DB::commit();

        }catch (\Throwable $exception){
            DB::rollBack();

            throw  new $exception;
        }
    }
}
