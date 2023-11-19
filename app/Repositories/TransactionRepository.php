<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function forUser(int $userId): static
    {
        $this->query->where(function ($query) use ($userId){

            $query->whereHas('from', function ($query) use ($userId){

                $query->where('user_id', $userId);

            })->orWhereHas('to', function ($query) use ($userId){

                $query->where('user_id', $userId);

            });

        });

        return $this;
    }

}
