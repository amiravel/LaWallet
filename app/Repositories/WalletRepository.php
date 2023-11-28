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
}
