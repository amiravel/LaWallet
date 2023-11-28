<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Contracts\WalletRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WalletRepository extends BaseRepository implements WalletRepositoryInterface
{
    public function __construct(Wallet $model)
    {
        parent::__construct($model);
    }

    public function blockAmount(int $walletId, int $amount): void
    {
        DB::beginTransaction();

        $wallet = $this->query->lockForUpdate()->find($walletId);

        $wallet->decrement('amount', $amount);
        $wallet->increment('blocked_amount', $amount);

        DB::commit();
    }

    public function transfer(int $fromId, int $toId, int $amount): void
    {
        DB::beginTransaction();

        $from = $this->query->lockForUpdate()->find($fromId);
        $to = $this->query->lockForUpdate()->find($toId);

        $from->decrement('amount', $amount);
        $to->increment('amount', $amount);

        DB::commit();
    }

    public function transferBlockedAmount(int $fromId, int $toId, int $amount): void
    {
        DB::beginTransaction();

        $from = $this->query->lockForUpdate()->find($fromId);
        $to = $this->query->lockForUpdate()->find($toId);

        $from->decrement('blocked_amount', $amount);
        $to->increment('amount', $amount);

        DB::commit();
    }

    public function findByUserId(int $userId): \Illuminate\Database\Eloquent\Builder|Model
    {
        return $this->query->where('user_id', $userId)->first();
    }
}
